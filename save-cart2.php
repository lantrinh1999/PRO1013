<?php 
session_start();
$cart = isset($_SESSION['CART']) == true ? $_SESSION['CART'] : [];
if (empty($cart) || $cart == NULL || !isset($cart) || $cart == "") {
	header('location: '.$siteUrl.'detail-cart.php?err=null');
	die;
}
require_once 'commons/utils.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	header('location: '.$siteUrl.'detail-cart.php');
	die;
};
date_default_timezone_set("Asia/Ho_Chi_Minh");
 // dd($cart);

$list_price = $cart['list_price'];
$name = $_POST['name'];
$phone =$_POST['phone'];
$email = $_POST['email'];
$note = $_POST['note'];
$totalPrice = $_POST['totalPrice'];
if ($totalPrice == 0) {
	header('location: '.$siteUrl.'detail-cart.php?err=null');
	die;
}
if (!isset($totalPrice)) {
	header('location: '.$siteUrl.'detail-cart.php?err=null');
	die;
}

$date = $_POST['date'];
//insert invoices
$sql = "insert into invoices(customer_name,customer_phone,total_price,customer_email, note,status,created_date) VALUES ('$name','$phone','$totalPrice','$email','$note','0','$date')";
$conn->exec($sql);

//lay id cuoi cung
$id_invoice = $conn->lastInsertId();

// insert invoices_details
foreach ($cart as $value) {
	$id_product = $value['id'];
	$quanlity = $value['quantity'];
	$list_price = $value['list_price'];
	$total = $quanlity * $list_price;
	$sql = "insert into invoice_details(product_id,invoice_id,quanlity,unit_price,total_price) VALUES ('$id_product','$id_invoice','$quanlity','$list_price','$total')";
	$conn->exec($sql);
}
unset($_SESSION['CART']);
header('location: '.$siteUrl.'detail-cart.php?success=true')
?>
