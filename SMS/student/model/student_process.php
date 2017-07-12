<?php
require_once '../model/student.php';

if(isset($_GET["std_id"])){
	
	$conn = new Connection();
	
	$std_id = $_GET["std_id"];
	$name = $_GET["name"];
	$address = $_GET["address"];
	$email = $_GET["email"];
	$contact_no = $_GET["contact_no"];
	$ins = $_GET["ins"];
	
	$sql = "UPDATE tbl_student SET std_name='$name', 
								addess='$address',email='$email',
								contact_no='$contact_no', class_id='$ins' WHERE std_id='$std_id';";
	$result = ($conn->query($sql));
	
	if($result>0){
		header("Location:../view/student.php?msg=1");
	}
	else
		echo("Error");
	
}
else if(isset($_GET["delete"])){
	
	$conn = new Connection();
	$std_id = $_GET["stdid"];

	$sql_delete = "DELETE FROM tbl_student WHERE std_id='$std_id';";
	$result_delete  = ($conn->query($sql_delete));
	
	if($result_delete>0){
		header("Location:../view/student.php?msg=2");
	}
	else
		echo("Error");
	
}

?>