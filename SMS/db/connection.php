<?php

// connecting to the database

Class Connection {

    function query($sql) {

// connect to the server               
        $conn = mysqli_connect('localhost', 'root', '') or
// if server is unavailable                              
                die("could not connect to the server");

// connect to the database  
        $db = mysqli_select_db($conn,'db_sms') or
// if database is unavailable              
                die("could not select the database");

// run the query        
        $result = mysqli_query($conn,$sql) or
// if could not run the query                               
                die("could not execute the query");
        return $result;
    }

}

?>