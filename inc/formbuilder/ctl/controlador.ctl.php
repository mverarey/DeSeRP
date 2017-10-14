<?
$response = array();
$response["ack"] = 0;

$c = new Conexion();
switch( $_REQUEST['acc'] ){
	case "crear":
		$res = $c->insertar("test_formbuilder",
					array(  NULL,  $_REQUEST['txtcampo'],  $_REQUEST['txtnumero'],  $_REQUEST['txttextolargo'],  )
				);
		if($res){
			$response['ack'] = 200;
			$response['msg'] = "Se registro el objeto correctamente con el id ".$res.".";
		}else{
			$response['msg'] = "Ocurrió un error, inténtelo nuevamente.";
		}
	break;
	
	case "actualizar":
		$res = $c->actualizar("test_formbuilder",
				array(
					  "campo" => $_REQUEST['campo'],  "numero" => $_REQUEST['numero'],  "textolargo" => $_REQUEST['textolargo'], 
				),
				$_REQUEST['idObjeto']
			);
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
		$res = $c->borrar("test_formbuilder",
				array(
					"id", $_REQUEST['idObjeto']
				)
			);
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

	default:
		$response['ack'] = 200;
		$response['req'] = print_r($_REQUEST);
	break;
}
echo json_encode($response);
?>