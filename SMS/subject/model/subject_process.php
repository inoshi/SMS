<?php
require_once '../model/subject.php';

if(isset($_GET["sub_id"])){
	
	$conn = new Connection();
	
	$sub_id = $_GET["sub_id"];
	$code = $_GET["code"];
	$name = $_GET["name"];
	$ins = $_GET["ins"];
	
	$sql = "UPDATE tbl_subject SET sub_code='$code', 
								sub_name='$name',ins_id='$ins'
								WHERE 	sub_id='$sub_id';";
	$result = ($conn->query($sql));
	
	if($result>0){
		header("Location:../view/subject.php?msg=1");
	}
	else
		echo("Error");
	
}
else if(isset($_GET["delete"])){
	
	$conn = new Connection();
	$sub_id = $_GET["subid"];

	$sql_delete = "DELETE FROM tbl_subject WHERE sub_id='$sub_id';";
	$result_delete  = ($conn->query($sql_delete));
	
	if($result_delete>0){
		header("Location:../view/subject.php?msg=2");
	}
	else
		echo("Error");
	
}

?>