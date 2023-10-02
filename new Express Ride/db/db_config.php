<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "expressride";

    $conn = new mysqli($servername,$username,$password,$dbname);
    
    if($conn->error){
        die("Connection Error - ".$conn->connect_error);
    }

?>