<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$tabla = "usuarios";
$c = new DepotServer\BaseDatos();
$input = json_decode(file_get_contents('php://input'), true);

$limit = 10; if(isset($input["limit"])) { $limit = $input["limit"]; }
$offset = 0; if(isset($input["offset"])) { $offset = $input["offset"]; }

$res = $c::table($tabla)->select( array($c::raw( 'SQL_CALC_FOUND_ROWS '.$tabla.'.*' ) ) );
if(isset($input["search"])) {
	$search = '%'.$input["search"].'%';
	$res = $res->where('id', 'like', $search)->orWhere('usuario', 'like', $search)->orWhere('password', 'like', $search)->orWhere('nombre', 'like', $search)->orWhere('email', 'like', $search)->orWhere('servidorSMTP', 'like', $search)->orWhere('passwordSMTP', 'like', $search)->orWhere('tema', 'like', $search)->orWhere('fecha_creacion', 'like', $search)->orWhere('activo', 'like', $search);
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