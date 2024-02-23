<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php
$workEmployeeProject = getAllWorkEmployeeProject($_SESSION["id"]);
$allProject = getAllProjectNotSuccess();

?>
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
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>สถานที่ทำงาน</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ประเภทงาน</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">สถานที่</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">วันที่เริ่ม</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">วันที่แล้วเสร็จ</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">จำนวนวัน</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php if(empty($allProject)){ ?>
                      <?php echo "<h3>ไม่พบข้อมูล</h3>";?>
                    <?php }else{?>
                      <?php foreach($allProject as $data){ ?>
                        <tr>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo $data["building_type"];?></span>
                          </td>
                          <td>
                            <div class="d-flex px-2">
                              <div class="my-auto">
                                <h6 class="mb-0 text-sm"><?php echo $data["land_tumbol"];?> <?php echo $data["land_amphur"];?> <?php echo $data["land_province"];?></h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo formatDateFull($data["start_date"]);?></span>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo formatDateFull($data["end_date"]);?></span>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo $data["amount_date"];?> วัน</span>
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
      </div>
      <?php
      require_once("footer.php");
      ?>
    </div>
  </main>


</body>

</html>