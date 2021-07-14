<?php
$dirname = dirname(__DIR__,1);
require_once $dirname.'\db_connection.php';
use PHPUnit\Framework\TestCase;
class db_connectionTest extends TestCase {
	/*
	* @test
	*/
	public function test_connection(){
		$conn = OpenCon();
		$this->assertInstanceOf(mysqli::class,$conn);
		CloseCon($conn);
	}
}
?>