<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free" >
<?php
require_once("header.php");
?>

<?php 
if(isset($_POST["login"])){
  checkLogin($_POST["username"],$_POST["password"]);
}

?>

<body>

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <img src="assets/img/logo_login.png" alt="User" class="img-fluid" />
              <!--<a href="#" class="app-brand-link gap-2">
                
                <span class="app-brand-text demo text-body fw-bolder">Sign In</span>
              </a>-->
            </div>
            <h4 class="mb-2">Building Contractor Management System 👋</h4>
            <p class="mb-4">Please sign-in to your account </p>

            <form name="login_form" class="mb-3" action="" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Username</label>
                <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                placeholder="Enter your username"
                autofocus
                />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Password</label>
                <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="Enter your Password"
                autofocus
                />
              </div>
              <div class="mb-3">
                <input type="submit" name="login" value="Sign in" class="btn btn-primary d-grid w-100">
              </div>
            </form>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>


</body>
</html>
