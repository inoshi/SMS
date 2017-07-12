<?php
require_once '../../db/connection.php';

class instructor{

	function addInstructor($txtname, $txtaddress, $txtemail, $txtcontact){
		$conn = new Connection();

		$sql = "insert into tbl_instructor
                (ins_name, address, email, contact_no)
               values ('$txtname', '$txtaddress', '$txtemail', '$txtcontact')";
               
        if ($conn->query($sql) === TRUE) {
			    header("location:../view/instructor.php?error=success");
			    unset($_SESSION['ins']);
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
	}

	function getStudents(){
		$conn = new Connection();

		$sql = "SELECT * FROM  tbl_instructor";
		$result = $conn->query($sql);
		var_dump($result);
		return $result;
	}
}
?>