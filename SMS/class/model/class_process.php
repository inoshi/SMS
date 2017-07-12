<?php
require_once '../model/class_sms.php';

if(isset($_GET["cls_id"])){
	
	$conn = new Connection();
	
	$cls_id = $_GET["cls_id"];
	$code = $_GET["code"];
	$name = $_GET["name"];
	$subjects = $_GET["subjects"];

	
	
	$sql = "UPDATE tbl_class SET cls_code='$code', 
								cls_name='$name'
								WHERE 	cls_id='$cls_id';";
	$result = ($conn->query($sql));


		if($result>0){
		header("Location:../view/class.php?msg=1");
		}
		else{
			echo("Error");
		}
		

	/*foreach ($subjects as $subject) {
		$sql_sub = "UPDATE tbl_class_subjects SET sub_id='$subject'
								WHERE 	cls_id='$cls_id';";
		$result_sub = ($conn->query($sql_sub));

		if($result>0 && $result_sub>0){
		header("Location:../view/class.php?msg=1");
		}
		else
			echo("Error");
		}*/
	
}
else if(isset($_GET["delete"])){
	
	$conn = new Connection();
	$cls_id = $_GET["clsid"];
	$cls_code = $_GET["code"];


	$sql_delete = "DELETE FROM tbl_class WHERE cls_id='$cls_id';";
	$result_delete  = ($conn->query($sql_delete));

	//$sql_delete2 = "DELETE FROM tbl_class_subjects WHERE cls_code='$cls_code';"
	//$result_delete2  = ($conn->query($sql_delete2));
	
	if($result_delete>0){
		header("Location:../view/class.php?msg=2");
	}
	else
		echo("Error");
	
}

?>