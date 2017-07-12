<?php
require_once '../../db/connection.php';

class classSMS{

	function addClass($txtcode, $txtname, $txtsubjects){
		$conn = new Connection();

		$sql = "insert into tbl_class
                (cls_code, cls_name)
               values ('$txtcode', '$txtname')";

        foreach ($txtsubjects as $subject) {
        	$sql_subjects = "insert into tbl_class_subjects (cls_id, sub_id) values ('$txtcode','$subject')";
        	$result = $conn->query($sql_subjects);
        }
               
        if ($conn->query($sql) === TRUE && $result>0) {
			    header("location:../view/class.php?error=success");
			    unset($_SESSION['cls']);
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
	}

	
}
?>