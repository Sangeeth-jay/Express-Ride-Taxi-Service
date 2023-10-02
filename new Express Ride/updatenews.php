<?php
include 'db/db_config.php';

$newsID = $_REQUEST['newsId'];
$news = $_REQUEST['news-description'];

$sql = "UPDATE news SET `description` = '".$news."' WHERE (`news_id` = '".$newsID."');";
$result = mysqli_query($conn,$sql);
if($result){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-news">
     News Updated!           
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
header('location:adminPannelNews.php');
}else{
echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-news">
Record Not Updated!           
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>'; 
}
?>