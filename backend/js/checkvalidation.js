var tel = $("#telephone");
  tel.on("change", function() {
    var phoneNumber = $(this).val();
    var phoneRegex = /^0[6,8-9]\(?(\d{1})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
      if (!phoneRegex.test(phoneNumber)){
        Swal.fire({
          icon: 'error',
          title: 'เกิดข้อผิดพลาด',
          text: 'เบอร์โทรศัพท์ไม่ถูกต้อง',
          confirmButtonText: 'ตกลง'
        });
        $('#telephone').val('');
      }
    });

var mail = $("#email");
    mail.on("blur", function() {
      var email = $(this).val();
      var mailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!mailRegex.test(email)){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'อีเมลไม่ถูกต้อง',
            confirmButtonText: 'ตกลง'
          });
          $('#email').val('');
        }
      });

var tel = $("#telephoneEmp");
  tel.on("change", function() {
    var phoneNumber = $(this).val();
    var phoneRegex = /^0[6,8-9]\(?(\d{1})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
      if (!phoneRegex.test(phoneNumber)){
        Swal.fire({
          icon: 'error',
          title: 'เกิดข้อผิดพลาด',
          text: 'เบอร์โทรศัพท์ไม่ถูกต้อง',
          confirmButtonText: 'ตกลง'
        });
        $('#telephoneEmp').val('');
      }
    });

var mail = $("#emailEmp");
    mail.on("blur", function() {
      var email = $(this).val();
      var mailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!mailRegex.test(email)){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'อีเมลไม่ถูกต้อง',
            confirmButtonText: 'ตกลง'
          });
          $('#emailEmp').val('');
        }
      });

$(document).ready(function(){
  
  $('#telephone').blur(function () {
    var phone = $('#telephone').val();
    $.get("api/api.php?load=user", function(data){
      pro_line_new = jQuery.parseJSON(data);
      for (var j = 0, len = pro_line_new.length; j < len; j++) {
        if(phone == pro_line_new[j].telephone){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'เบอร์นี้ถูกใช้งานแล้ว',
            confirmButtonText: 'ตกลง'
          });
          $('#telephone').val('');
        }
      }
    });
  });

  $('#email').blur(function () {
    var email = $('#email').val();
    $.get("api/api.php?load=user", function(data){
      pro_line_new = jQuery.parseJSON(data);
      for (var j = 0, len = pro_line_new.length; j < len; j++) {
        if(email == pro_line_new[j].email){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'อีเมลนี้ถูกใช้งานแล้ว',
            confirmButtonText: 'ตกลง'
          });
          $('#email').val('');
        }
      }
    });
  });

  $('#username').blur(function () {
    var username = $('#username').val();
    $.get("api/api.php?load=user", function(data){
      pro_line_new = jQuery.parseJSON(data);
      for (var j = 0, len = pro_line_new.length; j < len; j++) {
        if(username == pro_line_new[j].username){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'Username นี้ถูกใช้งานแล้ว',
            confirmButtonText: 'ตกลง'
          });
          $('#username').val('');
        }
      }
    });
  });

  $('#usernameEmp').blur(function () {
    var username = $('#usernameEmp').val();
    $.get("api/api.php?load=employer", function(data){
      pro_line_new = jQuery.parseJSON(data);
      for (var j = 0, len = pro_line_new.length; j < len; j++) {
        if(username == pro_line_new[j].username){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'Username นี้ถูกใช้งานแล้ว',
            confirmButtonText: 'ตกลง'
          });
          $('#usernameEmp').val('');
        }
      }
    });
  });

  $('#telephoneEmp').blur(function () {
    var phone = $('#telephoneEmp').val();
    $.get("api/api.php?load=employer", function(data){
      pro_line_new = jQuery.parseJSON(data);
      for (var j = 0, len = pro_line_new.length; j < len; j++) {
        if(phone == pro_line_new[j].telephone){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'เบอร์นี้ถูกใช้งานแล้ว',
            confirmButtonText: 'ตกลง'
          });
          $('#telephoneEmp').val('');
        }
      }
    });
  });

  $('#emailEmp').blur(function () {
    var email = $('#emailEmp').val();
    $.get("api/api.php?load=employer", function(data){
      pro_line_new = jQuery.parseJSON(data);
      for (var j = 0, len = pro_line_new.length; j < len; j++) {
        if(email == pro_line_new[j].email){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'อีเมลนี้ถูกใช้งานแล้ว',
            confirmButtonText: 'ตกลง'
          });
          $('#emailEmp').val('');
        }
      }
    });
  });

});