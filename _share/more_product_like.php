<?php
//Tao ket noi csdl
require_once './commons/utils.php';
?>
<div id="more-product-like" class="<?= $more_product_box ?>">
<div class="container pt-5 pb-5">
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <h4 class="text-left">Sản phẩm liên quan</h4>
        </div>
        
    </div>

        <div class="row">
                 <?php foreach ($datamoreproductlike as $mpl) :
                ?>
                    <div class="col-sm-12 col-md-6 col-lg-3 mt-3">
                        <div class="card-product">
                            <div class="box-card">
                            <a href="<?=$siteUrl?>chitiet.php?id=<?=$mpl['id']?>">
                                <img src="<?=$siteUrl . $mpl['image']?>" class="img-fluid">
                            </a>
                            </div>
                            
                            <div class="card-details-product">
                            <?php 
                            $mainname = $mpl['product_name'];
                            if (strlen($mainname) > 20) {
                                $cutname = substr("$mainname", 0, 20);
                                $donename = $cutname . "...";
                            } else {
                                $donename = $mpl['product_name'];
                            }
                            ?>
                                <span class="text-center">
                                    <a href="<?=$siteUrl?>chitiet.php?id=<?=$mpl['id']?>"><h6><?= $donename ?></h6></a>
                                                               
                                    <p>Giá bán: <b><?= $mpl['list_price'] ?> đ</b> </p>
                                </span> 
                                <div class="container btn-card-details">
                                    
                                    <div class="footer-product text-center view">
                                        <a href="<?=$siteUrl?>chitiet.php?id=<?=$mpl['id']?>" class="btn btn-dark">Xem chi tiết</a>
                                        <span></span>
                                        <!--
                                        <a href="#" class="btn btn-dark">Mua hàng</a>
                                    -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
        </div>
</div>
</div>