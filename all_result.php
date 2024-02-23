<!doctype html>
<html class="no-js" lang="en">

<?php
require_once("header.php");
?>
<?php 
$allWork = getAllWork(); 
?>
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
        <div class="ht__bradcaump__area" data--black__overlay="6" style="background: rgba(0, 0, 0, 0) url(images/slider/bg/หน้าปก1.2.jpg) no-repeat scroll center center / cover ;">
          <div class="ht__bradcaump__wrap">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title">ผลงาน</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Service Area -->
        <section class="htc__service__area service__page bg__gray ptb--100">
          <div class="container">
            <div class="row">
              <div class="service__section__wrap clearfix">
                <?php if(empty($allWork)){ ?>
                 
                <?php }else{?>
                  <?php foreach($allWork as $data){ ?>
                    <!-- Start Single Service -->
                    <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12">
                      <div class="service foo">
                        <div class="service__thumb">
                          <a href="single_result.php?id=<?php echo $data["id"];?>">
                            <img src="backend/images/work/<?php echo $data["work_img"];?>" alt="service images" style="width:285px;height:212px;">
                          </a>
                        </div>
                        <div class="service__details" >
                          <h2><a href="single_result.php?id=<?php echo $data["id"];?>"><?php echo $data["work_name"];?></a></h2>
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
        <!-- End Service Area -->


        <?php
        require_once("footer.php");
        ?>
      </div>


    </body>



    </html>