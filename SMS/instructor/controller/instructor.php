<?php
session_start();
require_once '../model/instructor.php';
//$function_name = $_POST['function_name'];

if(isset($_POST['btnaddinstructor'])){
	$txtname = $_POST['txtname'];
	$txtaddress = $_POST['txtaddress'];
	$txtemail = $_POST['txtemail'];
	$txtcontact = $_POST['txtcontact'];

	$_SESSION['ins']['txtname']=$txtname;
	$_SESSION['ins']['txtaddress']=$txtaddress;
	$_SESSION['ins']['txtemail']=$txtemail;
	$_SESSION['ins']['txtcontact']=$txtcontact;

	$p_fnm='/^[a-zA-Z\.\s]+$/';
	//$p_add='/^[a-zA-Z\d\.\,\s\/]+$/';
	$p_email='/^[\w]+\@[a-zA-Z]{5}+\.[a-zA-Z]{2,4}$/';
	$p_con='/^[0-9]{10}$/';

	if(!preg_match($p_fnm, $txtname))
	{
		$_SESSION['std']['txtname']="";
		header('Location:../view/instructor.php?error=name');
	}
	else if($txtaddress == "")
	{
		$_SESSION['std']['txtaddress']="";
		header('Location:../view/instructor.php?error=address');
	}
	else if(!preg_match($p_email, $txtemail))
	{
		$_SESSION['std']['txtemail']="";
		header('Location:../view/instructor.php?error=email');
	}
	else if(!preg_match($p_con, $txtcontact))
	{
		$_SESSION['std']['txtcontact']="";
		header('Location:../view/instructor.php?error=contact');
	}
	else
	{
		$obj = new instructor();
    	$obj->addInstructor($txtname, $txtaddress, $txtemail, $txtcontact);

	}

    
    
}




?>