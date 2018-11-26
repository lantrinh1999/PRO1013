<?php 
require_once '../../commons/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'slideshow');
	die;
}

$url = $_POST['url'];
$status = $_POST['status'];
$img = $_FILES['image'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'images/slider/'.uniqid() . '.' . $ext;

move_uploaded_file($img['tmp_name'], '../../' . $filename);

$sql = "insert into slideshows (url,status,image) values (:url,:status,:image)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":url", $url);
$stmt->bindParam(":status", $status);
$stmt->bindParam(":image", $filename);
$stmt->execute();

header('location: ' . $adminUrl . 'slideshow');
 ?>