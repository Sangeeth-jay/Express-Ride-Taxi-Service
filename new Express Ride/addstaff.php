<?php

include 'db/db_config.php';

$fullname = $_REQUEST['f_name'];
$username = $_REQUEST['u_name'];
$telephone = $_REQUEST['telephone'];
$nic = $_REQUEST['NIC'];
$password = $_REQUEST['password'];
$designation = $_REQUEST['designation'];

if ($fullname == "" && $username == "" && $telephone == "" && $nic == "" && $password == "" && $designation == ""){}

    $sql = "INSERT INTO user (`full_name`, `user_name`, `password`, `designation`, `nic`, `telephone`) VALUES ('".$fullname."', '".$username."', '".$password."', '".$designation."', '".$nic."', '".$telephone."');  ";

    $result = mysqli_query($conn,$sql);
    if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="cus_alert-text" >
             Record Added!           
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="cus_alert-text" >
        Record Not Added!           
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>'; 
    }
    

//     // echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="ltext">
//     //          Record Added!           
//     //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//     //     </div>';


