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

class RoutesController
{
   protected $container;
   protected $fileSystem;

   // constructor receives container instance
   public function __construct(SlimCont $container) {
      $this->container = $container;
      $this->filesystem = new FileManager('../');
   }

   public function main( Request $request, Response $response, $args){

     $url = $this->container['url'];
     $r = [ "ack" => 200, "requestedURL" => $url['uri'] ];
     $archivo = "inc/".$url['b']."/ctl/json.ctl.php";
     if ( $this->filesystem->existeArchivo($archivo) ){
       require_once($archivo);

       if( $publica || (!$publica && $_SESSION['usuario']['area'][$url['b']] > 0) ){

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

         if( $url['c'] == 'obtenerobjetos' ){
           $info = $info->Where("id", $url['d']);
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

         $r['rows'] = $info->get()->all();

         $cuenta  = reset($db::select( $db::raw("SELECT FOUND_ROWS() as 'total' ") ) );
         $r['total'] = $cuenta->total;

         if($catalogo){
           $info = [];
           foreach($r['rows'] as $obj){
             $info[] = ["id" => $obj->id, "text" => $obj->objeto];
           }
           $r = ["results" => $info, "total_count" => $cuenta->total, "incomplete_results" => false];
         }

         // $r['query'] = $info->toSql();

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
}
