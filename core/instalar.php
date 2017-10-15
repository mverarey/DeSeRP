<?php
/*
 * This file is part of DeSeRP.
 *
 * @author Mauricio Vera <m.vera@depotserver.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

function solicitarParametro($default = ""){
	$handle = fopen ("php://stdin","r");
	$line = fgets($handle);
	if(strlen(trim($line)) == 0){
		$line = $default;
	}
	fclose($handle);
	return trim($line);
}
// Instalar
echo <<<pantalla
===================================================
|| ######          #####         ######  ######  ||
|| #     # ###### #     # ###### #     # #     # ||
|| #     # #      #       #      #     # #     # ||
|| #     # #####   #####  #####  ######  ######  ||
|| #     # #            # #      #   #   #       ||
|| #     # #      #     # #      #    #  #       ||
|| ######  ######  #####  ###### #     # #       ||
===================================================

Iniciando instalación...
Generando archivo de configuración...\n\n
pantalla;
bd:
echo <<<pantalla
BASE DE DATOS
=============
Ingrese la dirección del servidor [localhost]: 
pantalla;
$servidor = solicitarParametro("localhost");
echo "Ingrese el nombre de usuario [root]: ";
$usuario = solicitarParametro("root");
echo "Ingrese la contraseña []: ";
$password = solicitarParametro("");
$passlen = (strlen($password) > 0 ? str_repeat("*", strlen($password)) : "- sin contraseña -");
echo "Ingrese la base de datos [deserp]: ";
$bd = solicitarParametro("deserp");

echo <<<pantalla
\nServidor SMTP
=============
Ingrese la dirección del servidor [localhost]: 
pantalla;
$smtp_host = solicitarParametro("localhost");
echo "Ingrese el número de puerto [25]: ";
$smtp_port = solicitarParametro("25");


echo <<<configuracion

===============
|CONFIRMACIÓN |
===============
Base de datos
----------------------------
Servidor: $servidor
Usuario: $usuario
Contraseña: $passlen

Base de datos
----------------------------
Servidor: $smtp_host:$smtp_port

¿Es correcta la información? [si/no]:
configuracion;
if( solicitarParametro("no") == "no" ){
	goto bd;
}else{
	echo "¡Instalación completada exitosamente!\n";
}