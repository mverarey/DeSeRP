<?
$this->establecerTitulo("Restaurar usuario");

$c = new DepotServer\Conexion();

if(strlen($this->os(4)) > 0){
	$id = $this->os(4);
	$res = $c->query("UPDATE Usuarios SET activo = 1 WHERE id = ".$id." LIMIT 1;");
	if($res){
		echo $this->msgOK("Usuario restaurado exitosamente!");
	}else{
		echo $this->msgError("No se realiz&ooacute; el alta!");
	}
}

$res = $c->query("SELECT id, nombre, email, usuario FROM Usuarios WHERE activo = 0;");
$u = "<table class='datos' width='100%'><thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Usuario</th><th>Restaurar</th></tr></thead><tbody>";
while($fila = mysql_fetch_assoc($res)){
	$u .= "<tr>";
	foreach($fila as $val){ $u .= "<td>".$val."</td>"; }
	$u .= "<td class='Recuperar'><a href='/app/".$this->os(2)."/recuperar/".$fila['id']."'>Restaurar</a></td></tr>";
}
$u .= "</tbody></table>";

$this->ev("usuarios",$u);
$this->ev("os2",$this->os(2))
?>