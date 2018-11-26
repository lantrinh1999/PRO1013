<?php 
// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";
session_start();
// dem ton so record trong bang danh muc
$sql = "select * from slideshow";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cates = $stmt->fetchAll();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Quản lý sản phẩm</title>

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
        <small>Slideshow</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sản phẩm</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <form enctype="multipart/form-data" action="<?= $adminUrl?>slideshow
          /save_add.php" method="post" >
          <div class="col-md-6">
             <div class="form-group">
              <label>Url</label>
              <input type="text" name="url" class="form-control">
            </div>
            <div class="form-group">
              <label>Status</label>
                  <select name="status">
                    <option value="1">Hiển thị</option>
                      <option value="0">Ẩn</option>
                  </select>
               
            </div>
            
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <img id="imageTarget" src="<?= $siteUrl?>/public/img/default/placeholder.png" class="img-responsive" >
              </div>
            </div>
            <div class="form-group">
              <label>Ảnh sản phẩm</label>
              <input type="file" id="product_image" name="image" class="form-control">
            </div>
          </div>
          
          <div class="col-md-12 text-right">
            <a href="<?= $adminUrl?>slideshow" class="btn btn-xs btn-danger">Huỷ</a>
            <button type="submit" class="btn btn-xs btn-primary">Lưu</button>
          </div>
        </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <?php include_once $path.'_share/footer.php'; ?>  
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
      $('#imageTarget').attr('src', "<?= $siteUrl ?>img/default/default-picture.jpg");
    }else{
      getBase64(file, '#imageTarget');
    }
  }
</script>

</body>
</html>