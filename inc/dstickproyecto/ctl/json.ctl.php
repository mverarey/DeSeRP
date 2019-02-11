<?php
$publica = false;
$tabla = "dstick_proyecto";
$campos = ["dstick_proyecto.id", "dstick_proyecto.idLiderProyecto", "dstick_proyecto.idCategoria", "dstick_proyecto.idCliente", "dstick_proyecto.nombre", "dstick_proyecto.descripcion", "dstick_proyecto.fechaCreacion", "dstick_proyecto.fechaInicio", "dstick_proyecto.fechaFin", "dstick_proyecto.estado"];
$joins = [['tabla' => 'dstick_diccionario', 'col_origen' => 'idCategoria', 'col_destino' => 'id', 'col_mostrar' => 'dstick_diccionario.titulo' ],['tabla' => 'dstick_cliente', 'col_origen' => 'idCliente', 'col_destino' => 'id', 'col_mostrar' => 'dstick_cliente.nombre' ],['tabla' => 'usuarios', 'col_origen' => 'idLiderProyecto', 'col_destino' => 'id', 'col_mostrar' => 'usuarios.nombre' ],];