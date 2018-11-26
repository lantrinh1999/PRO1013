<?php 
session_start();
require_once './commons/utils.php';
$cart = isset($_SESSION['CART']) == true ? $_SESSION['CART'] : [];
$totalPrice = 0;

$totalItemInCart = 0;
if(isset($_SESSION['CART'])
  && count($_SESSION['CART'])>0){
  $cart = $_SESSION['CART'];
foreach ($cart as $pro) {
  $totalItemInCart += $pro['quantity'];
}
}

$sql = "select * from " . TABLE_WEBSETTING;
$stmt = $conn->prepare($sql);
$stmt->execute();

$data = $stmt->fetch();

?>
  <header class=" bg-light">
    <div class="border-bottom">
    <div class="container">
        <div class="row justify-content-between" style="padding: 5px">
          <span>
            <i style="margin-left: 20px" class="fas fa-map-marker-alt fa-sm "></i>
            <span class="text-secondary text small"><?= $data['fb'] ?></span>
          </span>
          <span class="text-sm-right">
            <a style="margin-right: 10px" class="text-secondary text small" href="login.php">Đăng nhập</a>
          </span>
        </div>
      </div>
    </div>
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="index.php"><img width="250px" src="<?= $siteUrl . $data['logo'] ?>"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse float-right mt-3" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="<?= $siteUrl ?>index.php">TRANG CHỦ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= $siteUrl ?>san-pham.php">SẢN PHẨM</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= $siteUrl ?>tin-tuc.php">TIN TỨC</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= $siteUrl ?>gioi-thieu.php">GIỚI THIỆU</a>
              </li>
              <li class="nav-item mr-3">
                <a class="nav-link" href="<?= $siteUrl ?>lien-he.php">LIÊN HỆ</a>
              </li>
              <li class="nav-item mr-3">
                <?php 
                if ($totalItemInCart > 0) {
                  $clc = "red";
                }
                else{
                  $clc = "";
                }

                 ?>
                <a class="nav-link" href="<?= $siteUrl ?>detail-cart.php"><i style="color:<?= $clc  ?>" class="fas fa-lg fa-cart-plus"></i></a>
              </li>

              <li class="nav-item ">
                <form method="get" action="<?= $siteUrl ?>search.php" class="form-inline my-2 my-lg-0">
                  <input style="max-width: 200px" name="search" class="nav-item form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
                </form>
              </li>

              
              
            </ul>
          </div>
        </nav>
        <br>
    </div>
  </header>