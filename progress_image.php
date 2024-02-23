<!doctype html>
<html class="no-js" lang="en">

<?php
require_once("header.php");
?>

<?php 
$allImageInProgress = getAllImageInProgress($_GET["projects_id"],$_GET["period_id"]);
$allImageInProgressDate = getAllImageInProgressDate($_GET["projects_id"],$_GET["period_id"]);
$currentImageInProgress = getCurrentImageInProgress($_GET["id"]);
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
      
        <section class="htc__service__area service__page bg__gray ptb--100">
          <div class="container">
          <?php if(empty($allImageInProgressDate)){ ?>
            <?php }else{?>
              <?php foreach($allImageInProgressDate as $dataGalDate){ ?>
                <?php 
                $allImageInProgress = getAllImageInProgressCurrDate($_GET["projects_id"],$_GET["period_id"],$dataGalDate["date_update"]);
                ?>
                <div class="row">    
                  <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                  <legend><?php echo formatDateFull($dataGalDate["date_update"]);?></legend>
                  </div>
                </div>
                <div class="row">
              <div class="service__section__wrap clearfix">
              <?php if(empty($allImageInProgress)){ ?>
              <?php }else{?>
                
                <?php foreach($allImageInProgress as $dataGal){ ?>
                  <!-- Start Single Service -->
                  
                  <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12">
                    <div class="service foo">
                      <div class="service__thumb">
                        <a href="backend/images/period_gallery/<?php echo $dataGal["images"];?>" >
                          <img src="backend/images/period_gallery/<?php echo $dataGal["images"];?>" alt="service images" style="width:285px;height:213px;cursor:pointer">
                        </a>
                      </div>
                    </div>
                  </div>
                  
                    
                      
                  <!-- <div id="modal" class="modal-slip">
                        <div class="modal-bg">
                          <div div class="form-button-slip-sent">
                            <div class="btn-cancel-slip"><span onclick="close_modal()">X</span></div>
                          </div>
                        </div>
                        <div class="modal-card-slip">
                          <div style="width:100%;">
                            <a href="images/tax/<?php echo $currentTax["tax_img"];?>" >
                              <img class="slip-img" src="backend/images/period_gallery/<?php echo $dataGal["images"];?>"/>
                            </a>
                          </div>
                        </div>
                      </div> -->
                  <!-- End Single Service -->
                <?php } ?>
              <?php } ?>
              </div>
            </div>


            <?php } ?>
          <?php } ?>
            
            
          </div>
        </section>
        <!-- End Blog Area -->

        <?php
        require_once("footer.php");
        ?>
      </div>


    </body>
    <script>
      function open_modal() {
          $("#modal").css("display", "flex")
          setTimeout(() => {
              $("#modal").css({
                  "opacity" : "1",
              })
          }, 100)
      }

      function close_modal() {
          $("#modal").css({
              "opacity" : "0",
          })
          setTimeout(() => {
              $("#modal").css("display", "none")
          }, 500)
      }
    </script>
    </html>