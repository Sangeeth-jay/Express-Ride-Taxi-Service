<?php
session_start();
include 'db/db_config.php';

$userName = $_REQUEST['userName'];
$password = $_REQUEST['Password'];

$sql = 'SELECT * FROM user WHERE user_name = "'.$userName.'";';
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)){
        $_SESSION['designation'] = $row['designation'];
        $_SESSION['uName'] = $row['user_name'];
        $_SESSION['uId'] = $row['user_id'];
        $uName = $row['user_name'];
        $pWord = $row['password'];
    }

    if($userName==$_SESSION['uName'] && $password==$pWord){
        if($_SESSION['designation'] > 2){
            header("Location: driverDashboard.php");
        }
        else{
            header("Location: adminPannel.php");
 
        }

    }else{
        header("Location: staffLogin.php?error=Incorrect Password");
    }
}else{
    header("Location: staffLogin.php?error=This Email Not Registered");
}

?>