<?php

// start the session
session_start();
require_once '../model/login.php';

// retrieve the username and password values from the view
$user_name = htmlentities($_POST['username']);
$password = md5($_POST['password']);


$obj = new Login(); // create obj object of the Login

$result = $obj->userLogin($user_name, $password);
// call to the function userLogin

$num = mysqli_num_rows($result); // check whether user exists
$val = mysqli_fetch_assoc($result);

// if the user is available
if ($num == 1) {
	$_SESSION["users"] = $user_name;
	//echo($_SESSION["users"]);exit;
    header("location:../../home.php"); // go to home page    
}
// if the user is not available
else {
    header("location:../../index.php?err=1");
// redirect to the login page    
}
?>