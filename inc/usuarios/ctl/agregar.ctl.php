<?
$this->establecerTitulo("Agregar nuevo usuario");

if(strlen($_REQUEST['txtusuario'])>0 && strlen($_REQUEST['txtpassword']) >0){
	$c = new DepotServer\Conexion();
	$id_nuevo = $c->insertar("Usuarios", array(NULL, strtoupper($_REQUEST['txtusuario']), md5($_REQUEST['txtpassword']), $_REQUEST['txtnombre'],$_REQUEST['txtemail'],$_REQUEST['txtservidor'],base64_encode($_REQUEST['txtpassmail']),$_REQUEST['txttema'],$_REQUEST['fecha_creacion'],1));
	if($id_nuevo > 0){
		echo $this->msgOk("<p>El usuario ha sido registrado exitosamente con el id ".$id_nuevo.".</p>");
		echo $this->msgInfo("<p>No olvide asignar permisos a este usuario.</p><p><a href='/app/permisos/Modificar/".$id_nuevo."' >Permisos</a></p>");
	}else{
		echo $this->msgError("<p>Ocurri&oacute; un error. Intente nuevamente. Recuerde que no pueden haber 2 usuarios con el mismo email.</p>");
	}
}

$script = <<<EOM
$("#txtusuario").mask("****?********");
$("#agregarUsuario").validate();
EOM;
$this->agregarScript($script);
?>
