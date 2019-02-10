<?
$response = array();
$response["ack"] = 0;

$db = new DepotServer\BaseDatos();

if( $_REQUEST['d'] == "fk" ){ $_REQUEST['acc'] = $_REQUEST['e']; }
switch( $_REQUEST['acc'] ){
	
	case "actualizar":
		$res = $db::table("dstick_proyecto")->where("id", $_REQUEST['idObjeto'])->update([  "idLiderProyecto" => $_REQUEST['idLiderProyecto'],  "idCategoria" => $_REQUEST['idCategoria'],  "idCliente" => $_REQUEST['idCliente'],  "nombre" => $_REQUEST['nombre'],  "descripcion" => $_REQUEST['descripcion'],  "fechaCreacion" => $_REQUEST['fechaCreacion'],  "fechaInicio" => $_REQUEST['fechaInicio'],  "fechaFin" => $_REQUEST['fechaFin'],  "estado" => $_REQUEST['estado'],  ]);
		if($res > 0){
			$response['ack'] = 200;
			$response['msg'] = "Se ha actualizado exitosamente.";
		}else if($res == 0){
			$response['ack'] = 201;
			$response['msg'] = "No se realizaron cambios.";
		}else{
			$response['msg'] = "Ocurrió un error, inténtelo nuevamente.";
		}
	break;
	
	case "eliminar":
		$res = $db::table('dstick_proyecto')->where("id", $_REQUEST['idObjeto'] )->delete();
		if($res > 0){
			$response['ack'] = 200;
			$response['msg'] = "Se ha eliminado exitosamente.";
		}else if($res == 0){
			$response['ack'] = 201;
			$response['msg'] = "No se realizaron cambios.";
		}else{
			$response['msg'] = "Ocurrió un error, inténtelo nuevamente.";
		}
	break;

	case "fk_0":

		$valor = "dstick_diccionario.titulo"; /* CAMBIAR POR CAMPO DE TEXTO */
		$tabla = "dstick_diccionario"; $columna = "id"; $idfk = $_REQUEST['fk'];
		$objs = $db::table($tabla)->select($columna.' as id', $db::raw($valor.' as text'))->where("diccionario","categoria");
		if(strlen($_REQUEST['q']) >0 ){ $objs = $objs->where( $db::raw($valor), 'like', '%'.$_REQUEST['q'].'%');
		}else if(strlen($_REQUEST['f']) >0 ){ $objs = $objs->where($columna, $_REQUEST['f'] ); }
		$objs = $objs->limit(100)->get()->all();
		$response['results'] = $objs;

	break;	case "fk_1":

		$valor = "dstick_cliente.nombre"; /* CAMBIAR POR CAMPO DE TEXTO */
		$tabla = "dstick_cliente"; $columna = "id"; $idfk = $_REQUEST['fk'];
		$objs = $db::table($tabla)->select($columna.' as id', $db::raw($valor.' as text'));
		if(strlen($_REQUEST['q']) >0 ){ $objs = $objs->where( $db::raw($valor), 'like', '%'.$_REQUEST['q'].'%');
		}else if(strlen($_REQUEST['f']) >0 ){ $objs = $objs->where($columna, $_REQUEST['f'] ); }
		$objs = $objs->limit(100)->get()->all();
		$response['results'] = $objs;

	break;	case "fk_2":

		$valor = "usuarios.nombre"; /* CAMBIAR POR CAMPO DE TEXTO */
		$tabla = "usuarios"; $columna = "id"; $idfk = $_REQUEST['fk'];
		$objs = $db::table($tabla)->select($columna.' as id', $db::raw($valor.' as text'));
		if(strlen($_REQUEST['q']) >0 ){ $objs = $objs->where( $db::raw($valor), 'like', '%'.$_REQUEST['q'].'%');
		}else if(strlen($_REQUEST['f']) >0 ){ $objs = $objs->where($columna, $_REQUEST['f'] ); }
		$objs = $objs->limit(100)->get()->all();
		$response['results'] = $objs;

	break;

	default:
		$response['ack'] = 200;
	break;
}
header('Content-Type: application/json');
echo json_encode($response);
?>