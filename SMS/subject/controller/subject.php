<?php
session_start();
require_once '../model/subject.php';
//$function_name = $_POST['function_name'];

if(isset($_POST['btnaddsubject'])){
	$txtcode = $_POST['txtcode'];
	$txtname = $_POST['txtname'];
	$txtinstructor = $_POST['txtinstructor'];

	$_SESSION['sub']['txtcode']=$txtcode;
	$_SESSION['sub']['txtname']=$txtname;
	$_SESSION['sub']['txtinstructor']=$txtinstructor;
	

	$p_nm='/^[a-zA-Z\.\s]+$/';

	

	if($txtcode == "")
	{
		$_SESSION['sub']['txtcode']="";
		header('Location:../view/subject.php?error=code');
	}
	else if(!preg_match($p_nm, $txtname))
	{
		$_SESSION['sub']['txtname']="";
		header('Location:../view/subject.php?error=name');
	}
	
	else
	{
		$obj = new subject();
    	$obj->addSubject($txtcode, $txtname, $txtinstructor);

	}

    
    
}




?>