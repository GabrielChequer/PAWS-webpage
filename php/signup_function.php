<?php
	require_once 'validation.php';
	function vet_signup($conn, $sql_search_vet){
		#if user is a vet
		$sql_create_vet = "INSERT INTO VETS (vet_id, first_name_vet, last_name_vet,email_vet,pass_vet) VALUES ('$_POST[vetid]','$_POST[first_name]','$_POST[last_name]','$_POST[uname]','$_POST[psw]')";
		$result_create_vet = mysqli_query($conn, $sql_create_vet);
			#search vet to make sure it was created in the database
		$result_search_vet = mysqli_query($conn, $sql_search_vet);
		if(mysqli_num_rows($result_search_vet) >0){
			echo '<script>alert("User was created successfully, log in to continue")</script>';
		} else{
			echo '<script>alert("There was an error, please try again")</script>';
		}
		return $result_search_vet;
	}
	function client_signup($conn, $sql_search_user){
		#if user is not a vet
		$sql_create_user = "INSERT INTO USERS (first_name, last_name, address,email,pass) VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[address]','$_POST[uname]','$_POST[psw]')";
		$result_create_user = mysqli_query($conn, $sql_create_user);
			#search user to make sure it was created in the database
		$result_search_user = mysqli_query($conn, $sql_search_user);
		if(mysqli_num_rows($result_search_user) >0){
			echo '<script>alert("User was created successfully, log in to continue")</script>';
		} else{
			echo '<script>alert("There was an error, please try again")</script>';
		}
		return $result_search_user;
	}
	function user_signup_form_complete(){
		$conn = OpenCon();
		$error_number=0;
		//for searching users
		$sql_search_user = "SELECT email FROM USERS WHERE email= '$_POST[uname]'";
		$result_search_user = mysqli_query($conn, $sql_search_user);
			//for searching vets
		$sql_search_vet = "SELECT email_vet FROM VETS WHERE email_vet= '$_POST[uname]'";
		$result_search_vet = mysqli_query($conn, $sql_search_vet);

		if (mysqli_num_rows($result_search_user) > 0) {
			#email was found in database
			$error_number=2;
			validation_error(2); 	#2 means email has been used to create an account before
		} else {
			#email wasn't found, create user/vet
			if($_POST['vetid']){
				vet_signup($conn, $sql_search_vet);
			}else{
				client_signup($conn, $sql_search_user);
			}	
		}
		CloseCon($conn);
		return $error_number;
	}
	function user_signup(){		
		$_POST["psw"] = md5($_POST["psw"]);
		$_POST["psw-repeat"] = md5($_POST["psw-repeat"]);
		#check email address is valid
		$error_number=0;
		if (!filter_var($_POST["uname"], FILTER_VALIDATE_EMAIL)) {
			$error_number=1;
	  		validation_error(1);	#1 means that user didn't type a valid email
		} else{
				#check that passwords match, else, throw error
			if($_POST["psw"] === $_POST["psw-repeat"]){
				user_signup_form_complete();
			} else{
				$error_number=4;
				validation_error(4);	#3 means passwords don't match
			}
		}
		return $error_number;
	}

?>