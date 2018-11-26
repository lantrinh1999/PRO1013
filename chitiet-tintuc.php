
<?php 

require_once './commons/utils.php';
$id = $_GET['id'];



$sql = "select * from news where id = $id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$news = $stmt->fetch();



 ?>

<!-------------------------------------------------->

<!DOCTYPE html>
<html>
<!-- head-->
<head>
<?php include './_share/client_assets.php' ?>
</head>
<!---->

<body>
  <!-- header-->
  <?php include './_share/header.php' ?>
  <!-- header-->
<!-------------------------------------------------->

<div class="container">
  <img class="mb-3" width="100%" src="<?= $news['image'] ?>">
  <div>
    <h4 class="mb-4"><?= $news['names'] ?></h4>
    <p><?= $news['content'] ?></p>
  </div>

</div>
</div>
 

<!-------------------------------------------------->
<!--- FOOTER-->
<?php include './_share/footer.php'; ?>
<!--- FOOTER-->
</body>

</html>