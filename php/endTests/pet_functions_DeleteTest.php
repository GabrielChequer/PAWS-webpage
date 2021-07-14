<?php
$dirname = dirname(__DIR__,1);
require_once $dirname.'\pet_functions.php';
require_once $dirname.'\db_connection.php';
use PHPUnit\Framework\TestCase;
class pet_functions_DeleteTest extends TestCase {
    /*
    * @test
    */
	public function test_deletePet(){
        //sample data
        $conn=OpenCon();
        $ownerresult=mysqli_query($conn,"SELECT id FROM users WHERE email='testClientUname'");
        $ownerobject=$ownerresult->fetch_object();
        $petresult=mysqli_query($conn,"SELECT id FROM pets WHERE owner_id='$ownerobject->id'");
        $petobject=$petresult->fetch_object();
        $_POST=array('petNameInput'=>$petobject->id);
		$this->assertNotEquals(False,delete());
        closeCon($conn);
	}
}
?>