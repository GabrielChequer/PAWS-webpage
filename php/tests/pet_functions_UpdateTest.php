<?php
$dirname = dirname(__DIR__,1);
require_once $dirname.'\pet_functions.php';
require_once $dirname.'\db_connection.php';
use PHPUnit\Framework\TestCase;
class pet_functions_UpdateTest extends TestCase {
	/*
	* @test
	*/
	public function test_updateWeight(){
		$conn=OpenCon();
        $ownerresult=mysqli_query($conn,"SELECT id FROM users WHERE email='testClientUname'");
        $ownerobject=$ownerresult->fetch_object();
        $petresult=mysqli_query($conn,"SELECT id FROM pets WHERE owner_id='$ownerobject->id'");
        $petobject=$petresult->fetch_object();
        $_POST=array('petNameInput'=>$petobject->id,'petWeight'=>'999');
		$this->assertNotEquals(False,update());
		CloseCon($conn);
	}

	/*
	* @test
	*/
	public function test_updateHealth(){
		$conn=OpenCon();
        $ownerresult=mysqli_query($conn,"SELECT id FROM users WHERE email='testClientUname'");
        $ownerobject=$ownerresult->fetch_object();
        $petresult=mysqli_query($conn,"SELECT id FROM pets WHERE owner_id='$ownerobject->id'");
        $petobject=$petresult->fetch_object();
        $_POST=array('petNameInput'=>$petobject->id,'petDescriptionInput'=>'updateTest');
		$this->assertNotEquals(False,update());
		CloseCon($conn);
	}
}
?>