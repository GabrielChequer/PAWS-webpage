<?php
	function validation_error($errorNumber){
		switch ($errorNumber) {
			case 1:
					#Not a valid email address
				echo '<script>alert("Please enter a valid email")</script>';
				break;
			
			case 2:
					#Email already exists, user needs to login not signup
				echo '<script>alert("Email already exists in Database, try logging in")</script>';
				break;
			case 3:
					#Either email not in Database or incorrect password
				echo '<script>alert("Credentials not valid")</script>';
				break;
			case 4:
					#Passwords in form don't match
				echo '<script>alert("Passwords don\'t match")</script>';
				break;
			default:
				echo '<script>alert("There was an error on our end, please try again.")</script>';
				break;
		}
	}
?>