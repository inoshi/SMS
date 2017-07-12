<?php
require_once '../../db/connection.php';

class subject{

	function addSubject($txtcode, $txtname, $txtinstructor){
		$conn = new Connection();

		$sql = "insert into tbl_subject
                (sub_code, sub_name, ins_id)
               values ('$txtcode', '$txtname', '$txtinstructor')";
               
        if ($conn->query($sql) === TRUE) {
			    header("location:../view/subject.php?error=success");
			    unset($_SESSION['sub']);
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
	}

	function getSubject(){
		$conn = new Connection();

		$sql = "SELECT * FROM  tbl_subject";
		$result = $conn->query($sql);
		var_dump($result);
		return $result;
	}
}
?>