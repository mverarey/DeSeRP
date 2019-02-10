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
use DepotServer\DeSeRP;
use DepotServer\Router;

$uri = Router::uri();
if($uri['a'] == "json" || $uri['a'] == "jsonp" || $uri['a'] == "xlsx"){
	/* Start JSON API */
	require_once("jsonapi.php");
}else{
	/* Start DeSeRP */
	echo $d = new DeSeRP( $uri );
}
