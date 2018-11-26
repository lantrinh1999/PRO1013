<?php 
require_once './commons/utils.php';

// 1. Kiem tra xem id danh muc co thuc su ton tai khong
if($_SERVER['REQUEST_METHOD'] != 'GET'){
  header("location: $siteUrl" . "index.php");
  die;
}

$name = $_GET['search'];

$pageNumber = isset($_GET['page']) == true ? $_GET['page'] : 1;
$pageSize = 3;
$offset = ($pageNumber - 1) * $pageSize;

// 2. lay danh sach san pham thuoc danh muc

$sql = " select * FROM products WHERE product_name LIKE '%$name%' "; 
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();
$notf = "";
if (!$products) {
  $notf = "Không tìm thấy sản phẩm";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
include './_share/client_assets.php';
?>

	<title>Tìm kiếm sản phẩm</title>
  <link rel="stylesheet" type="text/css" href="plugins/simplePagination/simplePagination.css">
  <script src="plugins/simplePagination/jquery.simplePagination.js" type="text/javascript"></script>
</head>
<body>
    <?php 
    include './_share/header.php';
    ?>


<br>
<br>
<br>
<div style="min-height: 300px" class="container">

    
      <div class="tittle-cate">
			</div>
    <!-- /.row -->
    <h3>Tìm kiếm "<?= $name ?>"</h3>
    <br>
    <h4><?= $notf ?></h4>
    <div class="row">

      <?php foreach ($products as $np) : ?>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="<?= $siteUrl . $np['image'] ?>" alt=""></a>
          <div class="card-body">
            <p class="card-title text-center"><?= $np['product_name'] ?></p>
            <div class="text-left">
						Giá bán: <a class="">
							<span class="list_price">
								<?= $np['list_price'] ?>Đ</span>
							</a>
						<br>
          </div>
          <br>
          <div class="footer-product text-center view">
            <a href="<?= $siteUrl ?>chitiet.php?id=<?= $np['id'] ?>" class="details btn btn-dark">Xem chi tiết</a>
            <span></span>
						
					</div>
          </div>
        </div>
      </div>
      <?php endforeach ?>
    </div>
    <!-- phan trang -->
    <!-- phan trang -->
</div>
<br>

  <!-- Footer -->
  <!-- Footer -->
<?php
include './_share/footer.php';
?>
<!-- Footer -->
<!-- Footer -->
<script type="text/javascript">
	 	var pageUrl = '<?= $siteUrl . "danhmuc.php?id=" . $id ?>';
	 	$('.paginate').pagination({
	        items: <?= $cate['total_product'] ?>,
	        currentPage: <?= $pageNumber ?>, 
	        itemsOnPage: <?= $pageSize ?>,
	        cssStyle: 'light-theme',
	        onPageClick: function(val){
	        	window.location.href = pageUrl+`&page=${val}`;
	        }
	    });
</script>



</body>
</html>