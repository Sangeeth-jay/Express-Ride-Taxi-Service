<?php
    include 'db/db_config.php';

    $feedId = $_REQUEST['feedId'];

    $sql = "DELETE FROM feedback WHERE feedback_id = '$feedId';    ";
    $result = mysqli_query($conn, $sql);

    if($result){
        header('location: customerDashboardFeedback.php');
    }
?>