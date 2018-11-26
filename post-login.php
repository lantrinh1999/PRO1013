<?php
session_start();

require_once './commons/utils.php';
if ($_SERVER['REQUEST_METHOD'] != 'POST') {		
	header('location: ' . $siteUrl . 'login.php');
	die;
}

$email = $_POST['email'];
$password  = $_POST['password'];
$sql = " select * from users
			 where email = '$email'";

$stmt = $conn->prepare($sql);
$stmt->execute();
$user = $stmt->fetch();


if (!$user) {
	header('location: ' . $siteUrl . 'login.php?msg=sai tài khoản hoặc mật khẩu');
	die;
};
if (!password_verify($password, $user['password'])) {
	header('location: ' . $siteUrl . 'login.php?msg=sai tài khoản hoặc mật khẩu');
	die;
};

$_SESSION['login'] = $user;

?>
<h2>Đăng nhập thành công</h2>
 <script type="text/javascript">
 	setTimeout(function(){
 		window.location.href = '<?= $adminUrl ?>';
 	}, 1000);
 </script>