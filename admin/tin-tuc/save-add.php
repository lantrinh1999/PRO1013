<?php 
session_start();


require_once '../../commons/utils.php';

checkLogin();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'tin-tuc');
	die;
}


$product_name = $_POST['product_name'];
$detail = $_POST['detail'];
$cate_id = $_POST['cate_id'];
$img = $_FILES['image'];
$status = $_POST['status'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'images/'.uniqid() . '.' . $ext;

move_uploaded_file($img['tmp_name'], '../../'.$filename);




if(!$product_name){
	header('location: ' . $adminUrl . 'tin-tuc/add.php?errName=Vui lòng nhập tên bài viết');
	die;
}
if(!$cate_id){
	header('location: ' . $adminUrl . 'tin-tuc/add.php?errName1=Vui lòng chọn danh mục');
	die;
}
if($cate_id == ""){
	header('location: ' . $adminUrl . 'tin-tuc/add.php?errName1=Vui lòng chọn danh mục');
	die;
}
if(!$detail){
	header('location: ' . $adminUrl . 'tin-tuc/add.php?errName4=Vui lòng nhập Mô tả');
	die;
}
if ($img['name'] === "" || $img['size'] === 0 ) {
	header('location: ' . $adminUrl . 'tin-tuc/add.php?errName5=Vui lòng chọn ảnh bài viết');
	die;
}


$sql = "insert into news
			(names, 
			cate_id, 
			image,
			status,
			content)
		values 
			(:product_name,
			:cate_id,
			:image,
			:status, 
			:detail)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(":product_name", $product_name);
$stmt->bindParam(":cate_id", $cate_id);
$stmt->bindParam(":image", $filename);
$stmt->bindParam(":detail", $detail);
$stmt->bindParam(":status", $status);
$stmt->execute();
header('location: ' . $adminUrl . 'tin-tuc');



 ?>