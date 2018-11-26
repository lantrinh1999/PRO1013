<?php 
session_start();


require_once '../../commons/utils.php';

checkLogin();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'tin-tuc');
	die;
}
$id = $_POST['id'];
$status = $_POST['status'];
$old_filename = $_POST['old_filename'];
$product_name = $_POST['product_name'];
$detail = $_POST['detail'];
$cate_id = $_POST['cate_id'];
$img = $_FILES['image'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'images/'.uniqid() . '.' . $ext;

move_uploaded_file($img['tmp_name'], '../../'.$filename);

if(!$product_name){
	header('location: ' . $adminUrl . 'tin-tuc/edit.php?id='.$id.'&errName=Vui lòng nhập tiêu đề');
	die;
}

if ($img['name'] === "" || $img['size'] === 0 ) {
	$filename = $old_filename;
}
$imageFileType = strtolower($ext);
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
	$filename = $old_filename;
	
}

if($cate_id == ""){
	header('location: ' . $adminUrl . 'tin-tuc/edit.php?id='.$id.'&errName1=Vui lòng chọn danh mục');
	die;
}

if(!$detail){
	header('location: ' . $adminUrl . 'tin-tuc/edit.php?id='.$id.'&errName4=Vui lòng nhập nội dung');
	die;
}



    	$sql = "update news 
			set
				names = :product_name, 
				cate_id = :cate_id,
				image = :image,
				status = :status,
				content = :detail
			where id = :id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":id", $id);
	$stmt->bindParam(":product_name", $product_name);
	$stmt->bindParam(":cate_id", $cate_id);
	$stmt->bindParam(":image", $filename);
		$stmt->bindParam(":status", $status);
	$stmt->bindParam(":detail", $detail);

	$stmt->execute();


$stmt->execute();

header('location: ' . $adminUrl . 'tin-tuc');




 ?>