<?php 
session_start();


require_once '../../commons/utils.php';

checkLogin();

$id = $_GET['id'];

$sql = "select * from ".TABLE_COMMENT." where id = $id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetch();

if(!$cate){
	header('location: ' . $adminUrl . "comment");
	die;
}

// xoa san pham thuoc ve danh muc nay
$sql = "delete from ".TABLE_COMMENT." where id = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();



header('location: ' . $adminUrl . "comment");


 ?>