<?php 
session_start();

require_once '../../commons/utils.php';

checkLogin();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'profile');
	die;
}
$id = $_POST['id'];
$email = $_POST['email'];
$fullname = $_POST['fullname'];
$password = $_POST['password'];
$cfPassword = $_POST['cfPassword'];
$img = $_FILES['image'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'images/'.uniqid() . '.' . $ext;
move_uploaded_file($img['tmp_name'], '../../'.$filename);

$old_filename = $_POST['old_filename'];

if ($img['name'] === "" || $img['size'] === 0 ) {
	$filename = $old_filename;
}
$imageFileType = strtolower($ext);
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
	$filename = $old_filename;
	
}

$sql = "select * from users where id not in ('$id')";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();


if(!$fullname){
	header('location: ' . $adminUrl . 'profile/edit.php?id='.$id.'&errName=Vui lòng nhập tên');
	die;
}


foreach ($users as $c) {
	if (strtolower($email) == strtolower($c['email'])) {
		header('location: ' . $adminUrl . 'profile/edit.php?id='.$id.'&msg1=Email đã được sử dụng!');
	die;
	}
}

if(!$email){
	header('location: ' . $adminUrl . 'profile/edit.php?id='.$id.'&msg1=Email không được để trống!');
	die;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header('location: ' . $adminUrl . 'profile/edit.php?id='.$id.'&msg1=Không đúng định dạng email!');
	die;
}







if($password != $cfPassword){
	header('location: ' . $adminUrl . 'profile/edit.php?id='.$id.'&msg=Xác nhận mật khẩu không đúng!');
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






$sql = "update users set email = :email, fullname = :fullname, password = :password, avatar = :image where id = :id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":fullname", $fullname);
$stmt->bindParam(":password", $password);
$stmt->bindParam(":image", $filename);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
header('location: ' . $adminUrl . 'profile');
 ?>