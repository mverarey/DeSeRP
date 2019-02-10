<?php
$publica = false;
$tabla = "dstick_proyecto";
$campos = ["dstick_proyecto.id", "idLiderProyecto", "idCategoria", "idCliente", "dstick_proyecto.nombre", "descripcion", "fechaCreacion", "fechaInicio", "fechaFin", "estado"];

$joins = [
	[ "tabla" => "usuarios", "col_origen" => "idLiderProyecto",	"col_destino" => "id", "col_mostrar" => "usuarios.nombre"]
];