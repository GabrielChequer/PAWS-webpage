<?php
	function set_values_session(){
		$conn = OpenCon();
		if($_POST['vetLogId']){
			$sql_user = "SELECT first_name_vet, last_name_vet, email_vet, vet_id FROM VETS WHERE email_vet= '$_POST[uname]'";
			$result_user = mysqli_query($conn, $sql_user);
			if (mysqli_num_rows($result_user)) {
				#if the user is found in the database we use a while to go trough the results and assign it to $_SESSION['name'], if our database is set correctly there will only be one result per email
				while($row = mysqli_fetch_array($result_user)) {
	    			$_SESSION['name'] = $row['first_name_vet'] . " " . $row['last_name_vet']; // Assign a single column data (maybe we will need a $_SESSION['last_name'] too, I'm not sure, it depends on how we want to manipulate de data)
	    			$_SESSION['email'] = $row['email_vet'];
	    			$_SESSION['vet_id'] = $row['vet_id'];
				}
				setcookie('name',$_SESSION['name'],time()+3600,'/');		//set cookies for being able to relog users when redirected to other pages
			} else{
					echo '<script>alert("User not found in database")</script>';	//this shouldn't run because we already validated this in login_function.php but just to be careful
			}
		}else{
			$sql_user = "SELECT first_name, last_name, id, address, email FROM USERS WHERE email= '$_POST[uname]'";
			$result_user = mysqli_query($conn, $sql_user);
			if (mysqli_num_rows($result_user)) {
				#if the user is found in the database we use a while to go trough the results and assign it to $_SESSION['name'], if our database is set correctly there will only be one result per email
				while($row = mysqli_fetch_array($result_user)) {
	    			$_SESSION['name'] = $row['first_name'] . " " . $row['last_name']; // Assign a single column data (maybe we will need a $_SESSION['last_name'] too, I'm not sure, it depends on how we want to manipulate de data)
	    			$_SESSION['user_id'] = $row['id'];
	    			$_SESSION['address'] = $row['address'];
	    			$_SESSION['email'] = $row['email'];
				}
				setcookie('name',$_SESSION['name'],time()+3600,'/');		//set cookies for being able to relog users when redirected to other pages
			} else{
					echo '<script>alert("User not found in database")</script>';	//this shouldn't run because we already validated this in login_function.php but just to be careful

			}
		}
		CloseCon($conn);
	}
?>