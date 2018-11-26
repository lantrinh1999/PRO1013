<?php  
session_start();
$path = "../"; 
require_once $path.$path."commons/utils.php";
checkLogin(USER_ROLES['moderator']);
$userId = $_GET['id'];
$sql = "select * from " . TABLE_WEBSETTING . " where id = $userId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$user = $stmt->fetch();
if(!$user){
  header('location: ' . $adminUrl . 'thong-tin');
}
 ?>
 <style type="text/css">
   img{
    width: 350px;
    height: auto;
   }
 </style>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sửa Thông tin chung</title>

  <?php include_once $path.'_share/top_asset.php'; ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include_once $path.'_share/header.php'; ?> 

  <?php include_once $path.'_share/sidebar.php'; ?>  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Quản lí thông tin chung</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sửa Thông tin chung</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <div class="row">
        <div class="col-md-8">
          <form action="<?= $adminUrl ?>thong-tin/save-edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $userId?>">
            <input type="hidden" name="old_filename" value="<?= $user['logo'] ?>">
            <div class="form-group">
              <b>Logo</b>
              <input type="hidden" name="old_filename" value="<?= $user['logo'] ?>">
               <img width=""> id="imageTarget" src="<?= $siteUrl?><?= $user['logo']?>" class="img-responsive" >
              <input type="file" id="product_image" name="logo" class="form-control" >
            </div>
            <div class="form-group">
              <b>Số điện thoại</b>
              <input type="text" name="hotline" class="form-control" value="<?= $user['hotline']?>">
            </div>
            <div class="form-group">
              <b>Map</b>
               <textarea rows="6" class="form-control" name="map" >
                <?= $user['map']?></textarea>
            </div>
            <div class="form-group">
              <b>Email</b>
              <input type="text" name="email" class="form-control" value="<?= $user['email']?>">
            </div>
            <div class="form-group">
              <b>FB</b>
              <input type="text" name="fb" class="form-control" value="<?= $user['fb']?>">
            </div>
            <div class="text-center">
              <a href="<?= $adminUrl?>thong-tin" class="btn btn-danger btn-xs">Huỷ</a>
              <button type="submit" class="btn btn-primary btn-xs">Cập nhật</button>
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once $path.'_share/sidebar.php'; ?>  

</div>
<!-- ./wrapper -->
<?php include_once $path.'_share/bottom_asset.php'; ?>  
<script type="text/javascript">
  $(document).ready(function(){
    $('#editor').wysihtml5();
  });
  function getBase64(file, selector) {
     var reader = new FileReader();
     reader.readAsDataURL(file);
     reader.onload = function () {
      $(selector).attr('src', reader.result);
     };
     reader.onerror = function (error) {
       console.log('Error: ', error);
     };
  }
  var img = document.querySelector('#product_image');
  img.onchange = function(){
    var file = this.files[0];
    if(file == undefined){
      $('#imageTarget').attr('src', "<?= $siteUrl ?>img/default/default.png");
    }else{
      getBase64(file, '#imageTarget');
    }
  }
</script>
</body>
</html>