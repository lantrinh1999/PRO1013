<?php 
require_once './commons/utils.php';

$sql = "select * from " . TABLE_WEBSETTING;
$stmt = $conn->prepare($sql);
$stmt->execute();

$data = $stmt->fetch();

?>

<footer class="" style="background-color: #38332f">

  <div class="container">
    <div style="color: white;text-align: center;" class="">
      <br>
      <h5>LIÊN HỆ VỚI CHÚNG TÔI</h5> 
      <p><?= $data['fb'] ?></p>
      <p>Hotline: <?= $data['hotline'] ?></p>
      <br>
    </div>
  </div>

</footer>