<?php
$dirname = dirname(__DIR__,1);
require_once $dirname.'\db_connection.php';
use PHPUnit\Framework\TestCase;
class deleteUserTest extends TestCase {
    /*
    * @test
    */
	public function test_delete_users(){
        $conn = OpenCon();
        $appointmentResult = mysqli_query($conn,"DELETE FROM VET_APPOINTMENTS WHERE app_date='2999-01-01'");
        $this->assertNotEquals(False,$appointmentResult);
        $clientResult = mysqli_query($conn,"DELETE FROM USERS WHERE email='testClientUname'");
		$this->assertNotEquals(False,$clientResult);
        $vetResult = mysqli_query($conn,"DELETE FROM VETS WHERE email_vet='testVetUname'");
        $this->assertNotEquals(False,$vetResult);
        closeCon($conn);
	}
}
?>