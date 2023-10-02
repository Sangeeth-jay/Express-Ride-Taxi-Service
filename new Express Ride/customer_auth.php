<?php
session_start();
include 'db/db_config.php';

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

$sql = 'SELECT * FROM customer WHERE email = "'.$email.'";';


$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)){
        $_SESSION['customer_id'] = $row['customer_id'];
        $_SESSION['f_name'] = $row['first_name'];
        $l_name = $row['last_name'];
        $mail = $row['email'];
        $nic = $row['nic'];
        $phone = $row['telephone'];
        $pword = $row['password'];

    }

    if($email==$mail && $password==$pword){
        header("Location: customerDashboard.php?f_name=$f_name");
    }else{
        header("Location: customerLogin.php?error=Incorrect Password");
    }

}else{
    header("Location: customerLogin.php?error=This Email Not Registered");
}

?>