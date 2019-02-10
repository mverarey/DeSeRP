<?
$response = array();
$response["ack"] = 0;

$db = new DepotServer\BaseDatos();

if( $_REQUEST['d'] == "fk" ){ $_REQUEST['acc'] = $_REQUEST['e']; }
switch( $_REQUEST['acc'] ){
	
	case "actualizar":
		$res = $db::table("dstick_cliente")->where("id", $_REQUEST['idObjeto'])->update([  "nombre" => $_REQUEST['nombre'],  "razonSocial" => $_REQUEST['razonSocial'],  "logotipo" => $_REQUEST['logotipo'],  ]);
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
		$res = $db::table('dstick_cliente')->where("id", $_REQUEST['idObjeto'] )->delete();
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
	break;
}
header('Content-Type: application/json');
echo json_encode($response);
?>