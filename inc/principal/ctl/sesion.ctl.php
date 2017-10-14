<?php
if(strlen($_SESSION['usuario']['ultimaActualizacion']) > 0){
	$_SESSION['usuario']['ultimaActualizacion'] = date("d/m/y H:i");
	echo json_encode( array("ack" => 200, "ultimaActualizacion" => $_SESSION['usuario']['ultimaActualizacion'] ) );
}else{
	echo json_encode( array("ack" => 0, "ultimaActualizacion" => "Debe reiniciar su sesi&oacute;n" ) );
}
?>