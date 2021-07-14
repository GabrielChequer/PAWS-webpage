<?php 
	function delete(){
		$conn = OpenCon();
		$sql_delete_pet_profile = "DELETE FROM PETS WHERE id = $_POST[petNameInput]";
		$result_delete_pet_profile = mysqli_query($conn, $sql_delete_pet_profile);
		CloseCon($conn);
		return $result_delete_pet_profile;
	}
	function update(){
		$conn = OpenCon();
		$result_update_pet_profile=false;
		if(isset($_POST['petWeight'])){
			$sql_update_pet_profile = "UPDATE PETS SET weight=$_POST[petWeight] WHERE id=$_POST[petNameInput]";
			$result_update_pet_profile = mysqli_query($conn, $sql_update_pet_profile);
		}
		if(isset($_POST['petDescriptionInput'])){
			echo $_POST['petDescriptionInput'];
			$sql_update_pet_profile = "UPDATE PETS SET health_status='$_POST[petDescriptionInput]' WHERE id=$_POST[petNameInput]";
			$result_update_pet_profile = mysqli_query($conn, $sql_update_pet_profile);
		}
		CloseCon($conn);
		return $result_update_pet_profile;
	}
	function add(){
		$conn = OpenCon();
		$sql_add_pet_profile = "INSERT INTO PETS(pet_name, owner_id, vet_id, pet_type, pet_breed, health_status, pet_birthday, weight) VALUES ('$_POST[pet_name]','$_SESSION[user_id]',1,'$_POST[pet_type]','$_POST[pet_breed]','$_POST[health_status]', '$_POST[pet_birthday]','$_POST[weight]')";
		$result_add_pet_profile = mysqli_query($conn, $sql_add_pet_profile);
		CloseCon($conn);
		return $result_add_pet_profile;
	}
	require_once 'db_connection.php';
	session_start();

	if(isset($_POST['pet_update'])){
	    update();
	}elseif (isset($_POST['pet_delete'])) {
		delete();
	}elseif (isset($_POST['pet_add'])) {
		add();
	}
	$url=$_SERVER['HTTP_REFERER'];
    header("location:$url");
	//header("location: /paws/dashboard_owner.php");
?>