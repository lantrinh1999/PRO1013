
<?php 

require_once './commons/utils.php';

$id = $_GET['id'];



$pro = "select * from " . TABLE_PRODUCT
    . " where id = $id";

$stmts = $conn->prepare($pro);
$stmts->execute();
$p = $stmts->fetch();
$updateView = "update products set views = views + 0 where id = '$id'";
$stmt = $conn->prepare($updateView);
$stmt->execute();

$commentSql = "select * from " . TABLE_COMMENT
    . " where product_id = $id order by id desc";

$stmt = $conn->prepare($commentSql);
$stmt->execute();
$comments = $stmt->fetchAll();

$sqlmoreproductlike = "select * from " . TABLE_PRODUCT . " where cate_id =" . $p['cate_id'] . "and status = 1 and id != " . $p['id'] . "  order by rand() limit 4";
$stmt = $conn->prepare($sqlmoreproductlike);
$stmt->execute();
$datamoreproductlike = $stmt->fetchAll();
$updateView = "update products set views = views + 1 where id = '$id' and status = 1";
$stmt = $conn->prepare($updateView);
$stmt->execute();

$mostViewsQuery = " select *
            from " . TABLE_PRODUCT . " where status = 1
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
<script type="text/javascript" src="./js/ctsp.js"></script>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style type="text/css">


.comment-wrapper .panel-body {
    max-height:650px;
    overflow:auto;
}

.comment-wrapper .media-list .media img {
    width:64px;
    height:64px;
    border:2px solid #e5e7e8;
}

.comment-wrapper .media-list .media {
    border-bottom:1px dashed #efefef;
    margin-bottom:25px;
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

<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <div>
        <img width="100%" src="<?=$siteUrl . $p['image']?>">
      </div>
    </div>
    <!---->
    <div class="col-sm-6">
      <h5><?=$p['product_name']?></h5>
      <h4><?=$p['list_price']?> đ</h4>
      <p><?=$p['detail']?></p>
      <form  id='myform' method='POST' action='#'>
          <hr>
          <a href="save-cart.php?id=<?= $p['id'] ?>"><button type="button" class="btn btn-success mt-5">Thêm vào giỏ</button></a>
      </form>
    </div>
  </div>
</div>
<br>
<!------>
<div class="container">
  <div class="row bootstrap snippets">
    <div class="col-md-9 col-md-offset-2 col-sm-12">
        <div class="comment-wrapper">
            <div class="panel panel-info">
                <div class="panel-heading m-3">
                    <h4>Bình luận</h4>
                </div>
                <div class="panel-body">

                  <form onsubmit="return validateForm()" class="myForm" name="myForm" action="submit_comment.php" method="post">
                    <input type="hidden" name="time" value="<?= date("Y/m/d h:i:s A") ?>">
                    <input type="hidden" name="id" value=" <?=$id?>">
                    <span id="err"></span>
                    <div class="form-group">
                      <label>Email</label> <span style="color: red" id="e1"></span>
                      <input type="text" id="email" placeholder="email" name="email" class="form-control" >
                    </div>
                    <div class="form-group">
                      <label>Nội dung</label> <span style="color: red" id="e2"></span>
                      <textarea class="form-control" id="content" rows="5" placeholder="nội dung" name="content"></textarea>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-sm btn-primary">Gửi phản hồi</button>
                    </div>




          </form>


                    <div class="clearfix"></div>
                    <hr>
                    <ul class="media-list">
                      <?php foreach ($comments as $cm) : ?>
                        <li class="media">
                            <a href="#" class="pull-left">
                                <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle mr-2">
                            </a>
                            <div class="media-body">
                                
                                <strong class="text-success">
                                  <?=$cm['email']?> 
                                </strong>
                                <span class="text-muted pull-right">
                                    <small class="text-muted"> <?=$cm['time_created']?></small>
                                </span>
                                <p>
                                    <?=$cm['content']?>
                                </p>
                            </div>
                        </li>

                          <?php endforeach?>
                    </ul>
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
<!------>
<br>
<div class="container">
  <div class="text-left mb-4">
    <h4>SẢN PHẨM BÁN CHẠY</h4>
  </div>
  <div class="row">
  <?php foreach ($mostViewsProducts as $np): ?>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="img-fluid">
        <a href="<?=$siteUrl?>chitiet.php?id=<?=$np['id']?>">
          <img width="100%" src="<?=$siteUrl . $np['image']?>">
        </a>
      </div>
      <div class="card-body text-center">
        <h5 class="card-title">
          <a href="<?=$siteUrl?>chitiet.php?id=<?=$np['id']?>">
            <?=$np['product_name']?>
          </a>
        </h5>
        <h6>$24.99</h6>
      </div>
    </div>
     <?php endforeach?>
    <!---->
    <!---->
  </div>


</div>
<!-------------------------------------------------->
<!--- FOOTER-->
<br>
<?php include './_share/footer.php'; ?>
<!--- FOOTER-->


  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  <script type="text/javascript">
    function up(max) {
      document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) + 1;
      if (document.getElementById("myNumber").value >= parseInt(max)) {
        document.getElementById("myNumber").value = max;
      }
    }
    function down(min) {
      document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) - 1;
      if (document.getElementById("myNumber").value <= parseInt(min)) {
        document.getElementById("myNumber").value = min;
      }
    }

  </script>



<script>
function validateForm() {

    var x = document.forms["myForm"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
      document.getElementById("e1").innerHTML = "Bạn phải nhập email";
        
        /*
        var a = document.getElementById('err').innerHTML = "lỗi" ;
        */
        return false;
    }
    if (x == "") {
      document.getElementById("e1").innerHTML = "Bạn phải nhập email";

     /* 
     var a = document.getElementById('err').innerHTML = "lỗi 1" ;
     */
        return false;
    }
    var y =  document.forms["myForm"]["content"].value;
    if (y == "") {
      document.getElementById("e1").innerHTML = "Bạn phải nhập nội dung";

      /*
      var a = document.getElementById('err').innerHTML = "lỗi 2" ;
      */
        return false;
    }
}
 <?php 
  if(isset($_GET['success']) && $_GET['success'] == 'true'){
    ?>
    swal('Thêm Sản phẩm thành công!');
  <?php
  }
   ?>
  $('.btn-remove').on('click', function(){

    var removeUrl = $(this).attr('linkurl');
    // var conf = confirm('Bạn có chắc chắn muốn xoá danh mục này không?');
    // if(conf){
    //  window.location.href = removeUrl;
    // }
    swal({
      title: "Cảnh báo",
      text: "Bạn có chắc chắn muốn xoá sản phẩm này không?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = removeUrl;
      } 
    });
  });

</script>

<script type="text/javascript">
    <?php 
  if(isset($_GET['success']) && $_GET['success'] == 'true'){
    ?>

    alert("Thêm sản phẩm vào giỏ hàng thành công!!!");
  <?php
  }
   ?>
</script>


</body>

</html>