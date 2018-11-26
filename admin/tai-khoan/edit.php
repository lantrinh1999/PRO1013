<?php 
session_start();
// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";
checkLogin(USER_ROLES['admin']);
$id = $_GET['id'];
$sql = "select * from users where id = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$user = $stmt->fetch();
if(!$user){
  header('location: ' . $adminUrl . "tai-khoan");
  die;
}







 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Quản lý Tài khoản</title>

  <?php include_once $path.'_share/top_asset.php'; ?>



<style type="text/css">
  .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #000 !important;
    cursor: default;
background-color: transparent !important;
border: 1px solid #ddd;
    /* border-bottom-color: transparent; */
    border-bottom: none !important;
    font-weight: bold !important;


}

</style>


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
        <small>Quản lý tài khoản</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tài khoản</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

<div class="">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul style="width: 300px; border-bottom: none !important" class="nav nav-tabs ">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Thông tin</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Mật khẩu</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content bg-light">
                        <div class="tab-pane fade in active bg-light" id="tab1default">
                          <form action="<?= $adminUrl?>/tai-khoan/save-edit.php" method="post" >
                            <div class="col-md-6">
                              
                              <div class="form-group">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <label>Email</label>
                                <!-- /.error -->
                                <?php 
                                if(isset($_GET['msg1']) && $_GET['msg1'] != ""){
                                 ?>
                                 <span class="text-danger"> | <?= $_GET['msg1'] ?></span>
                                <?php } 
                                ?>
                                <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Tên đầy đủ</label>
                                <input type="text" name="fullname" class="form-control" value="<?= $user['fullname'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Quyền</label>
                                <select name="role" class="form-control">
                                  <?php foreach (USER_ROLES as $key => $value): ?>
                                    <option value="<?= $value ?>"><?= $key ?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                              <div class="col-md-12 text-right">
                                <a href="<?= $adminUrl?>tai-khoan" class="btn btn-xs btn-danger">Huỷ</a>
                                <button type="submit" class="btn btn-xs btn-primary">Lưu</button>
                              </div>
                            </div>
                          </form>
                        </div>

                        <div class="tab-pane fade bg-light" id="tab2default">
                          <form action="<?= $adminUrl?>/tai-khoan/save-edit.php" method="post" >
                            <div class="col-md-6">

                              <div style="display: none;">
                              <div class="form-group">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <label>Email</label>
                                <!-- /.error -->
                                <?php 
                                if(isset($_GET['msg1']) && $_GET['msg1'] != ""){
                                 ?>
                                 <span class="text-danger"> | <?= $_GET['msg1'] ?></span>
                                <?php } 
                                ?>
                                <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Tên đầy đủ</label>
                                <input type="text" name="fullname" class="form-control" value="<?= $user['fullname'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Quyền</label>
                                <select name="role" class="form-control">
                                  <?php foreach (USER_ROLES as $key => $value): ?>
                                    <option value="<?= $value ?>"><?= $key ?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                              </div>

                              <div class="form-group">
                                <label>Mật khẩu mới</label>
                                <input type="password" name="password" class="form-control">
                              </div>
                              <!-- /.error -->
                                <?php 
                                if(isset($_GET['msg']) && $_GET['msg'] != ""){
                                 ?>
                                 <span class="text-danger"><?= $_GET['msg'] ?></span>
                                <?php } 
                                ?>
                              <div class="form-group">
                                <label>Xác nhận mật khẩu mới</label>
                                <input type="password" name="cfPassword" class="form-control">
                              </div>

                              <div class="col-md-12 text-right">
                                <a href="<?= $adminUrl?>tai-khoan" class="btn btn-xs btn-danger">Huỷ</a>
                                <button type="submit" class="btn btn-xs btn-primary">Lưu</button>
                              </div>
                            </div>
                          </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>

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
