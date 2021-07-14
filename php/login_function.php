<?php 
	require_once 'db_connection.php';
	require_once 'session_function.php';
	require_once 'validation.php';
	function vet_login(){
		$conn = OpenCon();
		$outcome = 0;
		$sql_user = "SELECT email_vet, vet_id  FROM VETS WHERE email_vet= '$_POST[uname]' AND vet_id = '$_POST[vetLogId]'";
		$result_user = mysqli_query($conn, $sql_user);
		if (mysqli_num_rows($result_user) > 0) {
			#user was found in database, now check for password
			$sql_pass = "SELECT pass_vet FROM VETS WHERE email_vet = '$_POST[uname]' AND pass_vet ='$_POST[psw]' AND vet_id = '$_POST[vetLogId]'";
			$result_pass = mysqli_query($conn, $sql_pass);
			if(mysqli_num_rows($result_pass)){
				if(!headers_sent()){
					session_start();		//the session starts, you terminate a session with session_destroy() but we need a sign-out button for that
					set_values_session();	//this is where we get values from the database to variables in PHP so we can work with them, right now it's only the name but same procedure for everything else in the database
				}
				$outcome = 1;
			} else{
				validation_error(3);	#3 means either email not in Database or incorrect password
			}
		} else {
			$outcome = 2;
			#user wasn't found in database
			validation_error(3);	#3 means either email not in Database or incorrect password
		}
		closeCon($conn);
		return $outcome;
	}
	
	function client_login(){
		$conn = OpenCon();
		$outcome = 0;
		$sql_user = "SELECT email FROM USERS WHERE email= '$_POST[uname]'";
		$result_user = mysqli_query($conn, $sql_user);
		if (mysqli_num_rows($result_user) > 0) {
			#user was found in database, now check for password
			$sql_pass = "SELECT pass FROM USERS WHERE email = '$_POST[uname]' AND pass ='$_POST[psw]'";
			$result_pass = mysqli_query($conn, $sql_pass);
			if(mysqli_num_rows($result_pass)){
				if(!headers_sent()){
					session_start();		//the session starts, you terminate a session with session_destroy() but we need a sign-out button for that
					set_values_session();	//this is where we get values from the database to variables in PHP so we can work with them, right now it's only the name but same procedure for everything else in the database
				}
				$outcome = 1;
			} else{
				validation_error(3);	#3 means either email not in Database or incorrect password
			}
		} else {
			$outcome = 2;
			#user wasn't found in database
			validation_error(3);	#3 means either email not in Database or incorrect password
		}
		closeCon($conn);
		return $outcome;
	}

	function user_login(){
		$_POST["psw"] = md5($_POST["psw"]);
		if (!filter_var($_POST["uname"], FILTER_VALIDATE_EMAIL)) {
	  		validation_error(1);	#1 means that user didn't type a valid email
		}else{

			if($_POST['vetLogId']){
				vet_login();			
			}else{
				client_login();
			}
		}
	}
?>