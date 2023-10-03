<?php

include 'db/db_config.php';

$firstname = $_REQUEST['cus_f_name'];
$lastname = $_REQUEST['cus_l_name'];
$email = $_REQUEST['cus_email'];
$telephone = $_REQUEST['cus_telephone'];
$nic = $_REQUEST['cus_nic'];
$password = $_REQUEST['cus_password'];
$reenterpassword = $_REQUEST['cus_re-enter_password'];


$sql = "INSERT INTO customer (`first_name`, `last_name`, `nic`, `email`, `telephone`, `password`) VALUES ('".$firstname."', '".$lastname."', '".$nic."', '".$email."', '".$telephone."', '".$password."');";
$result = mysqli_query($conn,$sql);

if($result){
    header('location:customerLogin.php');
}