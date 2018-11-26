<?php 
session_start();
require_once '../../commons/utils.php';

checkLogin();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'thong-tin');
	die;
}
$old_filename = $_POST['old_filename'];
$hotline = $_POST['hotline'];
$map = $_POST['map'];
$email = $_POST['email'];
$fb = $_POST['fb'];
$img = $_FILES['logo'];
$old_filename = $_POST['old_filename'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'img/'.uniqid() . '.' . $ext;
move_uploaded_file($img['tmp_name'], '../../'.$filename);
if ($img['name'] === "" || $img['size'] === 0 ) {
	$filename = $old_filename;
}
	
    	$sql = "update " . TABLE_WEBSETTING . " 
			set
				fb = '$fb',
				map = '$map',
				email = '$email',
				logo = '$filename',
				hotline = '$hotline'";

	$stmt = $conn->prepare($sql);
	// $stmt->bindParam(":id", $id, PDO::PARAM_STR);
	// $stmt->bindParam(":fb", $fb, PDO::PARAM_STR);
	// $stmt->bindParam(":map", $map, PDO::PARAM_STR);
	// $stmt->bindParam(":email", $email, PDO::PARAM_STR, PDO::PARAM_STR);
	// $stmt->bindParam(":image", $filename, PDO::PARAM_STR);
	// $stmt->bindParam(":hotline", $hotline, PDO::PARAM_STR);
	$stmt->execute();

header('location: ' . $adminUrl . 'thong-tin');




 ?>