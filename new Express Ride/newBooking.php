
<?php
    include 'db/db_config.php';

    $pickUp = $_REQUEST['town_name'];
    $destination = $_REQUEST['town_name2'];
    $distance = $_REQUEST['totDistance'];
    $amount = $_REQUEST['amount'];
    $date = $_REQUEST['date'];
    $time = $_REQUEST['time'];
    $customerId = $_REQUEST['customerId'];
    $vehicleId = $_REQUEST['vehicleId'];
    $driverId = $_REQUEST['driverId'];

    $lastBookingID;

    // insert to booking tbl
    $sql = "INSERT INTO booking (`pickup_point`, `destination`, `km`, `amount`, `date`, `time`, `acceptation`, `customer_id`, `vehicle_id`, `user_id`) VALUES ('".$pickUp."', '".$destination."', '".$distance."', '".$amount."', '".$date."', '".$time."', 'waiting', '".$customerId."', '".$vehicleId."', '".$driverId."');    ";
    $result = mysqli_query($conn,$sql);


    // find above insert booking id
    $sql2 = "SELECT booking_id FROM booking WHERE acceptation = 'waiting' order by booking_id desc limit 1;";
    $result2 = mysqli_query($conn,$sql2);

    if(mysqli_num_rows($result2)>0){
        while($row = mysqli_fetch_assoc($result2)){
         $lastBookingID = $row['booking_id']; 
        }
    }
    // insert to booking status tbl
    $sql3 = "INSERT ignore INTO booking_status (`date`, `status`, `time`, `booking_booking_id`) VALUES ('$date', 'waiting', '$time', '$lastBookingID');    ";
    $result3 = mysqli_query($conn, $sql3);



    $sql4 = "UPDATE vehicle SET `availability` = 'Not-available' WHERE (`vehicle_id` = '$vehicleId');    ";
    $resultsql4 = mysqli_query($conn, $sql4);

    // echo $sql.'<br>'. $lastBookingID.'<br>'.$sql3;

    if($resultsql4){

        header('location: customerDashboard.php');
    }
    
    


?>