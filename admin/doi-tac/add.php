<?php 
session_start();


// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";

checkLogin();

// dem ton so record trong bang danh muc

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Tạo đối tác</title>

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
        <small>Tạo đối tác</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Danh mục</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <form action="<?= $adminUrl ?>doi-tac/save-add.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6">
          
            <div class="form-group">
              <label>Tên đối tác</label>
              <input type="text" name="name" class="form-control" value="">
              <?php 
              if(isset($_GET['errName']) && $_GET['errName'] != ""){
               ?>
               <span class="text-danger"><?= $_GET['errName'] ?></span>
              <?php } ?>
            </div>
            <div class="row">
            <div class="col-md-offset-3">
              <img  id="imageTarget" width="70%" src="<?= $siteUrl ?>/img/default/image.png" class="img-reponsive">
            </div>
          </div>
          <div class="form-group">
              <label>Ảnh</label>
              <input id="product_image" type="file" name="image" class="form-control">
            </div>
            <div class="col-xs-12 col-md-offset-3">
          <div class="text-center">
              <a href="<?= $adminUrl?>doi-tac" class="btn btn-danger btn-xs">Huỷ</a>
              <button type="submit" class="btn btn-primary btn-xs">Tạo mới</button>
            </div>
        </div>
            
          
        </div>
        <div class="col-md-6">

        </div>
        
      </div>
      </form>
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
  })


  function getBase64(file, selector) {
     var reader = new FileReader();
     reader.readAsDataURL(file);
     reader.onload = function () {
      $(selector).attr('src', reader.result);
       // return reader.result;
     };
     reader.onerror = function (error) {
       console.log('Error: ', error);
     };
  }

  var img = document.querySelector('#product_image');
  img.onchange = function(){
    var file = this.files[0];
    if (file == undefined) {
      $('#imageTarget').attr('src', "<?= $siteUrl ?>/img/default/image.png" )
    }
    getBase64(file, '#imageTarget');
  }







</script>
</body>
</html>
