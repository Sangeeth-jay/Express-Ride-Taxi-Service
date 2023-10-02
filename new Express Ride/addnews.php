<?php

include 'db/db_config.php';

$newsdescription = $_REQUEST['news-description'];

$sql = "INSERT INTO news (`description`) VALUES ('".$newsdescription."');";

$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="vehicle-text" >
             News Added!           
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('location: adminPannelNews.php');
} else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="vehicle-text" >
        News Not Added!           
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
}

