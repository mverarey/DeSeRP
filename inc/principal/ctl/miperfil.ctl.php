<?php namespace DepotServer;
use \Imagine\Image\Box;

$this->establecerTitulo("Datos de mi usuario");

$c = new Conexion();

if(strlen($this->req['nombre']) > 0){

	$id = $this->req['id'];
	$nombre = $this->req['nombre'];
	$email = $this->req['email'];
	$servidor = $this->req['servidor'];
	$password = base64_encode($this->req['passmail']);
	$tema = $this->req['tema'];

	$res = $c->actualizar("usuarios", array( "nombre" => $nombre, "email" => $email, "servidorSMTP" => $servidor, "passwordSMTP" => $password, "tema" => $tema), $id, true);
	if($res){

		$_SESSION['usuario']['nombre'] = $nombre;
		$_SESSION['usuario']['email'] = $email;
		$_SESSION['usuario']['tema'] = $tema;

		echo $this->msgOK("Cambios realizados exitosamente!");
	}
	
	if(strlen($this->req['password']) > 0){
		$res = $c->actualizar("usuarios", array( "password" => md5($this->req['password']) ), $id, true);
		if($res){
			echo $this->msgOK("Cambio de contrase&ntilde;a realizado exitosamente!");
		}else{
			echo $this->msgError("No se realizó el cambio de contrase&ntilde;a!");
		}
	}
}

if(strlen($_FILES['file']['name']) > 0){

	$stream = fopen($_FILES['file']['tmp_name'], 'r+');
	$archivo = 'perfil_'.md5('perfil_'.$_SESSION['usuario']['id']);
	$path = 'tmp/imgs/';

	$imagine = new \Imagine\Gd\Imagine();
	try{
		$img = $imagine->open($_FILES['file']['tmp_name']);
		$this->filesystem->escribirArchivo( $archivo.'_thumb.jpg', $img->thumbnail(new Box(140, 140), \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND)->get('jpg'),  $path, true); 
		$this->filesystem->escribirArchivo( $archivo.'.jpg', $img->get('jpg'), $path, true); 
		if( $this->filesystem->existeArchivo($path.$archivo.'.jpg') ){
			$_SESSION['usuario']['imagen'] = '/'.$path.$archivo.'_thumb.jpg';
			http_response_code (200);
			$output['ok'] = "Cargado";
		}else{
			http_response_code (401);
			$output['error'] = 'Ocurrió un error';
		}
	}catch(\Exception $e){
		http_response_code (401);
		$output['error'] = 'Ocurrió un error. '.$e->getMessage();
	}
	fclose($stream);
	header( 'Content-Type: application/json; charset=utf-8' );
	echo json_encode( $output );
	exit;
}

$res = $c->query("SELECT * FROM usuarios WHERE md5(id) = '".md5($_SESSION['usuario']['id'])."'");
$fila = get_object_vars($res[0]);

$this->ev("id", $fila['id']);
$this->ev("nombre", $fila['nombre']);
$this->ev("usuario", $fila['usuario']);
$this->ev("email", $fila['email']);
$this->ev("servidor", $fila['servidorSMTP']);
$this->ev("passmail", base64_decode($fila['passwordSMTP']));
$this->ev("temaPred", "selected");
$this->ev("fotoperfil", $_SESSION['usuario']['imagen']);

$this->agregarArchivoScript("/assets/dropzonejs/dist/dropzone.js");
$this->agregarCSS("/assets/dropzonejs/dist/dropzone.css");

$scr = <<<Script
	//$("#frm").validate();
	$(".passt").click(function(){
		$(".password").removeAttr("disabled");
		$(".rpassword").removeAttr("disabled");
	});

	$("#btnFoto").click(function(){
		$(".perfilActual").hide();
		$("#frmFoto").show().removeClass("hidden");
	});

	$("#txttema").val("{$_SESSION['usuario']['tema']}");
Script;
$this->agregarScript($scr);

?>