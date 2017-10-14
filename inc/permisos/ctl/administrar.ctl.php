<?
$this->establecerTitulo("Administrar permisos");

$c = new Conexion();
$tabla = $c->obtenerTabla("Usuarios", 
							array('id','nombre','usuario', array('"Modificar"', 0)), 
							array('No.', 'Nombre', 'Usuario', '&nbsp;'));
$this->ev("tablaUsuarios",$tabla);
?>