<?php 
	function create_app(){
		require_once 'db_connection.php';
		require_once 'signup_function.php';
		$conn = OpenCon();
		$sql_create_app = "INSERT INTO VET_APPOINTMENTS (pet_id, app_time, app_date, app_type) VALUES ('$_POST[pet_id]','$_POST[time]','$_POST[app_date]','$_POST[app_type]')";
		$result_create_app = mysqli_query($conn, $sql_create_app);
		$sql_search_app = "SELECT appointment_id FROM VET_APPOINTMENTS WHERE pet_id='$_POST[pet_id]' AND app_time='$_POST[time]' AND app_date='$_POST[app_date]'";
		$result_search_app = mysqli_query($conn, $sql_search_app);
		if(mysqli_num_rows($result_search_app) >0){
			if(!headers_sent()){
				//header("location: /paws/dashboard_owner.php");
				$url=$_SERVER['HTTP_REFERER'];
        		header("location:$url");
			}
		}else{
			echo '<script>alert("There was an error, please check that your doctor is available during that date")</script>';
		}
		return $result_search_app;
	}
	if(isset($_POST['pet_id'])){
		create_app();
	}
	$url=$_SERVER['HTTP_REFERER'];
    header("location:$url");
	//header("location: /paws/dashboard_owner.php");
?>