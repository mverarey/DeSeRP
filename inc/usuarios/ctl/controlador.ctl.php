<?
$response = array();
$response["ack"] = 0;

$db = new DepotServer\BaseDatos();

if( $_REQUEST['d'] == "fk" ){ $_REQUEST['acc'] = $_REQUEST['e']; }
switch( $_REQUEST['acc'] ){

	case "actualizar":
		$res = $db::table("usuarios")->where("id", $_REQUEST['idObjeto'])->update([ "nombre" => $_REQUEST['nombre'],  "email" => $_REQUEST['email'],  "servidorSMTP" => $_REQUEST['servidorSMTP'],  "passwordSMTP" => base64_encode($_REQUEST['passwordSMTP']),  "tema" => $_REQUEST['tema']  ]);
		if($res > 0){
			$response['ack'] = 200;
			$response['msg'] = "Se ha actualizado exitosamente.";
		}else if($res == 0){
			$response['ack'] = 201;
			$response['msg'] = "No se realizaron cambios al registro.";
		}else{
			$response['msg'] = "Ocurrió un error, inténtelo nuevamente.";
		}

		if(strlen($_REQUEST['password']) > 0){
			$response['ack'] = 200;
			$res = $db::table("usuarios")->where("id", $_REQUEST['idObjeto'])->update([ "password" => md5($_REQUEST['password']) ]);
			$response['msg'] = $response['msg']." Se actualizó la contraseña.";
		}
	break;

	case "eliminar":
		$res = $db::table('usuarios')->where("id", $_REQUEST['idObjeto'] )->update(['activo'=>0]);
		if($res > 0){
			$response['ack'] = 200;
			$response['msg'] = "Se ha desactivado exitosamente.";
			$this->agregarRegistro("Diste de baja en el sistema al id de usuario  <strong>".$_REQUEST['idObjeto']."</strong>.");

		}else if($res == 0){
			$response['ack'] = 200;
			$res = $db::table('usuarios')->where("id", $_REQUEST['idObjeto'] )->update(['activo'=>1]);
			$response['msg'] = "Se ha activado exitosamente.";
			$this->agregarRegistro("Reactivaste en el sistema al id de usuario  <strong>".$_REQUEST['idObjeto']."</strong>.");
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
