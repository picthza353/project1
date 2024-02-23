<!doctype html>
<html class="no-js" lang="en">

<?php
require_once("header.php");
?>
<?php 
$currentWork = getCurrentWork($_GET["id"]);
$allWorkGallery = getAllWorkGallery($_GET["id"]);

?>
<style>
  h2 {
    font-size: 25px;
  }
</style>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->  

      <!-- Body main wrapper start -->
      <div class="wrapper">
        <?php
        require_once("nav.php");
        ?>
        
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" data--black__overlay="6" style="background: rgba(0, 0, 0, 0) url(images/bg/5.jpg) no-repeat scroll center center / cover ;">
          <div class="ht__bradcaump__wrap">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title"><?php echo $currentWork["work_name"];?></h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Start Blog Area -->
        <section class="htc__blog__details__page pt--150 bg__white">
          <div class="container">
            <div class="row">

              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 smt-40 xmt-40">
                <div class="htc__single__service">
                  <div class="htc__single__service__tab">
                    <div class="ht-portfolio-pic-show">
                      <div class="ht-portfolio-full-image tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                          <img src="backend/images/work/<?php echo $currentWork["work_img"];?>" alt="full-image">
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="htc__service__dtl">
                    <!-- Start Single Service -->
                    <div class="htc__ser__dtl">
                      <h2 class="title__line--4">รายละเอียด</h2>
                      <p style="text-indent: 30px;"><?php echo $currentWork["work_detail"];?></p>
                    </div>
                    <br>
                    <br>
                    <!-- End Single Service -->
                    <!-- Start Single Service -->
                    <div class="htc__ser__dtl">
                      <h2 class="title__line--4">สถานที่</h2>
                      <p style="text-indent: 30px;"><?php echo $currentWork["locations"];?></p>
                    </div>
                    <!-- End Single Service -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="htc__service__area service__page bg__gray pb--100">
          <div class="container">
            <div class="row">
              <div class="service__section__wrap clearfix">
              <?php if(empty($allWorkGallery)){ ?>
                        <?php }else{?>
                          <?php foreach($allWorkGallery as $dataGal){ ?>
                    <!-- Start Single Service -->
                    <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12">
                      <div class="service foo">
                        <div class="service__thumb">
                            <img src="backend/images/gallery_work/<?php echo $dataGal["images"];?>" alt="service images" style="widthh:285px;height:213px;">
                        </div>
                      </div>
                    </div>
                    <!-- End Single Service -->
                  <?php } ?>
                <?php } ?>

              </div>
            </div>
          </div>
        </section>
        <!-- End Blog Area -->

        <?php
        require_once("footer.php");
        ?>
      </div>


    </body>



    </html>