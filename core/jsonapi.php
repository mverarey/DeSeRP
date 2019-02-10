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
use DepotServer\Router;
use DepotServer\FileManager;

$configuration = [ 'settings' => [
                    // Monolog settings
                    'logger' => [
                        'name' => 'DeSeRP',
                        'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../tmp/app.log',
                        'level' => \Monolog\Logger::DEBUG,
                    ],
                    // Slim Settings
                    'determineRouteBeforeAppMiddleware' => false,
                    'displayErrorDetails' => true,
                    ],
                 ];

$app = new \Slim\App($configuration);

// Set up dependencies
$container = $app->getContainer();

// Error Handler
$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
      $filesystem = new FileManager('../inc/principal/tpl');
      $archivo = "error.tpl.php";
      if($filesystem->existeArchivo($archivo)){
        $archivo = $filesystem->leerArchivo($archivo);
      }
      $mensaje = $exception->getMessage();
      $numError = $exception->getCode() > 0 ? $exception->getCode() : 500;

      return $container['response']->withStatus($numError)
                             ->withHeader('Content-Type', 'text/html')
                             ->write( str_replace(["{@error}", "{@mensaje}"], [$numError, $mensaje], $archivo) );
    };
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Service factory for the ORM
$container['db'] = function ($container) {
    $capsule = new DepotServer\BaseDatos;
    $capsule->bootEloquent();
    return $capsule;
};

// URI Controller
$container['url'] = function ($container) {
    return Router::uri();
};

$app->any('/json/{params:.*}', RoutesController::class . ':json');
$app->any('/xlsx/{params:.*}', RoutesController::class . ':xlsx');

/*
$app->group('/json', function () {

	$this->get('/hello/{name}', function (Request $request, Response $response) {
	    $name = $request->getAttribute('name');
	    $response->getBody()->write("Hello, $name");
	    return $response;
	});
	$this->get('/ds', function(Request $request, Response $response){
		return "Hola";
	});
});
*/

// Run app
$app->run();
