<?php 
$path = '../';
require_once $path.$path.'commons/utils.php';

$id = $_GET['id'];
$sql = "select * from slideshows WHERE id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();
$users = $stsm->fetch();
if (!$users) {
	header('location: '. $adminUrl. "slidsehow");
	die;
}
$sql = "DELETE FROM slideshows WHERE id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();
header('location: '. $adminUrl. "slideshow");
?>
?>