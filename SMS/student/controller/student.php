<?php
session_start();
require_once '../model/student.php';
//$function_name = $_POST['function_name'];

if(isset($_POST['btnaddstudent'])){
	$txtname = $_POST['txtname'];
	$txtaddress = $_POST['txtaddress'];
	$txtemail = $_POST['txtemail'];
	$txtcontact = $_POST['txtcontact'];
	$txtclass = $_POST['txtclass'];

	$_SESSION['std']['txtname']=$txtname;
	$_SESSION['std']['txtaddress']=$txtaddress;
	$_SESSION['std']['txtemail']=$txtemail;
	$_SESSION['std']['txtcontact']=$txtcontact;

	$p_fnm='/^[a-zA-Z\.\s]+$/';
	//$p_add='/^[a-zA-Z\d\.\,\s\/]+$/';
	$p_email='/^[\w]+\@[a-zA-Z]{5}+\.[a-zA-Z]{2,4}$/';
	$p_con='/^[0-9]{10}$/';

	if(!preg_match($p_fnm, $txtname))
	{
		$_SESSION['std']['txtname']="";
		header('Location:../view/student.php?error=name');
	}
	else if($txtaddress == "")
	{
		$_SESSION['std']['txtaddress']="";
		header('Location:../view/student.php?error=address');
	}
	else if(!preg_match($p_email, $txtemail))
	{
		$_SESSION['std']['txtemail']="";
		header('Location:../view/student.php?error=email');
	}
	else if(!preg_match($p_con, $txtcontact))
	{
		$_SESSION['std']['txtcontact']="";
		header('Location:../view/student.php?error=contact');
	}
	else
	{
		$obj = new student();
    	$obj->addStudent($txtname, $txtaddress, $txtemail, $txtcontact,$txtclass);

	}

    
    
}



?>