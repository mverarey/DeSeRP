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
     $r = [ "ack" => 200, "requestedURL" => $url];
     $archivo = "inc/".$url['b']."/ctl/json.ctl.php";
     if ( $this->filesystem->existeArchivo($archivo) ){
       require_once($archivo);

       if( $publica || (!$publica && $_SESSION['usuario']['area'][$url['b']] > 0) ){

         $db = $this->container['db'];

         $camposBusqueda = $campos;
         $campos[0] = $db::raw('SQL_CALC_FOUND_ROWS '.$campos[0]);
         $info = $db::table($tabla)->select($campos);

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

         $limit = 10; if(isset($url["limit"])) { $limit = $url["limit"]; }
         $offset = 0; if(isset($url["offset"])) { $offset = $url["offset"]; }
         if( isset($url["sort"]) ){ $info = $info->orderBy($url["sort"], $url["order"]); }
         $info = $info->take($limit);
         if($offset > 0){ $info = $info->skip($offset); }

         $r['rows'] = $info->get()->all();

         $cuenta  = reset($db::select( $db::raw("SELECT FOUND_ROWS() as 'total' ") ) );
         $r['total'] = $cuenta->total;

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

   public function mainPrototipo(Request $request, Response $response, $args){

      $params = explode('/', $args['params'] );
      $area = $params[0];

      $r = array("ack" => 200, "request" => $args['params']);

      $archivo = "inc/".$area."/ctl/json.ctl.php";
      if ( $this->filesystem->existeArchivo($archivo) ){

        $c = new BaseDatos();
        require_once($archivo);

        if( (!$publica && $_SESSION['usuario']['area'][$area] > 0) || $publica ){

          // SELECT
          $res = $c::table($tabla)->select( array($c::raw( 'SQL_CALC_FOUND_ROWS '.$campos[0]) ) );
          unset($campos[0]);
          foreach ($campos as $key) { $res->addSelect( $c::raw( $key) ); }

          // WHERE
          if( isset( $params[1] ) ){
            if( is_numeric($params[1]) ){
              $res = $res->where('id', '=', $params[1]);
              /* At least [ ,1 ] */
            }else if(strlen($params[1]) > 2){
              list( $key, $val ) = explode(",",  $params[1]);
              $res = $res->where($key, '=', $val );
            }
          }

          // Skip / Take
          if( isset($params[2]) && isset($params[3])){
            if( is_numeric($params[2]) && is_numeric($params[3])){
              $res = $res->offset($params[2])->limit($params[3]);
            }
          }

          $r['items'] = $res->get();

          $cuenta  = reset($c::select( $c::raw("SELECT FOUND_ROWS() as 'total' ") ) );
          $r['total'] = $cuenta->total;

        }else{

          $r['ack'] = 403;
          $r['msg'] = "Acceso denegado";

        }
      }
      return $response->withJson( $r );
   }
}
