<?php
include 'db/db_config.php';

$id = $_REQUEST['user_id'];
$fullname = $_REQUEST['f_name'];
$username = $_REQUEST['u_name'];
$telephone = $_REQUEST['telephone'];
$designation = $_REQUEST['designation'];

$sql = "UPDATE user SET `full_name` = '".$fullname."', `user_name` = '".$username."', `designation` = '".$designation."', `telephone` = '".$telephone."' WHERE (`user_id` = '".$id."');";
$result = mysqli_query($conn,$sql);
if($result){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-text">
     Record Updated!           
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}else{
echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-text">
Record Not Updated!           
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>'; 
}
?>

