<?php
$publica = false;
$tabla = "dstick_cliente";
$campos = ["dstick_cliente.id", "dstick_cliente.nombre", "dstick_cliente.razonSocial", "dstick_cliente.logotipo"];
/*
TODO: CAMBIAR JOINS
$joins = [
	['tabla' => 'dstick_cliente_usuario', 'col_origen' => 'idCliente', 'col_destino' => 'id', 'col_mostrar' => 'dstick_cliente.idCliente' ],
	['tabla' => 'usuarios', 'col_origen' => 'idUsuario', 'col_destino' => 'id', 'col_mostrar' => 'usuarios.nombre' ],
];
*/