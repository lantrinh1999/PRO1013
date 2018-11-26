
<?php 

require_once './commons/utils.php';

$sql = "select * from news where status = 1 order by id desc";

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
<style type="text/css">
  .namess{
    color: black !important;

  }

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
<!---------------------------------           ----------------->
<div class="container mt-5 mb-4">
  <h3>
    TIN TỨC
  </h3>
</div>
<!--- -->
<div class="container">
  <div class="row">
    <div class="col-lg-9">
<?php foreach ($news as $n): ?>
  

      <div class="news mt-2 mt-3">
        <div class="img-fluid">
        <a href="<?= $siteUrl ?>chitiet-tintuc.php?id=<?= $n['id'] ?>">
          <img width="100%" src="<?= $n['image']?>">
        </a>
        </div>
        <div class="card-title mt-3 mb-3">
        <a class="namess" href="<?= $siteUrl ?>chitiet-tintuc.php?id=<?= $n['id'] ?>">
          <h5><?= $n['names']?></h5>
        </a>
          <?php 
                            $content = $n['content'];
                            if (strlen($content) > 250) {
                                $cutcontent = substr("$content", 0, 250);
                                $done = $cutcontent . "...";
                            } else {
                                $done = $n['content'];
                            }
                            ?>
          <p><?= $done?></p>
        </div>
        <div>
          <a class="btn btn-dark" href="<?= $siteUrl ?>chitiet-tintuc.php?id=<?= $n['id'] ?>">Chi tiết</a>
        </div>
      </div>
      <hr>
      <!------>
      <?php endforeach ?>

</div>
</div>
</div>
    </div>
  </div>
</div>



<!---------------------------------           ----------------->
<!--- FOOTER-->
<br>
<?php include './_share/footer.php'; ?>
<!--- FOOTER-->
</body>

</html>