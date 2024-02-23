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
$allIncomeExpenseProject = getAllIncomeExpenseProject($_GET["id"]);
$currentProvince = getCurrentProvince($currentProject['land_province']);
$currentAmphure = getCurrentAmphure($currentProject['land_amphur']);
$currentDistrict = getCurrentDistrict($currentProject['land_tumbol']);

if(isset($_POST["submit"])){
  saveIncomeExpense($_POST["peoject_id"],$_POST["ie_category"],$_POST["ie_detail"],$_POST["ie_date"],$_POST["ie_time"],$_POST["ie_type"],$_POST["ie_amount"]);
}

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
              <h4 class="card-title">สรุปผลข้อมูลรายรับรายจ่าย</h4>
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
                    <label class="bmd-label-floating">ประเภทการก่อสร้าง</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentProject["building_type"];?></label>
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
                    <label class="bmd-label-floating">ที่ตั้งสถานที่ทำงาน</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating">ตำบล<?php echo $currentDistrict["d_name_th"];?> อำเภอ<?php echo $currentAmphure["a_name_th"];?> จังหวัด<?php echo $currentProvince["p_name_th"];?></label>
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
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">ข้อมูลรายรับ-รายจ่าย</h4>
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
                  <?php if(empty($allIncomeExpenseProject)){ ?>
                  <?php }else{?>
                    <?php 
                    $income = 0;
                    $expense = 0;
                    ?>
                    <?php foreach($allIncomeExpenseProject as $dataPe){ ?>
                      <?php 
                      if($dataPe["ie_category"] == 1){
                        $income += $dataPe["ie_amount"];
                      }else{
                        $expense += $dataPe["ie_amount"];
                      }
                      
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
                  <?php $bal = $income - $expense;?>
                  <tr>
                    <td colspan="4" style="text-align:right;">รวมรายรับ</td>
                    <td style="text-align:center;"><?php echo $income;?></td>
                  </tr>
                  <tr>
                    <td colspan="4" style="text-align:right;">รวมรายจ่าย</td>
                    <td style="text-align:center;"><?php echo $expense;?></td>
                  </tr>
                  <tr>
                    <td colspan="4" style="text-align:right;">คงเหลือ</td>
                    <td style="text-align:center;"><?php echo $bal;?></td>
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

  <script>

    $('#ie_date').datetimepicker({
      lang:'th',
      timepicker:false,
      format:'d/m/Y'
    });
    $('#ie_time').datetimepicker({
      lang:'th',
      datepicker:false,
      format:'H:i',
      enabledHours: '10'
    });
  </script>


</body>

</html>