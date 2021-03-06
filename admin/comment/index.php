<?php 
session_start();

// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";
// dem ton so record trong bang danh muc
checkLogin();
$sql = "select 
      cmt.*,
      p.product_name
    from " . TABLE_COMMENT . " cmt
    join " . TABLE_PRODUCT . " p
      on cmt.product_id = p.id
    group by cmt.id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$comment = $stmt->fetchAll();
 //dd($products);
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE | Quản lý Bình luận</title>

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
        <small>Quản lý Bình luận</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Danh mục</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-body">
                <table class="table table-bordered">
                  <tbody>
                  <tr>
                    <th style="width: 10px">Id</th>
                    <th style="width: 130px">Tên sản phẩm</th>

                    <th style="width: 200px">Email</th>
                    <th style="">Nội dung</th>
                    <th style="width: 50px">
                      
                    </th>
                  </tr>
                  <?php foreach ($comment as $cmt): ?>
                    
                    <tr>
                      <td><?= $cmt['id']?></td>
                      <td><?= $cmt['product_name']?></td>
                      <td>
                        <?= $cmt['email']?>
                      </td>
                      
                      <td>
                        <?= $cmt['content'] ?>
                      </td>
                      <td>
                        
                        <a href="javascript:;"
                      linkurl="<?= $adminUrl?>comment/remove.php?id=<?= $cmt['id']?>"
                      class="btn btn-xs btn-danger btn-remove"
                      >

                          <i class="fa fa-trash"></i> Xoá
                        </a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
                </table>
              </div>
              <!-- /.box-body -->
          </div>
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

 
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
  <?php 
  if(isset($_GET['success']) && $_GET['success'] == 'true'){
    ?>
    swal('Thêm Sản phẩm thành công!');
  <?php
  }
   ?>
  $('.btn-remove').on('click', function(){

    var removeUrl = $(this).attr('linkurl');
    // var conf = confirm('Bạn có chắc chắn muốn xoá danh mục này không?');
    // if(conf){
    //  window.location.href = removeUrl;
    // }
    swal({
      title: "Cảnh báo",
      text: "Bạn có chắc chắn muốn xoá mục này không?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = removeUrl;
      } 
    });
  });

</script>

</body>
</html>
