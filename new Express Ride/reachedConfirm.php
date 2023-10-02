<?php 
    include 'db/db_config.php';

    $id = $_REQUEST['id'];
    $date = $_REQUEST['date'];
    $time = $_REQUEST['time'];

    $sql = "INSERT INTO booking_status (`date`, `status`, `time`, `booking_booking_id`) VALUES ('$date', 'reached', '$time', '$id');    ";
    $result = mysqli_query($conn, $sql);

    if($result){
        header('location: driverDashboard.php');
    }
?>