﻿<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php
$allProject = getAllProjectNotSuccess();
if (isset($_GET['delete'])) {
  deleteProject($_GET['delete']);
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
              <h4>จัดการข้อมูลงานรับเหมา</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <a href="edit_project.php" class="btn btn-outline-success" style="float: right;margin-right:15px;">สร้างงานรับเหมา</a>
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">เลขที่รับเหมา</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ชื่อ-นามสกุล</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">บริษัท</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">จำนวนวัน</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ค่ารับเหมา</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">ความคืบหน้า</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(empty($allProject)){ ?>
                    <?php }else{?>
                      <?php foreach($allProject as $data){ ?>
                        <?php $calculatePercentProject = getCalculatePercentProject($data["id"]); ?>
                        <tr>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo $data["run_number"];?></span>
                          </td>
                          <td>
                            <div class="d-flex px-2">
                              <div class="my-auto">
                                <h6 class="mb-0 text-sm"><?php echo $data["firstname"];?> <?php echo $data["lastname"];?></h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo $data["company_name"];?></span>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo $data["amount_date"];?> วัน</span>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold"><?php echo number_format($data["total_price"]);?></span>
                          </td>
                          <td class="align-middle text-center">
                            <div class="d-flex align-items-center justify-content-center">
                              <span class="me-2 text-xs font-weight-bold"><?php echo number_format($calculatePercentProject);?> %</span>
                              <div>
                                <div class="progress">
                                  <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="<?php echo number_format($calculatePercentProject);?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo number_format($calculatePercentProject);?>%;"></div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td style="text-align: right;">
                            <a href="pdf_contract.php?id=<?php echo $data["id"];?>" class="btn btn-outline-primary" target="_blank">พิมพ์สัญญา</a>
                            <a href="edit_project.php?id=<?php echo $data["id"];?>" class="btn btn-outline-info">แก้ไข</a>
                            <a data-id="<?php echo $data["id"];?>" href="?delete=<?php echo $data['id'];?>" class="btn btn-outline-danger delete-btn">ลบ</a>
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
  <script>
    $('.delete-btn').click(function(e) {
      var id = $(this).data('id');
      e.preventDefault();
      deleteConfirm(id);
    })

    function deleteConfirm(id) {
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
              url: 'manage_project.php',
              type: 'GET',
              data: 'delete=' + id,
            })
            .done(function() {
              Swal.fire({
                title: 'สำเร็จ',
                text: 'ลบข้อมูลเรียบร้อย',
                icon: 'success',
                confirmButtonText: 'ยืนยัน'
              }).then(() => {
                document.location.href = 'manage_project.php';
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