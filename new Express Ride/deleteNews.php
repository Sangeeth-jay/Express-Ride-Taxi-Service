<?php
include 'db/db_config.php';

$newsID = $_REQUEST['newsId'];

$sql = "DELETE FROM news WHERE (`news_id` = '".$newsID."');";
$result = mysqli_query($conn,$sql);
if($result){
header('location:adminPannelNews.php');
}else{
}
?>