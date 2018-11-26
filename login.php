<?php 
require_once './commons/utils.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
include './_share/client_assets.php';
?>

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?= $adminAssetUrl?>bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?= $adminAssetUrl?>bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?= $adminAssetUrl?>bower_components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= $adminAssetUrl?>dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?= $adminAssetUrl?>dist/css/skins/_all-skins.min.css">
<!-- Morris chart -->
<link rel="stylesheet" href="<?= $adminAssetUrl?>bower_components/morris.js/morris.css">
<!-- jvectormap -->
<link rel="stylesheet" href="<?= $adminAssetUrl?>bower_components/jvectormap/jquery-jvectormap.css">
<!-- Date Picker -->
<link rel="stylesheet" href="<?= $adminAssetUrl?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?= $adminAssetUrl?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?= $adminAssetUrl?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


<!-- alert -->
<link rel="stylesheet" href="<?= $adminAssetUrl?>plugins/">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body style="background-color: gray" class="">

<div class="login-box">
		<div class="login-box-body">
    <p class="login-box-msg">Sign in</p>

    <form onsubmit="return validateForm()" action="<?= $siteUrl ?>post-login.php" method="post">
    	<div style="color: red">
			<?php 
              if(isset($_GET['msg']) && $_GET['msg'] != ""){
              	echo $_GET['msg'];
               }
              ?>
		</div>
      <div class="form-group">
        <input type="text" name="email" class="form-control" placeholder="Email">
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password">
      </div>
      <div class="row">
        <div class="col-xs-12">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
</div>



<script>
function validateForm() {
    var name = document.forms["myForm"]["name"].value;
    if (name === "") {
      alert("Bạn phải nhập tên") ;
        return false;
    }
    var x = document.forms["myForm"]["email"].value;
    if (x === "") {
      alert("Email không được bỏ trống") ;
        return false;
    }
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Bạn phải nhập email đúng định dạng") ;
        return false;
    }
    var y =  document.forms["myForm"]["content"].value;
    if (y === "") {
      alert("Bạn phải nhập nội dung");
        return false;
    }
}
</script>


</body>
</html>