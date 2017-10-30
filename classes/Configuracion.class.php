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
	var $servidor = "localhost";
	var $usuario = "root";
	var $password = '';
	var $db = "tipi_proto";

	// + v. 3.0
	var $driver = "mysql";
	var $charset = "utf8";
	var $collation = "utf8_unicode_ci";
	var $prefix = "";

	// SMTP
	var $smtp_host = "smtp.server.com";
	var $smtp_port = "26";
	var $smtp_auth = true;
	var $smtp_usuario = "";
	var $smtp_password = "";
	var $smtp_persist = FALSE;
	
	// Generales
	var $url_absoluta = "https://localhost";
	var $locale = "es_MX";
	var $debug = false;
	var $timezone = "America/Mexico_City";
}
?>
