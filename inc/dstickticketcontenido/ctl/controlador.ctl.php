<?
$response = array();
$response["ack"] = 0;

$db = new DepotServer\BaseDatos();

if( $_REQUEST['d'] == "fk" ){ $_REQUEST['acc'] = $_REQUEST['e']; }
switch( $_REQUEST['acc'] ){
	
	case "actualizar":
		$res = $db::table("dstick_ticket_contenido")->where("id", $_REQUEST['idObjeto'])->update([  "idTicket" => $_REQUEST['idTicket'],  "idUsuario" => $_REQUEST['idUsuario'],  "contenido" => $_REQUEST['contenido'],  "fechaPublicacion" => $_REQUEST['fechaPublicacion'],  "adjuntos" => $_REQUEST['adjuntos'],  ]);
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
		$res = $db::table('dstick_ticket_contenido')->where("id", $_REQUEST['idObjeto'] )->delete();
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

		$valor = "dstick_ticket.titulo"; /* CAMBIAR POR CAMPO DE TEXTO */
		$tabla = "dstick_ticket"; $columna = "id"; $idfk = $_REQUEST['fk'];
		$objs = $db::table($tabla)->select($columna.' as id', $db::raw($valor.' as text'));
		if(strlen($_REQUEST['q']) >0 ){ $objs = $objs->where( $db::raw($valor), 'like', '%'.$_REQUEST['q'].'%');
		}else if(strlen($_REQUEST['f']) >0 ){ $objs = $objs->where($columna, $_REQUEST['f'] ); }
		$objs = $objs->limit(100)->get()->all();
		$response['results'] = $objs;

	break;	case "fk_1":

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