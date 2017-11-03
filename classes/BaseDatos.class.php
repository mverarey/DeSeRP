<?php namespace DepotServer;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
/**
 * BaseDatos
 *
 * Clase manipuladora de toda la información que pasa desde y hacia la base de datos.
 *
 * @access       public
 * @author       Mauricio Vera <m.vera@depotserver.com>
 * @copyright    DepotServer 2015
 * @name         DeSeRP
 * @class		 Conexion
 * @since		3.0
 * @version		3.0
 */
class BaseDatos extends Manager{

	/*
	 * Constructor
	 *
	 * Inicializa la conexión a la base de datos.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	__construct
	 * @package	DeSeRP
	 * @version	0.1
	 * @since	0.1
	 * @param	string $servidor Nombre del servidor
	 * @param	string $usuario Nombre del usuario
	 * @param	string $password Contraseña de ingreso
	 * @param	string $db Nombre de la base de datos
	 */
	public function __construct($servidor = '', $usuario = '', $password = '', $db = '',
		$driver = '', $prefix ='', $charset = '', $collation =''){

		parent::__construct();

		$c = new Configuracion;

		if(strlen($servidor)>0 && strlen($usuario)>0){

			$this->addConnection([
			    'driver'    => strlen($driver) > 0 ? $driver : $c->driver,
			    'host'      => strlen($servidor) > 0 ? $servidor : $c->servidor,
			    'database'  => strlen($db) > 0 ? $db : $c->db,
			    'username'  => strlen($usuario) > 0 ? $usuario : $c->usuario,
			    'password'  => strlen($password) > 0 ? $password : $c->password,
			    'charset'   => strlen($charset) > 0 ? $charset : $c->charset,
			    'collation' => strlen($collation) > 0 ? $collation : $c->collation,
			    'prefix'    => strlen($prefix) > 0 ? $prefix : $c->prefix,
			]);

		}else{

			$this->addConnection([
			    'driver'    => $c->driver,
			    'host'      => $c->servidor,
			    'database'  => $c->db,
			    'username'  => $c->usuario,
			    'password'  => $c->password,
			    'charset'   => $c->charset,
			    'collation' => $c->collation,
			    'prefix'    => $c->prefix,
			]);

		}

		$this->setAsGlobal();
	}


	/*
	 * login
	 *
	 * Esta function realiza, de manera segura, la validaci�n de ingreso al sistema.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	login
	 * @package	DeSeRP
	 * @return	mysql_result
	 * @version	0.1
	 * @since	0.1
	 * @param	string $usuario Nombre del usuario
	 * @param 	string $password Contrase�a del usuario
	 */
	public function login($usuario,$password){
		return $this::table('usuarios')->where([ ['usuario', 'like', strtoupper($usuario)], ['password', 'like', md5($password)] ])->first();
	}
}?>
