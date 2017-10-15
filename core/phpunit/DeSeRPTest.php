<?php namespace DepotServer;

require __DIR__ . "/../../classes/DeSeRP.class.php";
require __DIR__ . "/../../classes/Conexion.class.php";

use  \PHPUnit\Framework\TestCase;

class DeSeRPTest extends TestCase
{
	public function testFormat(){
		$num = rand(1000,9999);
		$this->assertEquals( money_format('%(#10n', $num), DeSeRP->formato('MONEDA', $num) );
	}

	public function testDataBaseObject(){
		$c = new Conexion("localhost", "root", "", "tipi_proto");
		$this->assertTrue($c instanceof Conexion);
	}
}