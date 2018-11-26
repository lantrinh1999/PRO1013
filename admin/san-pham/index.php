<?php 
// hien thi danh sach danh muc cua he thong
session_start();

$path = "../";
require_once $path.$path."commons/utils.php";
// dem ton so record trong bang danh muc

checkLogin();
$sql = "select 
      p.*, c.name
    from " . TABLE_CATEGORY . " c
    join " . TABLE_PRODUCT . " p
      on c.id = p.cate_id
    group by p.id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();
 //dd($products);
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>AdminLTE | Quản lý Sản phẩm</title>

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
        <small>Quản lý sản phẩm</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sản phẩm</li>
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
                    <th style="width: 110px">Tên sản phẩm</th>
                    <th style="width: 120px">Tên danh mục</th>
                    <th>Mô tả</th>
                    <th style="width: 80px">Giá</th>
                    <th style="width: 120px">Giá khuyến mãi</th>
                    <th style="width: 100px">Hình ảnh</th>
                    <th style="width: 90px">Trạng thái</th>
                    <th style="width: 80px">Lượt view</th>
                    <th style="width: 135px;">
                      <a href="<?= $adminUrl?>san-pham/add.php"
                        class="btn btn-xs btn-success"
                        >
                        <i class="fa fa-plus"></i> Thêm mới
                      </a>
                    </th>
                  </tr>
                  <?php foreach ($products as $p): ?>
                    
                    <tr>
                      <td><?= $p['id']?></td>
                      <td><?= $p['product_name']?></td>
                      <td>
                        <?= $p['name']?>
                      </td>
                      
                      <td><div style="">
                        <?= $p['detail']?>
                      </div></td>
                      <td><?= $p['list_price']?></td>
                      <td><?= $p['sell_price']?></td>
                      <td>
                        <img style="width: 100%" src="<?=$path . $path . $p['image']?>">
                      </td>
                      <td>
                        <?php
                         if ($p['status'] == -1) {
                           echo "Hết hàng";
                         } else {
                           echo "Còn hàng";
                         }
                        ?>
                      </td>
                      <td>
                        <?= $p['views'] ?>
                      </td>
                      <td>
                        <a href="<?= $adminUrl?>san-pham/edit.php?id=<?= $p['id']?>"
                        class="btn btn-xs btn-info"
                        >
                          <i class="fa fa-pencil"></i> Cập nhật
                        </a>
                        <a href="javascript:;"
                          linkurl="<?= $adminUrl?>san-pham/remove.php?id=<?= $p['id']?>"
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
      text: "Bạn có chắc chắn muốn xoá sản phẩm này không?",
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
