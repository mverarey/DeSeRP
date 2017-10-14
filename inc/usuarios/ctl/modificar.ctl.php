<?
$this->establecerTitulo("Datos del usuario");

$c = new DepotServer\Conexion();
if($_SESSION['usuario']['id'] >= 100 && $his->req['d'] <= 100){ throw new Exception("No tiene permiso para modificar este usuario."); }

if(strlen($this->req['nombre']) > 0){
	
	$id = $this->req['id'];
	$nombre = $this->req['nombre'];
	$email = $this->req['email'];
	$servidor = $this->req['servidor'];
	$password = base64_encode($this->req['passmail']);
	$tema = $this->req['tema'];
	$res = $c->query("UPDATE Usuarios SET nombre = '".$nombre."', email = '".$email."', servidorSMTP = '".$servidor."', passwordSMTP = '".$password."', tema = '".$tema."' WHERE id = ".$id." LIMIT 1;");

	if($res){
		echo $this->msgOK("Cambios realizados exitosamente!");
	}
	
	if(strlen($this->req['password']) > 0){
		$res = $c->query("UPDATE Usuarios SET password = '".md5($this->req['password'])."' WHERE id = ".$id." LIMIT 1;");
		if($res){
			echo $this->msgOK("Cambio de contrase&ntilde;a realizado exitosamente!");
		}else{
			echo $this->msgError("No se realiz&ooacute; el cambio de contrase&ntilde;a!");
		}
	}
}

$res = $c->query("SELECT * FROM Usuarios WHERE md5(id) = '".md5($this->req['d'])."'");

while($fila = mysql_fetch_assoc($res)){
	$this->ev("id", $fila['id']);
	$this->ev("nombre", $fila['nombre']);
	$this->ev("usuario", $fila['usuario']);
	$this->ev("email", $fila['email']);
	$this->ev("servidor", $fila['servidorSMTP']);
	$this->ev("passmail", base64_decode($fila['passwordSMTP']));
	if($fila['tema'] == "fincomun"){
		$this->ev("temaFinC", "selected");
	}else if($fila['tema'] == "cnnm"){
        $this->ev("temaCnnm", "selected");
    }else{
		$this->ev("temaPred", "selected");
	}
//	$this->ev("datos", "<p>info del usuario</p>");
}

$scr = <<<Script
	$("#frm").validate();
	$(".passt").click(function(){
		$(".password").removeAttr("disabled");
		$(".rpassword").removeAttr("disabled");
	});
Script;
$this->agregarScript($scr);

?>