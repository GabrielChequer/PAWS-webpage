<?php
$dirname = dirname(__DIR__,1);
require_once $dirname.'\login_function.php';
use PHPUnit\Framework\TestCase;
class login_functionTest extends TestCase {
	/*
	* @test
	*/
	public function test_loginVet(){
        //sample data
        $_POST = array('uname'=>'testVetUname','psw'=>md5('testPSW'),'vetLogId'=>'99999999');
		$this->assertEquals(1,vet_login());
	}

    /*
    * @test
    */
    public function test_loginClient(){
        //sample data
        $_POST = array('uname'=>'testClientUname','psw'=>md5('testPSW'));
		$this->assertEquals(1,client_login());
    }

    /*
    * @test
    */
    public function test_loginNotFoundVet(){
        $_POST = array('uname'=>'nameNotFound','psw'=>md5('test'),'vetLogId'=>'0');
        $this->assertEquals(2,vet_login());
    }

    /*
    * @test
    */
    public function test_loginNotFoundClient(){
        $_POST = array('uname'=>'nameNotFound','psw'=>md5('test'));
        $this->assertEquals(2,client_login());
    }
}
?>