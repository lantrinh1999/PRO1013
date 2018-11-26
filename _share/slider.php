<?php 
require_once './commons/utils.php';

$sqlSlides = "select * from " . TABLE_SLIDESHOW . "
				where status = 1 
				 order by order_number";

$stmt = $conn->prepare($sqlSlides);
$stmt->execute();

$dataSlides = $stmt->fetchAll();

?>


<div style="" class="">
      <div class="">
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
				<?php 
    $count = 0;
    ?>
				<?php foreach ($dataSlides as $slide) : ?>
					<?php
    $active = $count === 0 ? "active" : "";
    ?>
					<div class="carousel-item <?= $active ?>">
            <div style="max-height: 37.3%,  overflow: hidden">
              <img width="100%" class="d-block img-fluid" src="<?= $siteUrl . $slide['image'] ?>">
            </div>
						
					</div>
					<?php 
    $count++;
    ?>
				<?php endforeach ?>
				            
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>


    </div>