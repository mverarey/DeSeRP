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

	private $db;

	public function DSTickets(){
		$this->db = new DepotServer\BaseDatos;
    	$this->db->bootEloquent();
	}

	public function obtenerTicketsDelProyecto($idProyecto){
		$db = $this->db;
		return $db::table("dstick_ticket")->where("idProyecto",$idProyecto)->get()->all();
	}
}