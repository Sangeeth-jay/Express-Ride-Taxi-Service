<?php 
    include 'db/db_config.php';

    $vehicleId = $_REQUEST['vehicleId'];
    $driverId = $_REQUEST['driver'];
    $cost = $_REQUEST['costvalue'];
    $status = $_REQUEST['status'];
    $sql = "UPDATE vehicle SET `cost_per_km` = '".$cost."', `availability` = '".$status."', `driver_id` = '".$driverId."' WHERE (`vehicle_id` = '".$vehicleId."');";
    $result = mysqli_query($conn,$sql);
    if($result){
        header('location:adminPannelVehicle.php');
    }
?>