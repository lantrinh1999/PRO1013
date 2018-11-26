<?php 
// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";
$productId = $_GET['id'];
$sql = "select * from " . TABLE_PRODUCT. " where id = $productId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$product = $stmt->fetch();
$sql = "select 
      c.id, c.name,
      (select count(*) from ".TABLE_PRODUCT." where cate_id = c.id) as totalProduct
    from ".TABLE_CATEGORY." c";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetchAll();
if(!$product){
	header('location: ' . $adminUrl . 'san-pham');
}

 
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Tạo sản phẩm</title>

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
        <small>Tạo sản phẩm</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Danh mục</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <form action="<?= $adminUrl ?>san-pham/save-add.php" method="post">
            <input type="hidden" name="id" value="<?= $product['id']?>">
            <!-- Tên sản phẩm -->
            <div class="form-group">
              <label>Tên sản phẩm</label>
              <input type="text" name="name" class="form-control" value="<?= $product['product_name']?>">
              <!-- /.error -->
              <?php 
              if(isset($_GET['errName']) && $_GET['errName'] != ""){
               ?>
               <span class="text-danger"><?= $_GET['errName'] ?></span>
              <?php } 
              ?>
            </div>
            <!-- Danh mục -->
            <div class="form-group">
                <label>Danh mục</label>
                  <select name="cate_id" class="form-control">
                    <option>---</option>
                    <?php foreach ($cate as $c) : ?>
                      <?php $selected = $c['id'] === $product['cate_id'] ? "selected" : "" ?>
                    <option <?= $selected ?> value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                    <?php endforeach ?>
                  </select>
            </div>

            <!-- Mô tả -->
            <div class="form-group">
              <label>Mô tả</label>
              <textarea class="form-control" name="detail" rows="5">
                <?= $product['detail']?>
              </textarea>
            </div>
            <div class="form-group">
              <label>Giá</label>
              <input type="text" name="list_price" class="form-control" value="<?= $product['list_price']?>">
            </div>
            <div class="form-group">
              <label>Giá KM</label>
              <input type="text" name="sell_price" class="form-control" value="<?= $product['sell_price']?>">
            </div>
            <div class="form-group">

                <label>Trạng thái</label>
                  <select name="status" class="form-control">
                    <option value="1">Còn hàng</option>
                    <option value="0">Hết hàng</option>
                  </select>
            </div>
            
            <div class="text-center">
              <a href="<?= $adminUrl?>san-pham" class="btn btn-danger btn-xs">Huỷ</a>
              <button type="submit" class="btn btn-primary btn-xs">Cập nhập</button>
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

</body>
</html>
