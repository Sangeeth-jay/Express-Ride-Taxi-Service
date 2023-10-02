<?php

include 'db/db_config.php';

$date = $_REQUEST['date'];
$time = $_REQUEST['time'];
$title = $_REQUEST['titleinput'];
$description = $_REQUEST['news-description'];
$bookingId = $_REQUEST['bookingId'];
$customerId = $_REQUEST['customerId'];

$sql = "INSERT INTO feedback (`date`, `time`, `title`, `description`, `booking_id`, `customer_id`) VALUES ('$date', '$time', '$title', '$description', '$bookingId', '$customerId');";
$result = mysqli_query($conn, $sql);
if ($result) {
    header('location: customerDashboard.php');
}

