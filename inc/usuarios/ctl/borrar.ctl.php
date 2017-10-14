<?
$this->establecerTitulo("Borrar usuario");

$c = new Conexion();
if($_SESSION['usuario']['id'] >= 100 && $his->req['d'] <= 100){ throw new Exception("No tiene permiso para modificar este usuario."); }


if(strlen($this->os(4)) > 0){
	$id = $this->os(4);
	$res = $c->query("UPDATE Usuarios SET activo = 0 WHERE id = ".$id." LIMIT 1;");
	if($res){
		echo $this->msgOK("Usuario eliminado exitosamente!");
	}else{
		echo $this->msgError("No se realiz&ooacute; la baja!");
	}
}

$res = $c->query("SELECT * FROM Usuarios WHERE activo = 1 AND md5(id) = '".md5($this->req['d'])."'");

while($fila = mysql_fetch_assoc($res)){
	$this->ev("id", $fila['id']);
	$this->ev("nombre", $fila['nombre']);
	$this->ev("usuario", $fila['usuario']);
	$this->ev("email", $fila['email']);
//	$this->ev("datos", "<p>info del usuario</p>");
}

if($_SESSION['usuario']['id'] >= 100){
	$res = $c->query("SELECT id, nombre, email, usuario FROM Usuarios WHERE activo = 1 AND id > 100;");
}else{
	$res = $c->query("SELECT id, nombre, email, usuario FROM Usuarios WHERE activo = 1;");
}
$u = "<table class='datos tbldatos' width='100%'><thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Usuario</th><th>Borrar</th></tr></thead><tbody>";
while($fila = mysql_fetch_assoc($res)){
	$u .= "<tr>";
	foreach($fila as $val){ $u .= "<td>".$val."</td>"; }
	$u .= "<td class='Borrar'><a href='/app/".$this->os(2)."/borrar/".$fila['id']."'>Borrar</a></td></tr>";
}
$u .= "</tbody></table>";

$this->ev("usuarios",$u);
$this->ev("os2",$this->os(2))
?>