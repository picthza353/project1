<?php
session_start();
require("function/function.php");
?>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Website for Building Contractor Management System (เว็บไซต์ระบบการจัดการผู้รับเหมาก่อสร้าง)
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->

  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
  <link href="datepicker/datetimepicker-master/jquery.datetimepicker.css" rel="stylesheet" />
  <script src="datepicker/datetimepicker-master/jquery.datetimepicker.js"></script>
  
  
</head>

<?php 
$role_map = array( 1=>'ผู้รับเหมา',2=>'ลูกจ้าง',3=>'ผู้ว่าจ้าง');
$salary_map = array( 1=>'รายวัน',2=>'รายสัปดาห์',3=>'รายเดือน');
$peiord_map = array( 1=>'<span style="color:red;">ค้างชำระ</span>',2=>'<span style="color:green;">ชำระเรียบร้อย</span>');
$ie_category_map = array( 1=>'<span style="color:green;">รายรับ</span>',2=>'<span style="color:red;">รายจ่าย</span>');
$ie_type_map = array( 1=>'เงินสด',2=>'โอนชำระ',3=>'เชคเงินสด');
?>
