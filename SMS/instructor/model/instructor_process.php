<?php
require_once '../model/instructor.php';

if(isset($_GET["ins_id"])){
	
	$conn = new Connection();
	
	$ins_id = $_GET["ins_id"];
	$name = $_GET["name"];
	$address = $_GET["address"];
	$email = $_GET["email"];
	$contact_no = $_GET["contact_no"];
	
	$sql = "UPDATE tbl_instructor SET ins_name='$name', 
								address='$address',email='$email',
								contact_no='$contact_no' WHERE 	ins_id='$ins_id';";
	$result = ($conn->query($sql));
	
	if($result>0){
		header("Location:../view/instructor.php?msg=1");
	}
	else
		echo("Error");
	
}
else if(isset($_GET["delete"])){
	
	$conn = new Connection();
	$ins_id = $_GET["insid"];

	$sql_delete = "DELETE FROM tbl_instructor WHERE ins_id='$ins_id';";
	$result_delete  = ($conn->query($sql_delete));
	
	if($result_delete>0){
		header("Location:../view/instructor.php?msg=2");
	}
	else
		echo("Error");
	
}

?>