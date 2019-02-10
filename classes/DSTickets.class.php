<?php namespace DepotServer;

/**
 * DSTickets
 *
 * Controlador de Tickets
 *
 * @access       public
 * @author       Mauricio Vera <m.vera@depotserver.com>
 * @copyright    DepotServer 2018
 * @name         DeSeRP
 * @since		3.5
 * @version		3.5
 */

use DepotServer\Configuracion;
use DepotServer\Conexion;
use DepotServer\BaseDatos;

class DSTickets{

	public function iniciarTickets(){
		$db = new BaseDatos;
		$db->bootEloquent();
		return $db;
	}

	public function obtenerTicketsDelProyecto($idProyecto){

		$db = $this->iniciarTickets();
		return $db::table("dstick_ticket")->where("idProyecto",$idProyecto)->get();
	}
}