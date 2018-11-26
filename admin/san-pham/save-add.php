<?php 
session_start();


require_once '../../commons/utils.php';

checkLogin();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'san-pham');
	die;
}


$product_name = $_POST['product_name'];
$detail = $_POST['detail'];
$list_price = $_POST['list_price'];
$sell_price = $_POST['sell_price'];
$cate_id = $_POST['cate_id'];
$img = $_FILES['image'];
$status = $_POST['status'];

$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'images/'.uniqid() . '.' . $ext;

move_uploaded_file($img['tmp_name'], '../../'.$filename);




if(!$product_name){
	header('location: ' . $adminUrl . 'san-pham/add.php?errName=Vui lòng nhập tên sản phẩm');
	die;
}
if(!$cate_id){
	header('location: ' . $adminUrl . 'san-pham/add.php?errName1=Vui lòng chọn danh mục');
	die;
}
if($cate_id == ""){
	header('location: ' . $adminUrl . 'san-pham/add.php?errName1=Vui lòng chọn danh mục');
	die;
}
if(!$list_price){
	header('location: ' . $adminUrl . 'san-pham/add.php?errName2=Vui lòng nhập giá');
	die;
}
if(!$sell_price){
	header('location: ' . $adminUrl . 'san-pham/add.php?errName3=Vui lòng nhập giá khuyến mãi');
	die;
}
if($sell_price > $list_price){
	header('location: ' . $adminUrl . 'san-pham/add.php?errName3=Giá khuyễn mãi phải nhỏ hơn giá sản phẩm');
	die;
}
if(!$detail){
	header('location: ' . $adminUrl . 'san-pham/add.php?errName4=Vui lòng nhập Mô tả');
	die;
}
if ($img['name'] === "" || $img['size'] === 0 ) {
	header('location: ' . $adminUrl . 'san-pham/add.php?errName5=Vui lòng chọn ảnh sản phẩm');
	die;
}


$sql = "insert into products
			(product_name, 
			cate_id, 
			list_price, 
			sell_price, 
			image,
			status,
			detail)
		values 
			(:product_name, 
			:cate_id, 
			:list_price, 
			:sell_price, 
			:image,
			:status, 
			:detail)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(":product_name", $product_name);
$stmt->bindParam(":cate_id", $cate_id);
$stmt->bindParam(":list_price", $list_price);
$stmt->bindParam(":sell_price", $sell_price);
$stmt->bindParam(":image", $filename);
$stmt->bindParam(":detail", $detail);
$stmt->bindParam(":status", $status);
$stmt->execute();
header('location: ' . $adminUrl . 'san-pham');



 ?>