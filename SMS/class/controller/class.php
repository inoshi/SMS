<?php
session_start();
require_once '../model/class_sms.php';
//$function_name = $_POST['function_name'];

if(isset($_POST['btnaddclass'])){
	$txtcode = $_POST['txtcode'];
	$txtname = $_POST['txtname'];
	$txtsubjects = $_POST['subjects'];

	//var_dump($txtsubjects);exit;

	$_SESSION['cls']['txtcode']=$txtcode;
	$_SESSION['cls']['txtname']=$txtname;
	

	$p_nm='/^[a-zA-Z\.\s]+$/';

	

	if($txtcode == "")
	{
		$_SESSION['cls']['txtcode']="";
		header('Location:../view/class.php?error=code');
	}
	else if(!preg_match($p_nm, $txtname))
	{
		$_SESSION['cls']['txtname']="";
		header('Location:../view/class.php?error=name');
	}
	
	else
	{
		$obj = new classSms();
    	$obj->addClass($txtcode, $txtname, $txtsubjects);

	}

    
    
}




?>