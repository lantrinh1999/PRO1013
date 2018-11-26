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
$idS = $_SESSION['login']['id'];

if ($idS != $id) {
	$sql = " delete from users where id = $id ";
} else{
	header('location: ' . $adminUrl . "tai-khoan?success=false");
	die;
}
// xoa tai khoan
$stmt = $conn->prepare($sql);
$stmt->execute();
header('location: ' . $adminUrl . "tai-khoan");


 ?>