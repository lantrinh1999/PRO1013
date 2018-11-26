<?php 
session_start();

require_once '../../commons/utils.php';
session_start();

$id = $_GET['id'];

$sql = "select * from users where id = $id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$user = $stmt->fetch();

if(!$user){
	header('location: ' . $adminUrl . "tai-khoan");
	die;
}

// xoa tai khoan
$sql = " delete from users where id = $id ";
$stmt = $conn->prepare($sql);
$stmt->execute();



header('location: ' . $adminUrl . "tai-khoan");


 ?>