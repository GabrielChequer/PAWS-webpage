<?php
$dirname = dirname(__DIR__,1);
require_once $dirname.'\pet_functions.php';
require_once $dirname.'\db_connection.php';
use PHPUnit\Framework\TestCase;
class pet_functions_AddTest extends TestCase {
    /*
    * @test
    */
	public function test_addPet(){
        //sample data
        $conn = OpenCon();
        $_POST = array('pet_name'=>'testPet','vet_id'=>'99999999','pet_type'=>'typeTest','pet_breed'=>'testBreed','health_status'=>'healthTest','pet_birthday'=>'2021-01-01','petWeight'=>5);
        $result = mysqli_query($conn, "SELECT id FROM users WHERE email = 'testClientUname'");
        $id = 0;
        if($result){
            if($result_obj = $result->fetch_object()){
                $id = $result_obj->id;
            }
        }
        $_SESSION = array('user_id'=>$id);
        closeCon($conn);
		$this->assertNotEquals(False,add());
	}
}
?>