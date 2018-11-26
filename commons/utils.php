<?php 
// Database config
$host = "127.0.0.1";
$dbname = "pro1013";
$dbusername = "root";
$dbpwd = "";
$conn = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8",
    $dbusername,
    $dbpwd
);
// website base url
$siteUrl = 'http://localhost:81/PRO1013/';
$adminUrl = 'http://localhost:81/PRO1013/admin/';
$adminAssetUrl = 'http://localhost:81/PRO1013/admin/adminlte/';



define('TABLE_CATEGORY', 'categories');
define('TABLE_SLIDESHOW', 'slideshows');
define('TABLE_PRODUCT', 'products');
define('TABLE_WEBSETTING', 'web_settings');
define('TABLE_COMMENT', 'comments');
define('TABLE_BRANDS', 'brands');


const USER_ROLES = [
	'admin' => 500,
	'moderator' => 300,
	'member' => 1
];


function dd($var){
	echo "<pre>";
	var_dump($var);
	die;
}

function checkLogin($role = 300){
	global $siteUrl;
	if(!isset($_SESSION['login']) 
		|| $_SESSION['login'] == null
		|| $_SESSION['login']['role'] < $role){
	  header('location: '.$siteUrl . 'login.php');
	  die;
	}
}
date_default_timezone_set("Asia/Ho_Chi_Minh");

?>