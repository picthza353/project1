<!doctype html>
<html class="no-js" lang="en">

<?php
require_once("header.php");
?>
<?php 
$allProgressProject = getAllProgressProject($_SESSION["id"]); 
?>
<style>
  th,td {
    border-bottom: 1px solid #000 !important;
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
        <div class="ht__bradcaump__area" data--black__overlay="6" style="background: rgba(0, 0, 0, 0) url(images/slider/bg/หน้าปก2.jpg) no-repeat scroll center center / cover ;">
          <div class="ht__bradcaump__wrap">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title">ตรวจสอบความคืบหน้า</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Bradcaump area -->
        <section class="htc__contact__area bg__white ptb--150">
          <div class="container">
            <div class="col-md-12">
              <table class="table align-items-center ">
                <thead>
                  <tr>
                    <th>ประเภทการก่อสร้าง</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>บริษัท</th>
                    <th>จำนวนวัน</th>
                    <th>ค่ารับเหมา</th>
                    <th>ความคืบหน้า</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($allProgressProject)){ ?>
                  <?php }else{?>
                    <?php foreach($allProgressProject as $data){ ?>
                      <?php $calculatePercentProject = getCalculatePercentProject($data["id"]); ?>
                      <tr>
                        <td>
                          <?php echo $data["building_type"];?>
                        </td>
                        <td>
                          <?php echo $data["firstname"];?> <?php echo $data["lastname"];?></h6>

                        </td>
                        <td>
                          <?php echo $data["company_name"];?>
                        </td>
                        <td>
                          <?php echo $data["amount_date"];?> วัน
                        </td>
                        <td>
                          <?php echo number_format($data["total_price"]);?>
                        </td>
                        <td>
                          <?php echo number_format($calculatePercentProject);?> %
                        </td>
                        <td style="text-align: right;border-bottom: 1px solid #000;">
                          <a href="detail_project.php?id=<?php echo $data["id"];?>" class="btn btn-info">ตรวจสอบ</a>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } ?>

                </tbody>
              </table>


            </div>

          </div>
        </section>

        

        


        <?php
        require_once("footer.php");
        ?>
      </div>


    </body>



    </html>