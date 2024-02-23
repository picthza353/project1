<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 
$currentProject = getCurrentProject($_GET["id"]);
$allProjectPeriod = getAllProjectPeriod($_GET["id"]);
$dataPoints = getAllDataProgressChart($_GET["id"]);
$currentDistrict = getCurrentDistrict($currentProject["land_tumbol"]);
$currentAmphure = getCurrentAmphure($currentProject["land_amphur"]);
$currentProvince = getCurrentProvince($currentProject["land_province"]);

if(isset($_GET["complete"])) {
  updateSuccessJob($_GET["complete"],$_GET["projects_id"]);
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
        <input type="hidden" class="form-control" name="users_id" value="<?php echo $currentProject["pid"];?>">
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
                    <label class="bmd-label-floating">ตำบล/แขวง <?php echo $currentDistrict["d_name_th"];?> อำเภอ/เขต <?php echo $currentAmphure["a_name_th"];?> จังหวัด <?php echo $currentProvince["p_name_th"];?></label>
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
              <h4 class="card-title">อัพเดทงาน</h4>
            </div>
            <div class="card-body">
              <table class="table table-striped" id="dataTable">
                <thead>
                  <th style="text-align:center;"><label>งวดที่</label></th>
                  <th style="text-align:left;"><label>รายละเอียด</label></th>
                  <th style="text-align:center;"><label>สถานะ</label></th>
                  <th style="text-align:center;"></th>
                </thead>
                <tbody>
                  <?php if(empty($allProjectPeriod)){ ?>
                  <?php }else{?>
                    <?php foreach($allProjectPeriod as $dataPe){ ?>
                      <tr>
                        <td style="width:10%;">
                          <?php echo $dataPe["period_number"];?>
                        </td>
                        <td style="width:50%;">
                          <?php echo $dataPe["period_detail"];?>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <?php echo $peiord_map[$dataPe["peiod_status"]];?>
                        </td>
                        <td style="width:30%;text-align:center;">
                          <?php if($dataPe["peiod_status"] == 1){ ?>
                          <a data-id="<?php echo $dataPe['id'];?>&projects_id=<?php echo $_GET['id'];?>" href="?complete=<?php echo $dataPe['id'];?>&projects_id=<?php echo $_GET['id'];?>" class="btn btn-outline-info complete-btn">แล้วเสร็จ</a>
                          <?php }?>
                          <a href="upload_image.php?id=<?php echo $dataPe['id'];?>&projects_id=<?php echo $_GET['id'];?>" class="btn btn-outline-success">อัพโหลดภาพ</a>
                          <a href="../progress_image.php?projects_id=<?php echo $dataPe["projects_id"];?>&period_id=<?php echo $dataPe["id"];?>" class="btn btn-info" target="_blank">ดูข้อมูล</a>
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
  <script>
    $('.complete-btn').click(function(e) {
      var id = $(this).data('id');
      var pid = $(this).data('projects_id');
      e.preventDefault();
      complete(id, pid);
    })

    function complete(id, pid) {
      Swal.fire({
        title: 'ยืนยันสถานะ',
        showCancelButton: true,
        confirmButtonColor: '#17c1e8',
        cancelButtonColor: '#777',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        showLoaderOnConfirm: true,
        preConfirm: function() {
          return new Promise(function(resolve){
            $.ajax({
              url: 'update_progress.php',
              type: 'GET',
              data: 'complete=' + id + pid,
            })
            .done(function() {
              Swal.fire({
                title: 'สำเร็จ',
                text: 'ยืนยันสถานะเรียบร้อย',
                icon: 'success',
                confirmButtonText: 'ยืนยัน'
              }).then(() => {
                document.location.href = 'update_progress.php?id=' + <?php echo $_GET['id'];?>;
              })
            })
          })
        }
      })
    }
  </script>

</body>

</html>