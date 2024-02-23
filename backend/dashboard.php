<!DOCTYPE html>
<html lang="en">

<?php
require_once("header.php");
?>

<?php 
$allProject = getAllProjectNotSuccess();
$dataPointsProject = getAllDataDashboardChart();
$dataPointsICProject = getAllDataDashboardIncomeExpenseChart();
?>

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: ""
  },
  axisY: {
    title: ""
  },
  data: [{        
    type: "column",  
    dataPoints: <?php echo json_encode($dataPointsProject, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();


var chart2 = new CanvasJS.Chart("chartContainer2", {
  animationEnabled: true,
  title: {
    text: ""
  },
  data: [{
    type: "pie",
    startAngle: 240,
    yValueFormatString: "##0\" บาท\"",
    indexLabel: "{label} {y}",
    dataPoints: <?php echo json_encode($dataPointsICProject, JSON_NUMERIC_CHECK); ?>
  }]
});
chart2.render();
}
</script>
<body class="g-sidenav-show bg-gray-100">
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
      <div class="row mt-4">
        <div class="col-lg-7">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>การรับเหมาทั้งหมด</h6>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <div id="chartContainer" style="height: 300px; width: auto;"></div>
              </div>
            </div> 
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>รายรับ-รายจ่าย</h6>
            </div>
             <div class="card-body p-3">
              <div class="chart">
                <div id="chartContainer2" style="height: 300px; width: auto;"></div>
              </div>
            </div> 
          </div>
        </div>
      </div>
      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-12 col-7">
                  <h6>งานรับเหมาทั้งหมด</h6>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">เลขที่รับเหมา</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ประเภทงาน</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">สถานที่</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ค่ารับเหมา</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">จำนวนวัน</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(empty($allProject)){ ?>
                    <?php }else{?>
                      <?php foreach($allProject as $data){ ?>
                        <?php $calculatePercentProject = getCalculatePercentProject($data["id"]); ?>                        
                        <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?php echo $data["run_number"];?></h6>
                              </div>
                            </div>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> <?php echo $data["building_type"];?> </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> <?php echo $data["land_tumbol"];?> <?php echo $data["land_amphur"];?> <?php echo $data["land_province"];?></span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> <?php echo number_format($data["total_price"]);?> </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> <?php echo $data["amount_date"];?> </span>
                          </td>
                        </tr>
                      <?php } ?>
                    <?php } ?>                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>ความคืบหน้า</h6>
            </div>
            <div class="card-body p-3">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">เลขที่รับเหมา</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ความคืบหน้า</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(empty($allProject)){ ?>
                    <?php }else{?>
                      <?php foreach($allProject as $data){ ?>
                        <?php $calculatePercentProject = getCalculatePercentProject($data["id"]); ?>
                        <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?php echo $data["run_number"];?></h6>
                              </div>
                            </div>
                          </td>
                          <td class="align-middle">
                            <div class="progress-wrapper w-10 mx-auto">
                              <div class="progress-info">
                                <div class="progress-percentage">
                                  <span class="text-xs font-weight-bold"><?php echo number_format($calculatePercentProject);?>%</span>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    <?php } ?>
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