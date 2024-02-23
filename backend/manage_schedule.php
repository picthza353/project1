<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php
$allUser = getAllUser();
if (isset($_GET['delete'])) {
  deleteUser($_GET['delete']);
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

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h4>บันทึกการทำงาน</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ชื่อ-นามสกุล</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">อีเมล</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">หมายเลขโทรศัพท์</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ตำแหน่ง</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ประเภทผู้ใช้งาน</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(empty($allUser)){ ?>
                      
                    <?php }else{?>
                      <?php foreach($allUser as $data){ ?>
                        <tr>
                          <td>
                            <div class="d-flex px-2">
                              <div class="my-auto">
                                <h6 class="mb-0 text-sm"><?php echo $data["firstname"];?> <?php echo $data["lastname"];?></h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo $data["email"];?></span>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo $data["telephone"];?></span>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo $data["pos_name"];?></span>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo $role_map[$data["role"]];?></span>
                          </td>
                          <td style="text-align: right;">
                            <a href="edit_schedule.php?id=<?php echo $data["id"];?>" class="btn btn-outline-info">ตรวจสอบข้อมูล</a>
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