<?php 
session_start();
require_once('../config.php');

// Check status button login 
if (isset($_POST["login"])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // check data with database
  $result = mysqli_query($connection, "SELECT * FROM users JOIN employee ON users.id_employee = employee.id WHERE username = '$username'");
  if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);

    if(password_verify($password, $row['password'])){
      if($row['status'] == 'active'){
        // Simpan data ke session
        $_SESSION['success-login'] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['ein'] = $row['ein'];
        $_SESSION['position'] = $row['position'];
        $_SESSION['attendance_loc'] = $row['attendance_loc'];

        // role checks to navigate to each page
        if($row['role'] === 'admin'){
          header("Location: ../admin/home/home.php");
          exit();
        }else{
          header("Location: ../employee/home/home.php");
          exit();
        }
      }else{
        $_SESSION['failed-login'] = 'Account not Active';
      }
    }else{
      $_SESSION['failed-login'] = 'Incorrect Password, Try Again!';
    }

  }else{
    // echo "Login Failed";
    $_SESSION['failed-login'] = 'Username not found, Try Again!';
  }
}

?>
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sign in with illustration - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>

    <!-- CSS files -->
    <link href="<?= base_url('assets/css/tabler.min.css?1684106062')?>" rel="stylesheet"/>
    <link href=<?= base_url("assets/css/tabler-flags.min.css?1684106062") ?> rel="stylesheet"/>
    <link href=<?= base_url("assets/css/tabler-payments.min.css?1684106062") ?> rel="stylesheet"/>
    <link href=<?= base_url("assets/css/tabler-vendors.min.css?1684106062") ?> rel="stylesheet"/>
    <link href=<?= base_url("assets/css/demo.min.css?1684106062") ?> rel="stylesheet"/>
    
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
        font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
      <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
          <div class="col-lg">
            <div class="container-tight">
              <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?= base_url('static/logo-small.svg')?>" height="36" alt=""></a>
              </div>

              <?php
              if(isset($_GET['msg'])){
                if($_GET['msg'] == '001'){
                  $_SESSION['failed-login'] = "You haven't logged in yet";
                }else if($_GET['msg'] == '002'){
                  $_SESSION['failed-login'] = "Access Denied";
                }
              }
              ?>

              <div class="card card-md">
                <div class="card-body">
                  <h2 class="h2 text-center mb-4">Login to your account</h2>

                  <form action="" method="POST" autocomplete="off" novalidate>
                    <div class="mb-3">
                      <label class="form-label">Username</label>
                      <input type="text" class="form-control" name="username" placeholder="username" autocomplete="off" autofocus>
                    </div>
                    <div class="mb-2">
                      <label class="form-label">
                        Password
                        <span class="form-label-description">
                          <a href="./forgot-password.html">I forgot password</a>
                        </span>
                      </label>
                      <div class="input-group input-group-flat">
                        <input type="password" class="form-control" name="password" placeholder="password"  autocomplete="off">
                        <span class="input-group-text">
                          <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                          </a>
                        </span>
                      </div>
                    </div>
                    <div class="mb-2">
                      <label class="form-check">
                        <input type="checkbox" class="form-check-input"/>
                        <span class="form-check-label">Remember me on this device</span>
                      </label>
                    </div>
                    <div class="form-footer">
                      <button type="submit" name="login" class="btn btn-primary w-100">Log in</button>
                    </div>
                  </form>
                </div>
                <div class="hr-text">or</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col"><a href="#" class="btn w-100">
                        <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-github" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" /></svg>
                        Login with Github
                      </a></div>
                    <div class="col"><a href="#" class="btn w-100">
                        <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-twitter" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z" /></svg>
                        Login with Twitter
                      </a></div>
                    </div>
                    <div class="col"><a href="#" class="btn w-100 mt-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-gmail text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 20h3a1 1 0 0 0 1 -1v-14a1 1 0 0 0 -1 -1h-3v16z" /><path d="M5 20h3v-16h-3a1 1 0 0 0 -1 1v14a1 1 0 0 0 1 1z" /><path d="M16 4l-4 4l-4 -4" /><path d="M4 6.5l8 7.5l8 -7.5" /></svg>
                        Login with Gmail
                      </a>
                    </div>
                </div>
              </div>
              <div class="text-center text-muted mt-3">
                Don't have account yet? <a href="./sign-up.html" tabindex="-1">Sign up</a>
              </div>
            </div>
          </div>
          <div class="col-lg d-none d-lg-block">
            <img src="<?= base_url('static/illustrations/undraw_secure_login_pdn4.svg')?>" height="300" class="d-block mx-auto" alt="">
          </div>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <script src=<?= base_url("assets/libs/apexcharts/dist/apexcharts.min.js?1684106062") ?> defer></script>
    <script src=<?= base_url("assets/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062") ?> defer></script>
    <script src=<?= base_url("assets/libs/jsvectormap/dist/maps/world.js?1684106062") ?> defer></script>
    <script src=<?= base_url("assets/libs/jsvectormap/dist/maps/world-merc.js?1684106062") ?> defer></script>

    <!-- Tabler Core -->
    <script src=<?= base_url("assets/js/tabler.min.js?1684106062") ?> defer></script>
    <script src=<?= base_url("assets/js/demo.min.js?1684106062") ?> defer></script>

    <!-- add-ons  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- alert login failed  -->
    <?php if($_SESSION['failed-login']) { ?>
      <script>
        Swal.fire({
          icon: "error",
          title: "Login Failed",
          text: "<?= $_SESSION['failed-login']?>",
          footer: '<a href="#">Why do I have this issue?</a>'
        });
      </script>

      <?php unset($_SESSION['failed-login']);?>

    <?php } ?>

  </body>
</html>