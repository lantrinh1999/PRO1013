<?php 
session_start();


require_once '../../commons/utils.php';

checkLogin();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'san-pham');
	die;
}
$id = $_POST['id'];
$status = $_POST['status'];
$old_filename = $_POST['old_filename'];
$product_name = $_POST['product_name'];
$detail = $_POST['detail'];
$list_price = $_POST['list_price'];
$sell_price = $_POST['sell_price'];
$cate_id = $_POST['cate_id'];
$img = $_FILES['image'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'images/'.uniqid() . '.' . $ext;

move_uploaded_file($img['tmp_name'], '../../'.$filename);

if(!$product_name){
	header('location: ' . $adminUrl . 'san-pham/edit.php?id='.$id.'&errName=Vui lòng nhập tên sản phẩm');
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
	header('location: ' . $adminUrl . 'san-pham/edit.php?id='.$id.'&errName1=Vui lòng chọn danh mục');
	die;
}
if(!$list_price){
	header('location: ' . $adminUrl . 'san-pham/edit.php?id='.$id.'&errName2=Vui lòng nhập giá');
	die;
}
if(!$sell_price){
	header('location: ' . $adminUrl . 'san-pham/edit.php?id='.$id.'&errName3=Vui lòng nhập giá khuyến mãi');
	die;
}
if($sell_price > $list_price){
	header('location: ' . $adminUrl . 'san-pham/add.php?errName3=Giá khuyễn mãi phải nhỏ hơn giá sản phẩm');
	die;
}
if(!$detail){
	header('location: ' . $adminUrl . 'san-pham/edit.php?id='.$id.'&errName4=Vui lòng nhập Mô tả');
	die;
}



    	$sql = "update " . TABLE_PRODUCT . " 
			set
				product_name = :product_name, 
				cate_id = :cate_id,
				list_price = :list_price,
				sell_price = :sell_price,
				image = :image,
				status = :status,
				detail = :detail
			where id = :id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":id", $id);
	$stmt->bindParam(":product_name", $product_name);
	$stmt->bindParam(":cate_id", $cate_id);
	$stmt->bindParam(":list_price", $list_price);
	$stmt->bindParam(":sell_price", $sell_price);
	$stmt->bindParam(":image", $filename);
		$stmt->bindParam(":status", $status);
	$stmt->bindParam(":detail", $detail);

	$stmt->execute();


$stmt->execute();

header('location: ' . $adminUrl . 'san-pham');




 ?>