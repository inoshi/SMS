<?php

//linking with file contains database connectivity
require_once '../../db/connection.php';

class Login {

//login in to the system    
    function userLogin($user_name, $password) {

        $conn = new Connection();

        $sql = "select * from tbl_user where user_name='$user_name' && password='$password'";

        $result = $conn->query($sql);

        return $result;
    }

}
?>

