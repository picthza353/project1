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
$allProject = getAllProjectNotSuccess();

if(isset($_POST["submit"])){
  saveIncomeExpense($_POST["projects_id"],$_POST["ie_category"],$_POST["ie_detail"],$_POST["ie_date"],$_POST["ie_time"],$_POST["ie_type"],$_POST["ie_amount"]);
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
      <form name="prduct_detail_form" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="projects_id" value="<?php echo $currentProject["pid"];?>">
        <input type="hidden" class="form-control" name="ie_category" value="1">
        <div class="row">
          
          <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">บันทึกรายรับ</h4>
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
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">รายละเอียดรายรับ<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="ie_detail" id="ie_detail" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">วันที่<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="ie_date" id="ie_date" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">เวลา<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="ie_time" id="ie_time" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">ประเภท<span style="color: red;"> *</span></label>
                      <select name="ie_type" class="form-control border-input" required>
                        <option value="" >-- โปรดระบุ --</option>
                        <option value="1">เงินสด</option>
                        <option value="2">โอนชำระ</option>  
                        <option value="3">เชคเงินสด</option>  
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">จำนวนเงิน<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="ie_amount" id="amount" required>
                    </div>
                  </div>
                </div>


                <div align="center">
                  <input type="submit" name="submit" class="btn btn-success btn-round" value="บันทึกรายรับ">
                  <input type="button" name="button" class="btn btn-danger btn-round" onClick="javascript:history.go(-1)" value="ย้อนกลับ">

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
      </form>


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