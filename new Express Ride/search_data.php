<?php
include "db/db_config.php";
if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($conn,$_POST['search']);

    $query = "SELECT * FROM destinations WHERE town_name like'%".$search."%'";
    $result = mysqli_query($conn,$query);

    $response = array();
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['km_from_colombo'],"label"=>$row['town_name']);
    }

    echo json_encode($response);
}
exit;
?>