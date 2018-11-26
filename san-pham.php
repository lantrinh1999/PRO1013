
<?php 

require_once './commons/utils.php';


$sql = "select 
        c.*,
        (select count(*) from products) as total_product
    from " . TABLE_CATEGORY . " c ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetch();

$pageNumber = isset($_GET['page']) == true ? $_GET['page'] : 1;
$pageSize = 100;
$offset = ($pageNumber - 1) * $pageSize;

// 2. lay danh sach san pham thuoc danh muc
$sql = "select * from " . TABLE_PRODUCT 
  . " where status = 1 limit $offset, $pageSize";

$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();

// lay du lieu tu csdl bang products cho sp xem nhieu nhat
$mostViewsQuery = " select *
            from " . TABLE_PRODUCT . "
            order by views desc
            limit 4";
$stmt = $conn->prepare($mostViewsQuery);
$stmt->execute();

$mostViewsProducts = $stmt->fetchAll();



?>


<!-------------------------------------------------->

<!DOCTYPE html>
<html>
<!-- head-->
<head>
<?php include './_share/client_assets.php' ?>
<style type="text/css">

</style>
</head>
<!---->

<body class="bg-light">
  <!-- header-->
  <?php include './_share/header.php' ?>
  <!-- header-->
<!-------------------------------------------------->
<div class="container">
  <hr>
</div>
<div class="container">
  <div class="mt-3 mb-5">
        <h4>TẤT CẢ SẢN PHẨM</h4>
      </div>
  <div class="row">
    <div class="col-lg-9 col-ms-12">
      
      <div class="row">

      <?php foreach ($products as $np) : ?>
        <div class="col-lg-4 col-6 mb-4">
          <div class="card h-100">
            <div style="width: 95%;margin: 0 auto;margin: 5px">
              <a href="<?= $siteUrl ?>chitiet.php?id=<?= $np['id'] ?>">
              <img style="margin: 0 auto" width="100%" class="card-img-top" src="<?= $siteUrl . $np['image'] ?>" alt="">
            </a>
            </div>
            <div class="card-body text-center">
              <h6><?= $np['list_price'] ?>Đ</h6>
                            <?php 
                            $mainname = $np['product_name'];
                            if (strlen($mainname) > 20) {
                                $cutname = substr("$mainname", 0, 20);
                                $donename = $cutname . "...";
                            } else {
                                $donename = $np['product_name'];
                            }
                            ?>
              <h6 class="card-title">
                <a href="<?= $siteUrl ?>chitiet.php?id=<?= $np['id'] ?>"><?= $donename ?></a>
              </h6>
              
              <p class="card-text text-left"></p>
            </div>
          </div>
        </div>
      <?php endforeach ?>
        <!----------->

      </div>
    </div>

    <div class="col-lg-3 col-ms-12 col-12">
      <div class="card container-fluid" style="width: 98%">
        <div class="header">
          <br>
          <h5>SẢN PHẨM BÁN CHẠY</h5>
        </div>
        <br>
        <hr>
        <div class="row">
        <?php foreach ($mostViewsProducts as $np): ?>
          <!----------->
          <div class="col-6 col-lg-12 mb-4">
            <div style="background-color: white;" class="border-light h-100 row">
              <div class="col-5" style="width: 99%;">
                <a href="<?= $siteUrl ?>chitiet.php?id=<?= $np['id'] ?>">
                <img style="margin: 0 auto" width="100%" class="card-img-top" src="<?= $siteUrl . $np['image'] ?>" alt="">
              </a>
              </div>
              <div class="card-body text-left col-7">
                <p class="card-title">
                           <?php 
                            $mainname = $np['product_name'];
                            if (strlen($mainname) > 20) {
                                $cutname = substr("$mainname", 0, 20);
                                $donename = $cutname . "...";
                            } else {
                                $donename = $np['product_name'];
                            }
                            ?>
                  <a href="<?= $siteUrl ?>chitiet.php?id=<?= $np['id'] ?>"><?= $donename ?></a>
                </p>
                <p>$24.99</p>
              </div>
            </div>
            <hr>
          </div>
        <?php endforeach?>
          <!----------->
          <!----------->

        </div>
      </div>
    </div>
  </div>
</div>
<!-------------------------------------------------->
<!--- FOOTER-->
<br>
<?php include './_share/footer.php'; ?>
<!--- FOOTER-->
</body>

</html>