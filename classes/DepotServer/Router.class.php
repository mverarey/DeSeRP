<?php namespace DepotServer;

/**
 * Router
 *
 * Sistema de ruteo de información
 *
 * @access       public
 * @author       Mauricio Vera <m.vera@depotserver.com>
 * @copyright    DepotServer 2017
 * @name         DeSeRP
 * @since		3.5
 * @version		3.5
 */
class Router{

	public static function URI($url = ""){
		$req = $_REQUEST;
		if( strlen($url) == 0){
			$uri = $_SERVER["REQUEST_URI"];
		}
		$uri = reset(explode("?", $uri));
		$argsUri = explode("/", $uri);
		$inputs = json_decode(file_get_contents('php://input'), true) ?? [];
		//if( !empty($inputs) ){	if(sizeof($inputs) <= 0){ $inputs = []; } }else{ $inputs = []; }
		if(sizeof($argsUri) > 0){ 
			unset($argsUri[0]);
		}
		$alfabeto = range("a", "z");
		$letras = array_slice($alfabeto, 0, sizeof($argsUri));
		$args = array_combine($letras, $argsUri);
		return array_merge($req, $args, $inputs, array("uri" => $uri) );
	}
}
