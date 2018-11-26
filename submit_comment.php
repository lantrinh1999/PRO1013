<?php 
require_once './commons/utils.php';
if($_SERVER['REQUEST_METHOD'] == "GET"){
	header('location: '. $siteUrl);
	die;
}

$pId = $_POST['id'];

$email = $_POST['email'];
$content = $_POST['content'];
$time = $_POST['time'];
		$sql = "insert into " . TABLE_COMMENT . " 
		(email, content, product_id, time_created) 
		values 
		('$email', '$content', '$pId', '$time')";
$stmt = $conn->prepare($sql);
$stmt->execute();



header('location: '. $siteUrl . 'chitiet.php?id=' . $pId);


















 ?>
