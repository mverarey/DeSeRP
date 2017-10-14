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

class RoutesController 
{
   protected $container;

   // constructor receives container instance
   public function __construct(SlimCont $container) {
       $this->container = $container;
   }
   
   public function main(Request $request, Response $response, $args){
	$params = explode('/', $args['params'] );
	return $response->withJson( array("Datos", "parametros" => $params) );
   }
   
   public function contact($request, $response, $args) {
        // your code
        // to access items in the container... $this->container->get('');
        return $response;
   }
}