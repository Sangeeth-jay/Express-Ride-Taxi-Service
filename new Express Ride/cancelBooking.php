<?php
    include 'db/db_config.php';

    $bookingId = $_REQUEST['bookingId'];
    $date = $_REQUEST['date'];
    $time = $_REQUEST['time'];

    $sql = "UPDATE booking SET `acceptation` = 'canceled' WHERE (`booking_id` = '$bookingId');";
    $result = mysqli_query($conn, $sql);

    $sql2 = "INSERT INTO booking_status (`date`, `status`, `time`, `booking_booking_id`) VALUES ('$date', 'canceled', '$time', '$bookingId');    ";
    $result = mysqli_query($conn,$sql2);

    if($result){
        header('location: customerDashboard.php');
    }else{
        

    }
?>