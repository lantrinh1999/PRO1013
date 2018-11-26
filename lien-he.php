
<?php 

require_once './commons/utils.php';
$sql = "select * from " . TABLE_WEBSETTING;
$stmt = $conn->prepare($sql);
$stmt->execute();

$data = $stmt->fetch();

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
<div class="container">
  <hr>
</div>
<!---------------------------------           ----------------->
<!--- -->
<div style="" class="container-fluid">
	<!---- MAP --->
	<?= $data['map'] ?>
</div>



<br>
<br>
<br>
  <!-- Page Content -->
 <div id="content">
        <div class="container">
            <h2 class="title-product">Liên hệ với chúng tôi</h2>
<div class="row">
                <div class="col-lg-8">
                <form onsubmit="return validateForm()" action="<?= $siteUrl ?>save-add-contact.php" class="myForm" name="myForm" method="post">

            <input type="hidden" name="id" value=" <?=$id?>">
            <div class="form-group">
              <label>Tên</label> <span style="color: red" id="e1"></span>
              <input type="text" id="name" placeholder="tên" name="name" class="form-control" >
            </div>
            <div class="form-group">
              <label>Email</label> <span style="color: red" id="e2"></span>
              <input type="text" id="email" placeholder="email" name="email" class="form-control" >
            </div>
            <div class="form-group">
              <label>Nội dung</label> <span style="color: red" id="e3"></span>
              <textarea class="form-control" id="content" rows="5" placeholder="nội dung" name="content"></textarea>
            </div>
            <div class="text-center mb-5">
              <button type="submit" class="btn btn-sm btn-primary">Gửi phản hồi</button>
            </div>




          </form>

            </div>
</div>
        </div>

</div>
  <!-- /.container -->


  <!-- Footer -->
  <!-- Footer -->
<!-- Footer -->
<!-- Footer -->
<script>
function validateForm() {
    var name = document.forms["myForm"]["name"].value;
    if (name === "") {
      document.getElementById("e1").innerHTML = "Bạn phải nhập tên";

        return false;
    }
    var x = document.forms["myForm"]["email"].value;
    if (x === "") {
      document.getElementById("e2").innerHTML = "Email không được bỏ trống";

        return false;
    }
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
      document.getElementById("e2").innerHTML = "Bạn phải nhập email đúng định dạng";

        return false;
    }
    var y =  document.forms["myForm"]["content"].value;
    if (y === "") {
      document.getElementById("e3").innerHTML = "Bạn phải nhập nội dung";
        return false;
    }
}
</script>
<script type="text/javascript">
	<?php 
	if(isset($_GET['success']) && $_GET['success'] == 'true'){
		?>

		alert("Gửi thông tin liên hệ thành công!");
	<?php
	}
	 ?>
</script>
 <br>
 <br>


<!---------------------------------           ----------------->
<!--- FOOTER-->
<br>
<?php include './_share/footer.php'; ?>
<!--- FOOTER-->
</body>

</html>