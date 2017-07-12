<?php
require_once '../../db/connection.php';

class student{

	function addStudent($txtname, $txtaddress, $txtemail, $txtcontact, $txtclass){
		$conn = new Connection();

		$sql = "insert into tbl_student
                (std_name, addess, email, contact_no, class_id)
               values ('$txtname', '$txtaddress', '$txtemail', '$txtcontact', '$txtclass')";
               
        if ($conn->query($sql) === TRUE) {
			    header("location:../view/student.php?error=success");
			    unset($_SESSION['std']);
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
	}

	function getStudents(){
		$conn = new Connection();

		$sql = "SELECT * FROM  tbl_student";
		$result = $conn->query($sql);
		var_dump($result);
		return $result;
	}
}
?>