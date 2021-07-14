<?php
$dirname = dirname(__DIR__,1);
require_once $dirname.'\logout.php';
use PHPUnit\Framework\TestCase;
class logoutTest extends TestCase {
	/*
	* @test
	*/
	public function test_logout(){
        //sample data
		$this->assertTrue(logout());
	}
}
?>