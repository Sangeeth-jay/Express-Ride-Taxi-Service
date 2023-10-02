<?php

include 'db/db_config.php';

$vehicleType = $_REQUEST['vehicleType'];
$driverId = $_REQUEST['driver'];
$cost = $_REQUEST['cost'];
$status = $_REQUEST['status'];


$sql = "INSERT INTO vehicle (`type`, `cost_per_km`, `availability`, `driver_id`) VALUES ('" . $vehicleType . "', '" . $cost . "','" . $status . "', '" . $driverId . "');";

$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-news" >
             Vehicle Record Added!           
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    header('location: adminPannelVehicle.php');
} else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-news" >
        Vehicle Record Not Added!           
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
}
