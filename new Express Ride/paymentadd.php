<?php
include 'db/db_config.php';


$payment = $_REQUEST['paymentInput'];
$date = $_REQUEST['date4'];
$time = $_REQUEST['time4'];
$bookingID = $_REQUEST['BookingID-payment'];
$customerID = $_REQUEST['customerID-payement'];

$sqlPayement = "INSERT INTO booking_status (`date`, `status`, `time`, `booking_booking_id`) VALUES ('$date', 'payed', '$time', '$bookingID');";
$sqlPayementStatus = "INSERT INTO payment (`amount`, `status`, `booking_id`, `customer_id`) VALUES ('$payment', 'payed', '$bookingID', '$customerID');";
// echo $sqlPayement;
// echo $sqlPayementStatus;
$result = mysqli_query($conn, $sqlPayement);
$result1 = mysqli_query($conn, $sqlPayementStatus);
if($result1){
    header('location: customerDashboard.php');
}
?>