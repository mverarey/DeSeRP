<?
$this->establecerTitulo("Cat&aacute;logo de Usuarios");

$c = new DepotServer\Conexion();
if($_SESSION['usuario']['id'] >= 100){
	$res = $c->query("SELECT id, nombre, email, usuario FROM Usuarios WHERE activo = 1 AND id > 100;");
}else{
	$res = $c->query("SELECT id, nombre, email, usuario FROM Usuarios WHERE activo = 1;");
}
//$u = $c->obtenerTabla("Usuarios", array("id", "nombre", "email", "usuario",array('"Modificar"',0), "activo" ));
$u = "<table class='datos table table-striped' width='100%'><thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Usuario</th><th>Modificar</th></tr></thead><tbody>";
while($fila = mysql_fetch_assoc($res)){
	$u .= "<tr>";
	foreach($fila as $val){ $u .= "<td>".$val."</td>"; }
	$u .= "<td class='Modificar'><a href='./Modificar/".$fila['id']."'>Modificar</a></td></tr>";
}
$u .= "</tbody></table>";

$this->ev("usuarios",$u);
?>