<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php
$allWork = getAllWork();
if (isset($_GET['delete'])) {
  deleteWork($_GET['delete']);
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
              <h4>จัดการข้อมูลผลงาน</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <a href="edit_working.php" class="btn btn-outline-success" style="float: right;margin-right:15px;">เพิ่มผลงาน</a>
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ชื่อผลงาน</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">สถานที่</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(empty($allWork)){ ?>
                  
                    <?php }else{?>
                      <?php foreach($allWork as $data){ ?>
                        <tr>
                          <td>
                            <div class="d-flex px-2">
                              <div class="my-auto">
                                <h6 class="mb-0 text-sm"><?php echo $data["work_name"];?></h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo $data["locations"];?></span>
                          </td>
                          
                          <td style="text-align: right;">
                            <a href="edit_working.php?id=<?php echo $data["id"];?>" class="btn btn-outline-info">แก้ไข</a>
                            <a href="?delete=<?php echo $data['id'];?>" class="btn btn-outline-danger" onClick="javascript: return confirm('ยืนยันการลบ');">ลบ</a>
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