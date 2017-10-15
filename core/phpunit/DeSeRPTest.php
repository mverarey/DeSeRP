<?php namespace DepotServer;

use  \PHPUnit\Framework\TestCase;

class DeSeRPTest extends TestCase
{
	public function testFormat(){
		echo "Format";
		$num = rand(1000,9999);
		$this->assertEquals( money_format('%(#10n', $num), \DepotServer\DeSeRP::formato('MONEDA', $num) );
	}
}