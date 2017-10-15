<?php
/*
 * This file is part of DeSeRP.
 *
 * @author Mauricio Vera <m.vera@depotserver.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
require_once("vendor/autoload.php");

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
|| #     # #####  #     # #####  #     # #     # ||
|| #     # #    # #      #     # #     # #     # ||
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
$params['servidor'] = solicitarParametro("localhost");
echo "Ingrese el nombre de usuario [root]: ";
$params['usuario'] = solicitarParametro("root");
echo "Ingrese la contraseña []: ";
$params['password'] = solicitarParametro("");
$params['passlen'] = (strlen($params['password']) > 0 ? str_repeat("*", strlen($params['password'])) : "- sin contraseña -");
echo "Ingrese la base de datos [deserp]: ";
$params['db'] = solicitarParametro("deserp");

echo <<<pantalla
\nServidor SMTP
=============
Ingrese la dirección del servidor [localhost]: 
pantalla;
$params['smtp_host'] = solicitarParametro("localhost");
echo "Ingrese el número de puerto [25]: ";
$params['smtp_port'] = solicitarParametro("25");
echo "Requiere autenticación [si/no]: ";
$params['smtp_auth'] = (solicitarParametro("si") == "si" ? 'true' : 'false');
echo "Usuario []: ";
$params['smtp_usuario'] = solicitarParametro("");
echo "Contraseña []: ";
$params['smtp_password'] = solicitarParametro("");
$params['smtp_passlen'] = (strlen($params['smtp_password']) > 0 ? str_repeat("*", strlen($params['smtp_password'])) : "- sin contraseña -");
$params['smtp_persist'] = 'false';

echo <<<pantalla
\nDatos Generales
=============
Ingrese la dirección de acceso [https://localhost]: 
pantalla;
$params['url_absoluta'] = solicitarParametro("https://localhost");
echo "Locale [es_MX]: ";
$params['locale'] = solicitarParametro("es_MX");
echo "Modo Debug [si/no]: ";
$params['debug'] = (solicitarParametro("no") == "si" ? true : false);

echo <<<configuracion

===============
|CONFIRMACIÓN |
===============
Base de datos
----------------------------
Servidor: {$params['servidor']}
Usuario: {$params['usuario']}
Contraseña: {$params['passlen']}
Base de Datos: {$params['bd']}

Servidor SMTP
----------------------------
Servidor: {$params['smtp_host']}:{$params['smtp_port']}
Usuario: {$params['smtp_usuario']}
Contraseña: {$params['smtp_passlen']}

Datos Generales
----------------------------
Url absoluta: {$params['url_absoluta']}
Locale: {$params['locale']}
Modo debug: {$params['debug']}

¿Es correcta la información? [si/no]:
configuracion;
if( solicitarParametro("no") == "no" ){
	goto bd;
}

crearArchivoConfiguracion($params);

echo <<<pantalla
Archivo de configuración generado.\n

Instalando Base de Datos...\n
pantalla;

echo "¡Instalación completada exitosamente!\n";


function crearArchivoConfiguracion($params){

	$archivoCont = <<<EOM
<?php namespace DepotServer;

/**
 * Configuración
 *
 * NOTA IMPORTANTE:
 * Este archivo deberá ser configurado como SOLO-LECTURA durante la 
 * instalación. Si hace cambios en el archivo, asegurese de protegerlo
 * nuevamente despues de hacer los cambios.
 *
 * @access       public
 * @author       Mauricio Vera <m.vera@depotserver.com>
 * @copyright    DepotServer 2010
 * @name         Configuracion
 * @since		0.1_beta
 * @var			array	servidor, usuario, password, db, debug
 * @version		5.0
 */
class Configuracion{

	// Base de Datos	
	var \$servidor = "{$params['servidor']}";
	var \$usuario = "{$params['usuario']}";
	var \$password = "{$params['password']}";
	var \$db = "{$params['db']}";

	// SMTP
	var \$smtp_host = "{$params['smtp_host']}";
	var \$smtp_port = "{$params['smtp_port']}";
	var \$smtp_auth = {$params['smtp_auth']};
	var \$smtp_usuario = "{$params['smtp_usuario']}";
	var \$smtp_password = "{$params['smtp_password']}";
	var \$smtp_persist = {$params['smtp_persist']};
	
	// Generales
	var \$url_absoluta = "https://localhost";
	var \$locale = "es_MX";
	var \$debug = false;
}
?>
EOM;

	$filesystem = new \DepotServer\FileManager('../');
	$archivo = 'Configuracion_AutoGenerado.class.php';
	$path = 'classes/';
	$filesystem->escribirArchivo( $archivo, $archivoCont,  $path, true); 
	
	if( !$filesystem->existeArchivo($path.$archivo) ){
		echo "No se pudo crear archivo. Intentando de nuevo.";
		exit;
	}

}