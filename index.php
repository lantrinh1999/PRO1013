
<?php 

require_once './commons/utils.php';

$newProductsQuery = " select *
            from " . TABLE_PRODUCT . " where status = 1
            order by id desc
            limit 6";
$stmt = $conn->prepare($newProductsQuery);
$stmt->execute();

$newProducts = $stmt->fetchAll();

// lay du lieu tu csdl bang products cho sp xem nhieu nhat
$mostViewsQuery = " select *
            from " . TABLE_PRODUCT . " where status = 1
            order by views desc
            limit 6";
$stmt = $conn->prepare($mostViewsQuery);
$stmt->execute();
$mostViewsProducts = $stmt->fetchAll();


$sql = "select * from news where status = 1 order by cate_id desc limit 3";

$stmt = $conn->prepare($sql);
$stmt->execute();
$news = $stmt->fetchAll();



 ?>

<!-------------------------------------------------->

<!DOCTYPE html>
<html>
<!-- head-->
<head>
<?php include './_share/client_assets.php' ?>
</head>
<!---->

<body class="bg-light">
  <!-- header-->
  <?php include './_share/header.php' ?>
  <!-- header-->
<!-------------------------------------------------->

  <!-- slider-->
  <div>
    <div style="position: relative;" class="position-relative" id="slider">
    <?php
include './_share/slider.php';
?>
    <div  style="top: 50%;left: 50%; position: absolute;   transform: translate(-50%, -50%); color: white" class="slogan position-absolute text-center">
       <h3>Có Love Kitchen</h3>
       <h2>CƠM NHÀ LÀ NHẤT</h2>
       <h5>Giảm giá đến 50% khi đặt hàng online</h5>
    </div>
  </div>
  </div>
  <!------>
  <div style="min-height: 350px;margin: 0 auto" class="bg-light">
    <div  style="position: relative;margin: 0 auto" class="bg-light">
      <div style="position: absolute; top: 100px;margin: 0 auto;left: 50%;transform: translate(-50%, -50%);z-index: 2;" class="container">
        <div style="margin: 0 auto" class=" bg-white">
          <br>
          <br>
          <h3 class="text-center">SẢN PHẨM MỚI</h3>

            <section class="regular slider responsive">
            <?php foreach ($newProducts as $np): ?>
              <div>
                <div class="">
                  <div class="img-fluid">
                    <a href="<?=$siteUrl?>chitiet.php?id=<?=$np['id']?>">
                    <img width="100%" src="<?=$siteUrl . $np['image']?>">
                    </a>
                  </div>
                  <div class="card-body text-center">
                    <h5 class="card-title">
                      <a style="color: black;" href="<?=$siteUrl?>chitiet.php?id=<?=$np['id']?>"><?=$np['product_name']?></a>
                    </h5>
                    <h5><?=$np['sell_price']?>Đ</h5>
                  </div>
                </div>
              </div>
            <?php endforeach?>
              <!----->
              <!----->
            </section>
            <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
            <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
            <script type="text/javascript">
              $(document).on('ready', function() {
               $('.responsive').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                  infinite: true,
                }
              },
              {
                breakpoint: 700,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
                }
              }
            ]
          });
              });
          </script>
        </div>
        <br>
        <br>
      </div>
    </div>

  </div>

<div class="bg-light">
  <br>
  <div class="container bg-light">
    <div  style="width: 95%" class="container bg-light">
      <div class="row">
        <div class="col-md-6">
          <h4>MIỄN PHÍ VẬN CHUYỂN</h4>
          <p>Miễn phí với đơn hàng trên 350000đ trên toàn quốc.</p>
        </div>
        <div class="col-md-6">
          <h4>ĐỔI TRẢ TRONG 7 NGÀY</h4>
          <p>Nhận đổi trả với các thiết bị dụng cụ có sử dụng điện trong vòng 7 ngày.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h4>CHƯƠNG TRÌNH GIẢM GIÁ</h4>
          <p>Hãy đến với chúng tôi để có được những sản phẩm tốt nhất.</p>
        </div>
        <div class="col-md-6">
          <h4>HỖ TRỢ KHÁCH HÀNG</h4>
          <p>Trung tâm chăm sóc khách hàng của Love Kitchen, hotline 19001009 hỗ trợ giải đáp.</p>
        </div>
      </div>
    </div>
    <br><br>
  </div>
</div>

<div style="position: relative;">
  <div style="background-image: url(./images/bl.jpg);width: 100%;min-height: 500px ;background-position: center;background-repeat: no-repeat;background-size: cover;" class="bg-image">
  
</div>
<div style="" class="bg-text container">
  <h3 class="text-center">SẢN PHẨM BÁN CHẠY</h3>
      <section class="regular-2 slider container-fluid responsive">
      <?php foreach ($mostViewsProducts as $np): ?>
        <div>
          <div class="">
            <div class="img-fluid">
              <a href="<?=$siteUrl?>chitiet.php?id=<?=$np['id']?>">
                <img width="100%" src="<?=$siteUrl . $np['image']?>">
              </a>
            </div>
            <div class="card-body text-center">
              <h5 class="card-title">
                <a style="color: white;" href="<?=$siteUrl?>chitiet.php?id=<?=$np['id']?>"><?=$np['product_name']?></a>
              </h5>
              <h5><?=$np['list_price']?>Đ</h5>
            </div>
          </div>
        </div>
      <?php endforeach?>
        <!----->

        <!----->

  </section>
  <script type="text/javascript">
    $(document).on('ready', function() {
      
      $(".regular-2").slick({
        dots: false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
              {
                breakpoint: 2000,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3
                }
              }
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                  infinite: true,
                }
              },
              {
                breakpoint: 700,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
                }
              }
            ]

      });

      $(".lazy").slick({
        lazyLoad: 'ondemand', // ondemand progressive anticipated
        infinite: true
      });
    });
</script>
</div>
</div>
<!---- Tin tức -->

<br>
<div class="container mt-5 mb-5">
  <h4 class="m-3 mb-4">TIN TỨC MỚI NHẤT</h4>
  <div class="row">
  <?php foreach ($news as $n): ?>
      
    
    <div class="col-md-4 col-sm-12">
      <div>
        <a href="<?= $siteUrl ?>chitiet-tintuc.php?id=<?= $n['id'] ?>">
          <img width="100%" src="<?= $n['image']?>">
        </a>
      </div>

        <a class="namess mt-3" href="<?= $siteUrl ?>chitiet-tintuc.php?id=<?= $n['id'] ?>">
          <h5 style="color: black;text-decoration: none;" class="mt-3"><?= $n['names']?></h5>
        </a>
        <div>
                            <?php 
                            $content = $n['content'];
                            if (strlen($content) > 150) {
                                $cutcontent = substr("$content", 0, 150);
                                $done = $cutcontent . "...";
                            } else {
                                $done = $n['content'];
                            }
                            ?>

          <p><?= $done?></p>          
        </div>

        <div class="mb-4">
          <a class="btn btn-dark" href="<?= $siteUrl ?>chitiet-tintuc.php?id=<?= $n['id'] ?>">Chi tiết</a>
        </div>




      </div>
<br>
    </div>


  <?php endforeach ?>

  </div>
  <br>
</div>

<!-------------------------------------------------->
<!--- FOOTER-->
<?php include './_share/footer.php'; ?>
<!--- FOOTER-->
</body>

</html>