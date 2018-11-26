<?php 
session_start();

require_once '../../commons/utils.php';
session_start();

$productId = $_GET['id'];

$sql = "select * from " . TABLE_PRODUCT . " where id = $productId";

$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetch();

if(!$cate){
	header('location: ' . $adminUrl . "san-pham");
	die;
}

// xoa san pham
$sql = " delete from " . TABLE_PRODUCT . " where id = $productId ";
$stmt = $conn->prepare($sql);
$stmt->execute();



header('location: ' . $adminUrl . "san-pham");


 ?>