<?php 
session_start();


require_once '../../commons/utils.php';

checkLogin();

$cateId = $_GET['id'];

$sql = "select * from ".TABLE_CATEGORY." where id = $cateId";

$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetch();

if(!$cate){
	header('location: ' . $adminUrl . "danh-muc");
	die;
}

// xoa san pham thuoc ve danh muc nay
$sql = "delete from ".TABLE_PRODUCT." where cate_id = $cateId";
$stmt = $conn->prepare($sql);
$stmt->execute();

// xoa danh muc
$sql = "delete from ".TABLE_CATEGORY." where id = $cateId";
$stmt = $conn->prepare($sql);
$stmt->execute();

header('location: ' . $adminUrl . "danh-muc");


 ?>