<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', 1);
/*
 * This file is part of DeSeRP.
 *
 * @author Mauricio Vera <m.vera@depotserver.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Slim\{Container as SlimCont, App as Slim};
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use DepotServer\RoutesController;

$configuration = [ 'settings' => [ 'displayErrorDetails' => true, ], ];
$c = new SlimCont($configuration);
$app = new Slim($c);

$app->group('/json', function () {

	$this->get('/hello/{name}', function (Request $request, Response $response) {
	    $name = $request->getAttribute('name');
	    $response->getBody()->write("Hello, $name");
	    return $response;
	});
	$this->get('/ds', function(Request $request, Response $response){	
		return "Hola";
	});

	$this->get('[/{params:.*}]', RoutesController::class . ':main');
});
$app->run();