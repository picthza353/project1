<!doctype html>
<html class="no-js" lang="en">

<?php
require_once("header.php");
?>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<?php 
$currentProject = getCurrentProject($_GET["id"]);
$allProjectEmployee = getAllProjectEmployee($_GET["id"]);
$allProjectPeriod = getAllProjectPeriod($_GET["id"]);
$dataPoints = getAllDataProgressChart($_GET["id"]);
$allExpenseProject = getAllExpenseProject($_GET["id"]);
$total = 0;
$peiord_map = array( 1=>'<span style="color:red;">ค้างชำระ</span>',2=>'<span style="color:green;">ชำระเรียบร้อย</span>');
?>
<script>
  window.onload = function() {

    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      title: {
        text: "ความคืบหน้า"
      },
      data: [{
        type: "pie",
        startAngle: 240,
        yValueFormatString: "##0.00\"%\"",
        indexLabel: "{label} {y}",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
      }]
    });
    chart.render();

  }
</script>
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
            <div class="col-md-8">
              <legend>ข้อมูลผู้ว่าจ้าง</legend>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">เลขที่</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["run_number"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ผู้ว่าจ้าง</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["firstname"];?> <?php echo $currentProject["lastname"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">บริษัท</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["company_name"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">อีเมล</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["email"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">หมายเลขโทรศัพท์</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["telephone"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">เลขที่ ทะเบียนนิติบุคคล</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["juristic_person"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ที่ตั้ง สำนักงาน</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["company_address"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">วันที่เริ่มงาน</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo formatDateFull($currentProject["start_date"]);?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">กำหนดแล้วเสร็จ</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo formatDateFull($currentProject["end_date"]);?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">จำนวนวัน</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["amount_date"];?> วัน</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">จำนวนเงินทั้งหมด</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo number_format($currentProject["total_price"]);?> บาท</label>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div id="chartContainer" style="height: 500px; width: auto;"></div>
              </div>
            </div>

            <div class="col-md-12">

                <table class="table table-striped" id="dataTable">
                  <thead>
                    <th style="text-align:center;"><label>งวดที่</label></th>
                    <th style="text-align:left;"><label>รายละเอียด</label></th>
                    <th style="text-align:center;"><label>สถานะ</label></th>
                    <th style="text-align:center;"><label>ค่าใช้จ่าย</label></th>
                    <th style="text-align:center;"><label>รูปภาพ</label></th>
                  </thead>
                  <tbody>
                    <?php if(empty($allProjectPeriod)){ ?>
                    <?php }else{?>
                      <?php foreach($allProjectPeriod as $dataPe){ ?>
                        <?php $total += $dataPe["period_price"];?>
                        <?php $checkPeriodImage = getCheckPeriodImage($dataPe['id']);?>
                        <tr>
                          <td style="width:10%;">
                            <?php echo $dataPe["period_number"];?>
                          </td>
                          <td style="width:60%;">
                            <?php echo $dataPe["period_detail"];?>
                          </td>
                          <td style="width:10%;text-align:center;">
                            <?php echo $peiord_map[$dataPe["peiod_status"]];?>
                          </td>
                          <td style="width:10%;text-align:center;">
                            <?php echo number_format($dataPe["period_price"]);?>
                          </td>
                          <td style="width:10%;text-align:center;">
                            <?php if($checkPeriodImage["numImg"] != 0){ ?>
                              <a href="progress_image.php?projects_id=<?php echo $dataPe["projects_id"];?>&period_id=<?php echo $dataPe["id"];?>" class="btn btn-info" target="_blank">ดูข้อมูล</a>
                            <?php } ?>
                          </td>

                        </tr>

                      <?php } ?>
                    <?php } ?>
                    <tr>
                      <td style="text-align:right;" colspan="3">
                        รวม
                      </td>
                      <td style="text-align:center;">
                        <?php echo number_format($total);?>
                      </td>
                      <td style="text-align:center;">
                      </td>
                    </tr>
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