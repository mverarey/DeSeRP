<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$tabla = "accesos";
$c = new DepotServer\BaseDatos();
$input = json_decode(file_get_contents('php://input'), true);

$limit = 10; if(isset($input["limit"])) { $limit = $input["limit"]; }
$offset = 0; if(isset($input["offset"])) { $offset = $input["offset"]; }

$res = $c::table($tabla)->leftJoin('usuarios', 'usuarios.id', '=', $tabla.'.idUsuario')->select( array($c::raw( 'SQL_CALC_FOUND_ROWS '.$tabla.'.*, usuarios.usuario, usuarios.nombre' ) ) );
if(isset($input["search"])) {
	$search = '%'.$input["search"].'%';
	$res = $res->where('id', 'like', $search)->orWhere('idUsuario', 'like', $search)->orWhere('area', 'like', $search)->orWhere('fecha', 'like', $search);
}

if( isset($input["sort"]) ){ $res = $res->orderBy($input["sort"], $input["order"]); }
$res = $res->take($limit);
if($offset > 0){ $res = $res->skip($offset); }
$res = $res->get()->all();
$cuenta  = reset($c::select( $c::raw("SELECT FOUND_ROWS() as 'total' ") ) );

echo "{";
echo '"total": ' . $cuenta ->total. ',';
echo '"rows": ';
echo json_encode($res);
echo "}";
