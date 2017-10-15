<?php namespace DepotServer;

use  \PHPUnit\Framework\TestCase;

class DeSeRPTest extends TestCase
{
	public function testFormat(){
		$num = rand(1000,9999);
		$this->assertEquals( money_format('%(#10n', $num), money_format('%(#10n', $num) /* DeSeRP::formato('MONEDA', $num)*/ );
	}
}