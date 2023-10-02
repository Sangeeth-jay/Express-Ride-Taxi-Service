<?php
include 'db/db_config.php';
$id = $_REQUEST['user_id'];

$sql = "DELETE FROM user WHERE (`user_id` = '".$id."');";
$result = mysqli_query($conn,$sql);
if($result){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-text">
     Record Deleted!           
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}else{
echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-text">
Record Not Deleted!           
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>'; 
}

?>