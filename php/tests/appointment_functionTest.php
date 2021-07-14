<?php
$dirname = dirname(__DIR__,1);
require_once $dirname.'\appointment_function.php';
require_once $dirname.'\db_connection.php';
use PHPUnit\Framework\TestCase;
class appointment_functionTest extends TestCase {
	/*
	* @test
	*/
	public function test_createapp(){
        //sample data
		$conn=OpenCon();
        $ownerresult=mysqli_query($conn,"SELECT id FROM users WHERE email='testClientUname'");
        $ownerobject=$ownerresult->fetch_object();
        $petresult=mysqli_query($conn,"SELECT id FROM pets WHERE owner_id='$ownerobject->id'");
        $petobject=$petresult->fetch_object();
        $_POST = array('pet_id'=>$petobject->id,'time'=>'11:00:00','app_date'=>'2999-01-01');
		$this->assertNotEquals(False,create_app());
        closeCon($conn);
	}
}
?>