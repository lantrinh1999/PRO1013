
<?php 

require_once './commons/utils.php';

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


<div class="">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Thông tin</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Mật khẩu</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
                          <form action="<?= $adminUrl?>/tai-khoan/save-edit.php" method="post" >
                            <div class="col-md-6">
                              
                              <div class="form-group">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <label>Email</label>
                                <!-- /.error -->
                                <?php 
                                if(isset($_GET['msg1']) && $_GET['msg1'] != ""){
                                 ?>
                                 <span class="text-danger"> | <?= $_GET['msg1'] ?></span>
                                <?php } 
                                ?>
                                <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Tên đầy đủ</label>
                                <input type="text" name="fullname" class="form-control" value="<?= $user['fullname'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Quyền</label>
                                <select name="role" class="form-control">
                                  <?php foreach (USER_ROLES as $key => $value): ?>
                                    <option value="<?= $value ?>"><?= $key ?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                              <div class="col-md-12 text-right">
                                <a href="<?= $adminUrl?>tai-khoan" class="btn btn-xs btn-danger">Huỷ</a>
                                <button type="submit" class="btn btn-xs btn-primary">Lưu</button>
                              </div>
                            </div>
                          </form>
                        </div>

                        <div class="tab-pane fade" id="tab2default">
                          <form action="<?= $adminUrl?>/tai-khoan/save-edit.php" method="post" >
                            <div class="col-md-6">

                              <div style="display: none;">
                              <div class="form-group">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <label>Email</label>
                                <!-- /.error -->
                                <?php 
                                if(isset($_GET['msg1']) && $_GET['msg1'] != ""){
                                 ?>
                                 <span class="text-danger"> | <?= $_GET['msg1'] ?></span>
                                <?php } 
                                ?>
                                <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Tên đầy đủ</label>
                                <input type="text" name="fullname" class="form-control" value="<?= $user['fullname'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Quyền</label>
                                <select name="role" class="form-control">
                                  <?php foreach (USER_ROLES as $key => $value): ?>
                                    <option value="<?= $value ?>"><?= $key ?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                              </div>

                              <div class="form-group">
                                <label>Mật khẩu mới</label>
                                <input type="password" name="password" class="form-control">
                              </div>
                              <!-- /.error -->
                                <?php 
                                if(isset($_GET['msg']) && $_GET['msg'] != ""){
                                 ?>
                                 <span class="text-danger"><?= $_GET['msg'] ?></span>
                                <?php } 
                                ?>
                              <div class="form-group">
                                <label>Xác nhận mật khẩu mới</label>
                                <input type="password" name="cfPassword" class="form-control">
                              </div>

                              <div class="col-md-12 text-right">
                                <a href="<?= $adminUrl?>tai-khoan" class="btn btn-xs btn-danger">Huỷ</a>
                                <button type="submit" class="btn btn-xs btn-primary">Lưu</button>
                              </div>
                            </div>
                          </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>



</body>

</html>