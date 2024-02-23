<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 
$currentProject = getCurrentProject($_GET["id"]);
$allProjectEmployee = getAllProjectEmployee($_GET["id"]);
$allProjectPeriod = getAllProjectPeriod($_GET["id"]);
$dataPoints = getAllDataProgressChart($_GET["id"]);
$allExpenseProject = getAllExpenseProject($_GET["id"]);
$total = 0;
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
<body class="g-sidenav-show  bg-gray-100">
  <?php
  require_once("side_bar.php");
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php
    require_once("nav.php");
    ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">ข้อมูลผู้ว่าจ้าง</h4>
            </div>

            <div class="card-body">

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


              <div class="clearfix"></div>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-profile">
            <div id="chartContainer" style="height: 500px; width: auto;"></div>
          </div>
        </div>

      </div>

      <div class="row" style="margin-top: 25px;">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">พื้นที่ก่อสร้าง</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ที่ดินโฉนดเลขที่</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["land_deed"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ระวาง</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["land_part"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">เลขที่ดิน</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["land_number"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">หน้าสำรวจ</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["land_check"];?></label>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">ขนาดพื้นที่ก่อสร้าง</h4>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">เนื้อที่</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["area_amount"];?> ไร่</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">งาน</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["area_work"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ตารางวา</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["area_squre"];?> </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ที่ตั้ง</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating">ตำบล/แขวง <?php echo $currentProject["land_tumbol"];?> อำเภอ/เขต <?php echo $currentProject["land_amphur"];?> จังหวัด <?php echo $currentProject["land_province"];?></label>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="row" style="margin-top: 25px;">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">สถานะงาน</h4>
            </div>
            <div class="card-body">
              <table class="table table-striped" id="dataTable">
                <thead>
                  <th style="text-align:center;"><label>งวดที่</label></th>
                  <th style="text-align:left;"><label>รายละเอียด</label></th>
                  <th style="text-align:center;"><label>สถานะ</label></th>
                  <th style="text-align:center;"><label>ค่าใช้จ่าย</label></th>
                </thead>
                <tbody>
                  <?php if(empty($allProjectPeriod)){ ?>
                  <?php }else{?>
                    <?php foreach($allProjectPeriod as $dataPe){ ?>
                      <?php $total += $dataPe["period_price"];?>
                      <tr>
                        <td style="width:10%;">
                          <?php echo $dataPe["period_number"];?>
                        </td>
                        <td style="width:70%;">
                          <?php echo $dataPe["period_detail"];?>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <?php echo $peiord_map[$dataPe["peiod_status"]];?>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <?php echo number_format($dataPe["period_price"]);?>
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
                  </tr>
                </tbody>
              </table>


            </div>
          </div>
        </div>

      </div>

      <div class="row" style="margin-top: 25px;">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">ข้อมูลรายจ่าย</h4>
            </div>
            <div class="card-body">
              <table class="table table-striped" id="dataTable">
                <thead>
                  <th style="text-align:center;"><label>วันที่</label></th>
                  <th style="text-align:center;"><label>ประเภท</label></th>
                  <th style="text-align:center;"><label>รายละเอียด</label></th>
                  <th style="text-align:center;"><label>ประเภทรับ-จ่าย</label></th>
                  <th style="text-align:center;"><label>จำนวนเงิน</label></th>
                </thead>
                <tbody>
                  <?php if(empty($allExpenseProject)){ ?>
                  <?php }else{?>
                    <?php 
                    $income = 0;
                    $expense = 0;
                    ?>
                    <?php foreach($allExpenseProject as $dataPe){ ?>
                      <?php 
                        $expense += $dataPe["ie_amount"];
                      ?>
                      <tr>
                        <td style="width:10%;text-align:center;">
                          <?php echo formatDateFull($dataPe["ie_date"]);?>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <?php echo $ie_category_map[$dataPe["ie_category"]];?>
                        </td>
                        <td style="width:60%;">
                          <?php echo $dataPe["ie_detail"];?>
                        </td>
                        <td style="width:20%;text-align:center;">
                          <?php echo $ie_type_map[$dataPe["ie_type"]];?>
                        </td>
                        <td style="width:20%;text-align:center;">
                          <?php echo number_format($dataPe["ie_amount"]);?>
                        </td>
                      </tr>

                    <?php } ?>
                  <?php } ?>
                  <?php $bal = $total - $expense;?>

                  <tr>
                    <td colspan="4" style="text-align:right;">รวมรายจ่าย</td>
                    <td style="text-align:center;"><?php echo number_format($expense);?></td>
                  </tr>
                </tbody>
              </table>


            </div>
          </div>
        </div>

      </div>
      <div class="row" style="margin-top: 25px;">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">สรุปผล</h4>
            </div>
            <div class="card-body">
              <table class="table table-striped" id="dataTable">
                <thead>
                  <th style="text-align:center;width:80%;"><label>รายละเอียด</label></th>
                  <th style="text-align:center;width:20%;"><label>จำนวนเงิน</label></th>
                </thead>
                <tbody>

                  <tr>
                    <td style="text-align:center;color:green;">รวมรายรับ</td>
                    <td style="text-align:center;color:green;"><?php echo number_format($total);?></td>
                  </tr>
                  <tr>
                    <td style="text-align:center;color:red;">รวมรายจ่าย</td>
                    <td style="text-align:center;color:red;"><?php echo number_format($expense);?></td>
                  </tr>
                  <tr>
                    <td style="text-align:center;color:blue;">คงเหลือ</td>
                    <td style="text-align:center;color:blue;"><?php echo number_format($bal);?></td>
                  </tr>
                </tbody>
              </table>


            </div>
          </div>
        </div>

      </div>
      <?php
      require_once("footer.php");
      ?>
    </div>
  </main>


</body>

</html>