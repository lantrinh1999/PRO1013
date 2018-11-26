<?php 
$cart = isset($_SESSION['CART']) == true ? $_SESSION['CART'] : [];
$totalPrice = 0;
require './commons/utils.php';
date_default_timezone_set("Asia/Ho_Chi_Minh");
?>
<!DOCTYPE html>
<html>
<head>
<?php include './_share/client_assets.php' ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body class="bg-light">

  <!-- header-->
  <?php include './_share/header.php' ?>
  <!-- header-->



<form onsubmit="return validateForm()" class="myForm" name="myForm" method="post" action="save-cart2.php" id="form" >
	<div class="container pt-5">
		<div class="row">
			<div class="col-lg-4">
				<h5>Thông tin</h5>

					<input type="hidden" name="date" value="<?= date("Y/m/d h:i:s A") ?>">


            <div class="form-group">
              <label>Tên</label> <span style="color: red" id="e1"></span>
              <input type="text" id="name" placeholder="tên" name="name" class="form-control" >
            </div>
            <div class="form-group">
              <label>Email</label> <span style="color: red" id="e2"></span>
              <input type="text" id="email" placeholder="email" name="email" class="form-control" >
            </div>
            <div class="form-group">
              <label>SĐT</label> <span style="color: red" id="e4"></span>
              <input type="text" id="phone" placeholder="phone" name="phone" class="form-control" >
            </div>
            <div class="form-group">
              <label>Nội dung</label> <span style="color: red" id="e3"></span>
              <textarea class="form-control" id="content" rows="5" placeholder="nội dung" name="note"></textarea>
            </div>



				</div>
				<div class="col-lg-8"> 
					<table class="table table-condensed text-center">
						<thead>
							<tr>

								
								<th>Tên Sản Phẩm</th>
								<th>Ảnh</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Tổng</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php foreach ($cart as $item): ?>
									
									<input type="hidden" name="id_product" value="<?= $item['id']?>">
									<td><input type="hidden" name="product_name" value="<?= $item['product_name'] ?>"><?= $item['product_name'] ?></td>
									<td><img src="<?= $item['image'] ?>" width="100"></td>
									
									<td><input type="hidden" name="list_price" value="<?= $item['list_price'] ?>"><?= $item['list_price'] ?></td>

									<td><input type="hidden" name="quantity" value="<?= $item['quantity'] ?>">
										<!------>
										<span>
										<a href="minus-cart.php?id=<?=$item['id']?>"
										class="btn-add"
										>
										<i class="fas fa-lg fa-minus-square"></i>
										</a>
										</span>
										<!------>
										<input class="text-center" style="width: 70px" type="text" name="quantity" value="<?= $item['quantity'] ?>">
										<!------>
										<span>
										<a href="plus-cart.php?id=<?=$item['id']?>"
										class="btn-add"
										>
										<i class="fas fa-lg fa-plus-square"></i>
										</a>
										</span>
										<!------>
									</td>
									<td style="font-weight: bold;"><?= $total = $item['list_price']*$item['quantity'] ?>
										<input type="hidden" name="total" value="<?= $total ?>">
									</td>

									<td>
										<a href="javascript:;"
										linkurl="del-cart.php?id=<?=$item['id']?>"
										class="btn-remove"
										>
										<i class="far fa-trash-alt"></i>
									</a>
									</td>
									
									
									
							</tr>
							<?php $totalPrice += $item['quantity']*$item['list_price'];
							?> 
						<?php endforeach ?>
					</tbody>
				</table>
				<div  class="row col-lg-12 d-flex justify-content-end">
					<b style="background: white;border: 2px solid black; padding: 3px">Tổng : <?= $totalPrice ?> VNĐ</b>
				</div>
				<input type="hidden" name="totalPrice" value="<?= $totalPrice ?>">
				<div class="float-right pt-5 mb-5">
				
					<a href="save-cart2.php"><button type="submit" class="btn btn-success">THANH TOÁN</button></a>

				</div>


		</div> 
	</div>
</div>
</form>

<?php include './_share/footer.php'; ?>


<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


<script>
function validateForm() {
    

    var name = document.forms["myForm"]["name"].value;
    if (name === "") {
      document.getElementById("e1").innerHTML = "Bạn phải nhập tên";

        return false;
    } else {
    	document.getElementById("e1").innerHTML = " ";
    }
    var x = document.forms["myForm"]["email"].value;
    if (x === "") {
      document.getElementById("e2").innerHTML = "Email không được bỏ trống";

        return false;
    } else {
    	document.getElementById("e2").innerHTML = " ";
    }
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
      document.getElementById("e2").innerHTML = "Bạn phải nhập email đúng định dạng";

        return false;
    } else {
    	document.getElementById("e2").innerHTML = " ";
    }
    var phone = document.forms["myForm"]["phone"].value;
    var phoneno = /^[0-9]+$/;
    if (!phone.match(phoneno)) {
      document.getElementById("e4").innerHTML = "Mời  bạn nhập SĐT";

        return false;
    }
    else {
    	document.getElementById("e4").innerHTML = " ";
    }

}
</script>


<script type="text/javascript">
	$('.btn-remove').on('click', function(){
		var removeUrl = $(this).attr('linkurl');
		var conf = confirm("Bạn có chắc chắn muốn xoá danh mục này?");
		if (conf) {
			window.location.href = removeUrl;
		}});


	<?php 
	if(isset($_GET['success']) && $_GET['success'] == 'true'){
		?>

		alert("Lưu Thông tin thanh toán thành công");
	<?php
	}
	 ?>

	 <?php 
	if(isset($_GET['err']) && $_GET['err'] == 'null'){
		?>

		alert("LỖI không có sản phẩm!!!");
	<?php
	}
	 ?>




	</script>
</body>
</html>


