<?php 
require_once './commons/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $siteUrl . 'lienhe.php');
	die;
}


$email = $_POST['email'];
$name = $_POST['name'];
$content = $_POST['content'];


$sql = "insert into contact
			(email, 
			name, 
			content)
		values 
			(:email, 
			:name, 
			:content)";
			
$stmt = $conn->prepare($sql);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":content", $content);
$stmt->execute();
header('location: ' . $siteUrl . 'lien-he.php?success=true');

 ?>