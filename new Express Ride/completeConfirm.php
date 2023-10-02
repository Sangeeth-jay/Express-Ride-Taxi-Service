<?php
    include 'db/db_config.php';

    $bookingId = $_REQUEST['id'];
    $date = $_REQUEST['date'];
    $time = $_REQUEST['time'];

    $sqlVehicleId = "SELECT vehicle_id FROM booking where booking_id = '$bookingId';";
    $resVehicleId = mysqli_query($conn, $sqlVehicleId);
    if(mysqli_num_rows($resVehicleId)>0){
        while($row = mysqli_fetch_assoc($resVehicleId)){
            $vehicleId = $row['vehicle_id'];
        }
    }

    $sqlBooking = "UPDATE booking SET `acceptation` = 'completed' WHERE (`booking_id` = '$bookingId') ;    ";
    $resultBooking = mysqli_query($conn, $sqlBooking);
    $sqlBookingStatus = "INSERT INTO booking_status (`date`, `status`, `time`, `booking_booking_id`) VALUES ('$date', 'completed', '$time', '$bookingId');    ";
    $resultBookingStatus = mysqli_query($conn, $sqlBookingStatus);
    $sqlUpdateVehicle = "UPDATE vehicle SET `availability` = 'Available' WHERE (`vehicle_id` = '$vehicleId');    ";
    $resultUpdateVehicle = mysqli_query($conn, $sqlUpdateVehicle);

    if($resultUpdateVehicle){
        header('location: driverDashboard.php');
    }
?>