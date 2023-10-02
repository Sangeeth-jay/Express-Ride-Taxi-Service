<?php
    include 'db/db_config.php';

    $bookingId = $_REQUEST['bookingId'];
    $date = $_REQUEST['date'];
    $time = $_REQUEST['time'];

    $sql = "UPDATE booking SET `acceptation` = 'accepted' WHERE (`booking_id` = '$bookingId');";
    $result = mysqli_query($conn, $sql);

    $sql2 = "INSERT INTO booking_status (`date`, `status`, `time`, `booking_booking_id`) VALUES ('$date', 'accepted', '$time', '$bookingId');    ";
    $result1 = mysqli_query($conn,$sql2);

    if($result1){
        echo '  <div class="alert alert-success alert-dismissible fade show" role="alert" id="result">
                    <strong>Booking Accepted!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                header('location: adminPannel.php');
    }else{
        echo '  <div class="alert alert-danger alert-dismissible fade show" role="alert" id="result">
                    <strong>Error!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

    }
?>