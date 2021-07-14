<?php 
function OpenCon(){
	$dbhost = "localhost";
	$dbuser = "id16605093_root";
	$dbpass = "EKC6Cs|my*tLY&%-";
	$db = "id16605093_vet_clinic";
	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

	return $conn;
}

function CloseCon($conn){
	$conn -> close();
}

?>