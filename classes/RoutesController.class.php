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
   
   public function main(Request $request, Response $response, $args){
      $params = explode('/', $args['params'] );
      $area = $params[0];

      $r = array("ack" => 200, "request" => $args['params']);

      $archivo = "inc/".$area."/ctl/json.ctl.php";
      if ( $this->filesystem->existeArchivo($archivo) ){

        if( (!$publica && $_SESSION['usuario']['area'][$area] > 0) || $publica ){

          $c = new BaseDatos();
          require_once($archivo);
          
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
   
   public function contact($request, $response, $args) {
        // your code
        // to access items in the container... $this->container->get('');
        return $response;
   }
}