<?php namespace DepotServer;

/**
 * Router
 *
 * Sistema de ruteo de información
 *
 * @access       public
 * @author       Mauricio Vera <m.vera@depotserver.com>
 * @copyright    DepotServer 2017
 * @name         Slim Framework
 * @since		3.5
 * @version		3.5
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\{Container as SlimCont, App as Slim};
use DepotServer\Router;
use DepotServer\FileManager;
use DepotServer\Configuracion;
use DepotServer\Conexion;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RoutesController
{
   protected $container;
   protected $fileSystem;

   // constructor receives container instance
   public function __construct(SlimCont $container) {
      $this->container = $container;
      $this->filesystem = new FileManager('../');
   }

   private function accesoPermitido($publica, $sesion){
     return $publica || (!$publica && $sesion > 0);
   }

   public function json( Request $request, Response $response, $args){

     $url = $this->container['url'];
     $archivo = "inc/".$url['b']."/ctl/json.ctl.php";
     if ( $this->filesystem->existeArchivo($archivo) ){
       require_once($archivo);

       if( $this->accesoPermitido($publica, $_SESSION['usuario']['area'][$url['b']] ) ){
         $r = $this->obtenerInformacion($url, $tabla, $campos, $joins);
       }else{
          $this->container['logger']->warning("Acceso no permitido - ".print_r( [ 'url' => $this->container['url']['uri'], $_SESSION['usuario'], $_SESSION['accesos']] , true)."\n");
          $r = [ "ack" => 405, "error" => "Acceso no permitido"];
       }
     }else{
       $this->container['logger']->warning("Servicio no habilitado |".$this->container['url']['uri']."|".$_SESSION['usuario']['usuario']."\n");
       $r = [ "ack" => 404, "error" => "Servicio no habilitado"];
     }

     return $response->withJson( $r );

   }

   public function xlsx( Request $request, Response $response, $args){

     $url = $this->container['url'];
     $archivo = "inc/".$url['b']."/ctl/json.ctl.php";
     if ( $this->filesystem->existeArchivo($archivo) ){
       require_once($archivo);
       if( $this->accesoPermitido($publica, $_SESSION['usuario']['area'][$url['b']] ) ){
         if(!isset($url["limit"])) { $url["limit"] = -1; }
         $r = $this->obtenerInformacion($url, $tabla, $campos, $joins);
       }else{
          $this->container['logger']->warning("Acceso no permitido - ".print_r( [ 'url' => $this->container['url']['uri'], $_SESSION['usuario'], $_SESSION['accesos']] , true)."\n");
          throw new \Exception("Acceso no permitido", 405);
       }
     }else{
       $this->container['logger']->warning("Servicio no habilitado |".$this->container['url']['uri']."|".$_SESSION['usuario']['usuario']."\n");
       throw new \Exception("Servicio no habilitado", 404);
     }
     //$body = $response->getBody();
     //$body->write( print_r($r, true) );
     ini_set('memory_limit','256M');
     $spreadsheet = new Spreadsheet();
     $sheet = $spreadsheet->getActiveSheet();
     $sheet->setTitle($url['b']);
     $campos = array_map(function($n) {return strtoupper($n);}, $campos);
     $sheet->fromArray( $campos , NULL, 'A1' );
     $sheet->fromArray( json_decode(json_encode($r['rows']),true) , NULL, 'A2' );
     $sheet->setCellValue('A1', 'ID');

     $letra = Coordinate::stringFromColumnIndex(sizeof($campos));
     $primeras = $sheet->getStyle('A1:'.$letra.'1')->getAlignment();
     $primeras->setWrapText(true);
     $primeras->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
     $primeras->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
     $sheet->getColumnDimension('A')->setWidth(5);
     for ($i=1; $i <= sizeof($campos); $i++) {
       $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($i))->setWidth(20);
     }
     $styleArray = array(
        'borders' => array( 'bottom' => array( 'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK, 'color' => array('argb' => 'FF000000'), ) ),
        'font' => array( 'bold' => true )
    );
    $sheet->getStyle('A1:'.$letra.'1')->applyFromArray($styleArray);

    $modulo = $url['b'].'_'.date("Y-m-d_H-i-s  ");
    $writer = new Xlsx($spreadsheet);
    $writer->save('tmp/'.$modulo.'.xlsx');

    return $response->withRedirect('/tmp/'.$modulo.'.xlsx', 301);
     //return $response->withBody( $body );
   }

   private function obtenerInformacion($url, $tabla, &$campos, $joins){

     $r = [ "ack" => 200, "requestedURL" => $url['uri'] ];
     $db = $this->container['db'];

     if(isset($url['campos'])){
       $campos = unserialize(base64_decode($url['campos']));
       $columnaCatalogo = $campos[0];
       $campos = ["id", $campos[0]." AS objeto"];
       $catalogo = true;
     }
     $camposBusqueda = $campos;
     $campos[0] = $db::raw('SQL_CALC_FOUND_ROWS '.$campos[0]);
     $info = $db::table($tabla)->select($campos);

     // JOIN [REQUEST]
     if( isset($url['joins']) && strlen($url['joins']) > 0 ){
       $joins = unserialize(base64_decode($url['joins']));
     }
    if( is_array($joins) ){
      foreach($joins as $join){
        $info = $info->addSelect($join['col_mostrar']." as FK". str_replace(".","",substr($join['col_origen'], strpos($join['col_origen'], ".")))  );
        $campos[] = $join['col_mostrar'];
        $info = $info->leftJoin($join['tabla'], (( strpos($join['col_origen'], '.') !== false ) ? $join['col_origen']: $tabla.'.'.$join['col_origen']), '=', $join['tabla'].'.'.$join['col_destino']);
      }
    }

     // JOIN [json]
    // echo $info->toSql();
    // exit;


     if( $url['c'] == 'obtenerobjetos' ){
       $info = $info->Where($tabla.".id", $url['d']);
     }

     if( isset($url['filtrar']) ){
       $info = $info->where($tabla.".".base64_decode($url['filtrar']), $url['valor']);
     }

     if(isset($url['search'])){
       if(sizeof($camposBusqueda) > 0){
         if(is_numeric($url['search'])){
            $info = $info->Where($camposBusqueda[0], $url['search']);
            $info = $info->OrWhere($camposBusqueda[0], 'like', '%'.$url['search'].'%');
         }else{
            $info = $info->Where($camposBusqueda[0], 'like', '%'.$url['search'].'%');
         }
         unset($camposBusqueda[0]);
         if(sizeof($camposBusqueda) > 0){
           foreach ($camposBusqueda as $campo) {
             if(is_numeric($url['search'])){
                $info = $info->OrWhere($campo, $url['search']);
             }
             $info = $info->OrWhere($campo, 'like', '%'.$url['search'].'%');
           }
         }
       }
     }

     if(isset($url['term'])){
       $info = $info->Where($columnaCatalogo, 'like', '%'.$url['term'].'%');
     }

     $limit = 10; if(isset($url["limit"])) { $limit = $url["limit"]; }
     $offset = 0; if(isset($url["offset"])) { $offset = $url["offset"]; }
     if( isset($url["sort"]) ){ $info = $info->orderBy($url["sort"], $url["order"]); }
     $info = $info->take($limit);
     if($offset > 0){ $info = $info->skip($offset); }

     try{
       $r['rows'] = $info->get()->all();
     }catch(\Illuminate\Database\QueryException $e){
       throw new \Exception("Query no válido ".$info->toSql() );
     }
     
     //$r['query'] = $info->toSql();

     if($catalogo){
       $info = [];
       foreach($r['rows'] as $obj){
         $info[] = ["id" => $obj->id, "text" => $obj->objeto];
       }
       $r = ["results" => $info, "total_count" => $cuenta->total, "incomplete_results" => false];
     }

     $cuenta  = reset($db::select( $db::raw("SELECT FOUND_ROWS() as 'total' ") ) );
     $r['total'] = $cuenta->total;

     return $r;

   }

   public function upload( Request $request, Response $response, $args){
      $url = $this->container['url'];
      $options = [
        "upload_dir" => dirname($_SERVER['SCRIPT_FILENAME'])."/tmp/upload/".$url["b"]."/".$_SESSION['usuario']['id']."/",
        "upload_url" => UploadHandler::get_full_url()."/tmp/upload/".$url['b']."/".$_SESSION['usuario']['id']."/",
      ];
      $upload_handler = new UploadHandler($options);
      exit;
   }

}
