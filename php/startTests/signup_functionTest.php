<?php
$dirname = dirname(__DIR__,1);
require_once $dirname.'\signup_function.php';
require_once $dirname.'\db_connection.php';
use PHPUnit\Framework\TestCase;
class signup_functionTest extends TestCase {
	/*
	* @test
	*/
	public function test_signupVet(){
        //sample data
        $conn=OpenCon();
        $_POST = array('uname'=>'testVetUname','psw'=>md5('testPSW'), 'vetid'=>'99999999','first_name'=>'vetFirst','last_name'=>'vetLast');
		$sql_search_vet = "SELECT email_vet FROM VETS WHERE email_vet= '$_POST[uname]'";
        $this->assertNotEquals(false,vet_signup($conn,$sql_search_vet));
	}

    /*
    * @test
    */
    public function test_signupClient(){
        //sample data
        $conn=OpenCon();
        $_POST = array('uname'=>'testClientUname','psw'=>md5('testPSW'),'first_name'=>'clientFirst','last_name'=>'clientLast','address'=>'clientHouse');
		$sql_search_user = "SELECT email FROM USERS WHERE email= '$_POST[uname]'";
        $this->assertNotEquals(false,client_signup($conn,$sql_search_user));
    }

    /*
    * @test
    */
    public function test_signupForm_mismatchPassword(){
        $_POST = array('uname'=>'validemail@gmail.com','psw'=>md5('testPassword'),'psw-repeat'=>md5('notTheSame'));
        $this->assertEquals(4,user_signup());
    }

    /*
    * @test
    */
    public function test_signupForm_invalidEmail(){
        $_POST = array('uname'=>'thisIsAnInvalidEmail', 'psw'=>md5('test'),'psw-repeat'=>md5('test'));
        $this->assertEquals(1,user_signup());
    }
}
?>