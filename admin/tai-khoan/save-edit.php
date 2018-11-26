<?php 
session_start();
require_once '../../commons/utils.php';
checkLogin(USER_ROLES['admin']);
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'tai-khoan');
	die;
}

$id = $_POST['id'];

$email = $_POST['email'];
$fullname = $_POST['fullname'];
$password = $_POST['password'];
$cfPassword = $_POST['cfPassword'];
$role = $_POST['role'];

$sql = "select * from users where id != '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();

foreach ($users as $c) {
	if (strtolower($email) == strtolower($c['email'])) {
		header('location: ' . $adminUrl . 'tai-khoan/edit.php?id='.$id.'&msg1=Email đã được sử dụng!');
	die;
	}
}

if(!$email){
	header('location: ' . $adminUrl . 'tai-khoan/edit.php?id='.$id.'&msg1=Email không được để trống!');
	die;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header('location: ' . $adminUrl . 'tai-khoan/edit.php?id='.$id.'&msg1=Không đúng định dạng email!');
	die;
}


if($password != $cfPassword){
	header('location: ' . $adminUrl . 'tai-khoan/edit.php?id='.$id.'&msg=Xác nhận mật khẩu không đúng!');
	die;
}

$sql = "select * from users where id = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$user = $stmt->fetch();
if (!$password && !$cfPassword) {
	$password = $user['password'];
} 

if ($password === $cfPassword && $password != "") {
	$password = password_hash($password, PASSWORD_DEFAULT);
}





$sql = "update users
			set
				email = :email, 
				fullname = :fullname,
				password = :password,
				role = :role
			where id = :id";

$stmt = $conn->prepare($sql);

$stmt->bindParam(":email", $email);
$stmt->bindParam(":fullname", $fullname);
$stmt->bindParam(":password", $password);
$stmt->bindParam(":role", $role);
$stmt->bindParam(":id", $id);
$stmt->execute();

header('location: ' . $adminUrl . 'tai-khoan');

 ?>