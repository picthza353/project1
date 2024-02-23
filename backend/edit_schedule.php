<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 

$currentUser = getCurrentUser($_GET["id"]);
$allProject = getAllProject();
$allUserSchedule = getAllUserSchedule($_GET["id"]);

if(isset($_POST["submit"])){
  saveStartWork($_POST["users_id"],$_POST["projects_id"],$_POST["work_start_date"],$_POST["work_start_time"]);
}

if(isset($_GET["check_out"])){
  saveEndWork($_GET["check_out"],$_GET["users_id"]);
}

if (isset($_GET['delete'])) {
  deleteScheduleWork($_GET['delete'],$_GET["users_id"]);
}
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
      <form name="prduct_detail_form" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="users_id" value="<?php echo $currentUser["uid"];?>">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">ข้อมูลการทำงาน</h4>
              </div>

              <div class="card-body">

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ชื่อ-นามสกุล</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo $currentUser["firstname"];?> <?php echo $currentUser["lastname"];?></label>
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
                      <label class="bmd-label-floating"><?php echo $currentUser["email"];?></label>
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
                      <label class="bmd-label-floating"><?php echo $currentUser["telephone"];?></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ตำแหน่ง</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo $currentUser["pos_name"];?></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">เงินที่ได้รับ</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo number_format($currentUser["salary"]);?> บาท</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">สถานที่ทำงาน<span style="color: red;"> *</span></label>
                      <select name="projects_id" class="form-control border-input" id="projects_id" required>
                        <option value="">-- โปรดเลือก --</option>
                        <?php foreach($allProject as $dataPro){ ?>
                          <?php $selected = "";
                          if($currentProject['projects_id'] == $dataPro['id']){
                            $selected = " selected";

                          }
                          ?>
                          <option value="<?php echo $dataPro['id']?>" <?php echo $selected;?>><?php echo $dataPro['building_type']?> <?php echo $dataPro['land_tumbol']?> <?php echo $dataPro['land_amphur']?> <?php echo $dataPro['land_province']?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">วันที่<span style="color: red;"> *</span></label>
                      <?php 
                        $yThai = date("Y")+543;
                        $dateNow = date("d/m/").$yThai;
                      ?>
                      <input type="text" class="form-control" name="work_start_date" id="work_start_date" value="<?php echo $dateNow?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">เวลา<span style="color: red;"> *</span></label>
                      <?php  
                        $time = date("H:i");
                      ?>
                      <input type="text" class="form-control" name="work_start_time" id="work_start_time" value="<?php echo $time?>" required>
                    </div>
                  </div>
                </div>
                <div align="center">
                  <input type="submit" name="submit" class="btn btn-success btn-round" value="บันทึกเข้างาน">
                  <input type="button" name="button" class="btn btn-danger btn-round" onClick="javascript:history.go(-1)" value="ย้อนกลับ">

                </div>
                <div class="clearfix"></div>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-profile">
              <?php if($currentUser["profile_img"] != ""){ ?>
                <img class="img-fluid shadow border-radius-xl" src="images/user/<?php echo $currentUser["profile_img"];?>" />
              <?php }else{ ?>
                <img class="img-fluid shadow border-radius-xl" src="images/user_ico.png" />
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="row" style="margin-top: 25px;">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">ตารางการทำงาน</h4>
            </div>
            <div class="card-body">
              <table class="table table-striped" id="dataTable">
                <thead>
                  <th style="text-align:left;"><label>สถานที่ทำงาน</label></th>
                  <th style="text-align:center;"><label>วันทีเข้างาน</label></th>
                  <th style="text-align:center;"><label>เวลาที่เข้างาน</label></th>
                  <th style="text-align:center;"><label>วันทีออกงาน</label></th>
                  <th style="text-align:center;"><label>เวลาที่ออกงาน</label></th>
                  <th style="text-align:center;"></th>
                </thead>
                <tbody>
                  <?php if(empty($allUserSchedule)){ ?>
                  <?php }else{?>
                    <?php foreach($allUserSchedule as $dataSc){ ?>

                      <tr>
                        <td style="width:50%;text-align:left;">
                          <label class="bmd-label-floating"><?php echo $dataSc["building_type"];?> <?php echo $dataSc["land_tumbol"];?> <?php echo $dataSc["land_amphur"];?> <?php echo $dataSc["land_province"];?></label>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <label class="bmd-label-floating"><?php echo formatDateFull($dataSc["work_start_date"]);?></label>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <label class="bmd-label-floating"><?php echo substr($dataSc["work_start_time"],0,5);?></label>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <label class="bmd-label-floating"><?php echo formatDateFull($dataSc["work_end_date"]);?></label>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <label class="bmd-label-floating"><?php echo substr($dataSc["work_end_time"],0,5);?></label>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <?php if($dataSc["work_end_date"] == "0000-00-00"){ ?>
                            <a data-id="<?php echo $dataSc['id'];?>&users_id=<?php echo $currentUser['uid'];?>" href="?check_out=<?php echo $dataSc['id'];?>&users_id=<?php echo $currentUser['uid'];?>" class="btn btn-danger checkout-btn">ลงเวลาออก</a>
                          <?php }else{ ?>
                            <a href="edit_schedule_job.php?id=<?php echo $dataSc["id"];?>&users_id=<?php echo $currentUser['uid'];?>" class="btn btn-info">แก้ไข</a>
                            <a data-id="<?php echo $dataSc['id'];?>&users_id=<?php echo $currentUser['uid'];?>" href="?delete=<?php echo $dataSc['id'];?>&users_id=<?php echo $currentUser['uid'];?>" class="btn btn-danger delete-btn" >ลบ</a>
                          <?php } ?>
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

      </form>
      <?php
      require_once("footer.php");
      ?>
      <script>
        var today = new Date();

        $('#work_start_date').datetimepicker({
          lang:'th',
          minDate:today,
          timepicker:false,
          format:'d/m/Y'
        });
        $('#work_start_time').datetimepicker({
          lang:'th',
          datepicker:false,
          format:'H:i',
          enabledHours: '10'

        });
      </script>
    </div>
  </main>
  <script>
    $('.checkout-btn').click(function(e) {
      var id = $(this).data('id');
      var uid = $(this).data('users_id');
      e.preventDefault();
      checkoutConfirm(id, uid);
    })

    $('.delete-btn').click(function(e) {
      var id = $(this).data('id');
      var uid = $(this).data('users_id');
      e.preventDefault();
      deleteConfirm(id, uid);
    })

    function checkoutConfirm(id, uid) {
      Swal.fire({
        title: 'ยืนยันการลงเวลาออก',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#777',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        showLoaderOnConfirm: true,
        preConfirm: function() {
          return new Promise(function(resolve){
            $.ajax({
              url: 'edit_schedule.php',
              type: 'GET',
              data: 'check_out=' + id + uid,
            })
            .done(function() {
              Swal.fire({
                title: 'สำเร็จ',
                text: 'ลงเวลาออกเรียบร้อย',
                icon: 'success',
                confirmButtonText: 'ยืนยัน'
              }).then(() => {
                document.location.href = 'edit_schedule.php?id=' + <?php echo $currentUser["uid"];?>;
              })
            })
          })
        }
      })
    }

    function deleteConfirm(id, uid) {
      Swal.fire({
        title: 'ยืนยันการลบ',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#777',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        showLoaderOnConfirm: true,
        preConfirm: function() {
          return new Promise(function(resolve){
            $.ajax({
              url: 'edit_schedule.php',
              type: 'GET',
              data: 'delete=' + id + uid,
            })
            .done(function() {
              Swal.fire({
                title: 'สำเร็จ',
                text: 'ลบข้อมูลเรียบร้อย',
                icon: 'success',
                confirmButtonText: 'ยืนยัน'
              }).then(() => {
                document.location.href = 'edit_schedule.php?id=' + <?php echo $currentUser["uid"];?>;
              })
            })
            .fail(function() {
              Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถลบข้อมูลได้', 'error');
              window.location.reload();
            })
          })
        }
      })
    }
  </script>

</body>

</html>