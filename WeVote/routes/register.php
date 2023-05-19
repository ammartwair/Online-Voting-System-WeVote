<?php
session_start();
if (isset($_SESSION['index'])) {
  if ($_SESSION['index'] == true) {
    $name = $_SESSION['name'];
    $username = $_SESSION['username'];
    $mobile = $_SESSION['mobile'];
    $pass = $_SESSION['password'];
    $cpass = $_SESSION['password'];
    $prefix = $_SESSION['prefix'];
    $add = $_SESSION['add'];
  } else {
    $name = '';
    $username = '';
    $mobile = '';
    $pass = '';
    $cpass = '';
    $add = '';
    $prefix = '1';
  }
} else {
  $name = '';
  $username = '';
  $mobile = '';
  $pass = '';
  $cpass = '';
  $add = '';
  $prefix = '1';
}
$_SESSION['index'] = false;
?>
<html>

<head>
  <title>WeVote - Registratrion</title>
  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Fira+Sans&family=Germania+One&family=Playfair+Display:ital@0;1&family=Poppins:wght@500&family=Supermercado+One&family=Tajawal:wght@400;500;700&display=swap"
    rel="stylesheet">
  <!-- Bootstrap -->
  <link href="../vendor/CSS/bootstrap.min.css" rel="stylesheet">
  <!-- Fontawesome -->
  <link href="../vendor/CSS/all.min.css" rel="stylesheet">
  <!-- Sweetalert2-->
  <link rel="stylesheet" href="../vendor/CSS/sweetalert2.min.css">
  <!-- Custom CSS-->
  <link rel="stylesheet" href="../css/stylesheet.css">
  <!-- Custom CSS-->
  <link rel="stylesheet" href="../css/sos.css">
  <!-- Media CSS-->
  <link href="../css/media.css" rel="stylesheet">
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light pt-2 row fixed-top" id="navbar">
    <div class="navimg col-4 col-lg-6 row px-5">
      <a class="navbar-brand" href="../">
        <img src="../img/logo-wevote-a-colores.png" alt="logo">
      </a>
    </div>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 col-8 col-lg-6 row">
      <div class="col-4"></div>
      <div class="col-4"></div>
      <a href="../" class="col-4">
        <div class="btn-hover color-7 rounded-pill px-2 py-2 mx-3 d-flex align-items-center justify-content-evenly">
          <span class="text-capitalize px-2">Home </span><i class="fa-solid fa-house"></i>
        </div>
      </a>
    </ul>
  </nav>
  <div id="registerHeader">
    <div class="regForm">
      <div class="container">
        <br><br><br><br>
        <form action="../api/register.php" method="POST" enctype="multipart/form-data" autocomplete="off">
          <div class="myform">
            <div id="firstpagelogin" class="firstpagelogin"><br>
              <label class="firstpage">Full name</label>
              <div class="firstinput ">
                <input type="text" name="name" value="<?php echo $name; ?>" placeholder="type your full name"
                  id="regname" class="logininput  form-control" required>
                <span class="focus-100">
                  <i id="fa-user" class="fa-solid fa-user px-2 mx-2"></i>
                  <i id="fa-usercheck" class="fa-solid fa-user-check px-2 mx-2"></i>
                </span>
              </div>
              <div class="small text-danger" id="nameAlert"><span>Use 4 to 15 characters starting with a capital
                  letter</span></div>
              <label>Username</label>
              <div class="firstinput">
                <input type="text" name="username" value="<?php echo $username; ?>" placeholder="type a username"
                  id="reguser" class="logininput  form-control" required>
                <span class="focus-100">
                  <i id="fa-user1" class="fa-solid fa-user px-2 mx-2"></i>
                  <i id="fa-usercheck1" class="fa-solid fa-user-check px-2 mx-2"></i>
                </span>
              </div>
              <div class="small text-danger" id="usernameAlert"><span>Use 4 to 15 characters starting with a small
                  letter</span></div>
              <label>Password</label>
              <div class="firstinput">
                <input type="password" name="pass" value="<?php echo $pass; ?>" placeholder="type a password"
                  id="regpass" class="logininput form-control" required>
                <span class="focus-100">
                  <i id="fa-lock" class="fa-solid fa-lock px-2 mx-2"></i>
                  <i id="fa-unlock" class="fa-solid fa-unlock px-2 mx-2"></i>
                </span>
              </div>
              <div class="small text-danger" id="passAlert"><span>Use 6 to 25 characters</span></div>
              <label>Confirm Password</label>
              <div class="firstinput">
                <input type="password" name="cpass" value="<?php echo $pass; ?>" placeholder="confirm your password"
                  id="regconf" class="logininput form-control" required>
                <span class="focus-100">
                  <i id="fa-lock1" class="fa-solid fa-lock px-2 mx-2"></i>
                  <i id="fa-unlock1" class="fa-solid fa-unlock px-2 mx-2"></i>
                </span>
              </div>
              <div class="small text-danger" id="confAlert"><span>Use 6 to 25 characters</span></div>
              <div class="small text-danger" id="confAlert2"><span>Please insert same password here</span></div>
              <div id="showHide">
                <i id="showIcon" class="fa-solid fa-eye-slash showhide"></i>
                <i id="hideIcon" class="fa-solid fa-eye showhide"></i>
                <span id="showPass" class="showhide">Show Password</span>
                <span id="hidePass" class="showhide">Hide Password</span>
              </div><br><br>
              <div>
                <button type="button" id="continuebtn" class="btn btn-outline-secondary" disabled>Continue</button>
                <div class="loginback"><span>Already user? </span><a href="login.php">Login here</a>
                </div>
              </div>
            </div>
            <div id="firstpagelogin1" class="firstpagelogin" style="display:none;">
              <div class="navsz">
                <div id="leftarrow">
                  <i id="a1" class="fa-solid fa-arrow-left-long"></i>
                </div>
              </div><br>
              <label>Mobile Number</label>
              <div class="firstinput">
                <span><select name="prefix" id="phonenumber">
                    <option value="1" <?php if ($prefix == '1') {
                      echo 'selected';
                    } ?>>+970</option>
                    <option <?php if ($prefix != '1') {
                      echo 'selected';
                    } ?> value="2">+972</option>
                  </select></span>
                <input type="number" name="mob" value="<?php echo $mobile; ?>" placeholder="insert your mobile number"
                  id="regmob" class="logininput customClass form-control" required>
                <span class="focus-100">
                  <i id="fa-phone" class="fa-solid fa-phone px-2 mx-2"></i>
                </span>
              </div>
              <div class="small text-danger" id="regMobAlert"><span>Please enter a valid mobile number</span></div>
              <label for="add">Address</label>
              <div class="firstinput">
                <input type="text" name="add" value="<?php echo $add; ?>" placeholder="Address" id="regadd"
                  class="logininput finput form-control" required>
                <span class="focus-100">
                  <i id="fa-address" class="fa-solid fa-location-dot px-2 mx-2"></i>
                </span>
              </div>
              <div class="small text-danger" id="addAlert"><span>Use 5 to 120 characters starting with a letter</span>
              </div><br>
              <div id="upload">
                <div class="file-input">
                  <span>Upload a profile photo:</span>
                  <input type="file" name="file-input" id="file-input" class="file-input__input" required>
                  <label class="file-input__label" for="file-input">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload"
                      class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512">
                      <path fill="currentColor"
                        d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z">
                      </path>
                    </svg>
                    <span>Upload file</span>
                  </label>
                </div>
              </div><br>
              <div class="regbtn">
                <button class="btn btn-outline-secondary" id="regbtn" type="button" name="registerbtn"
                  disabled>Register</button><br>
              </div><br><br>
              <div class="loginback"><span>Already user? </span><a href="login.php">Login here</a>
              </div>
            </div>
          </div>
          <input type="hidden" name="custom" id="custom" value="">
        </form>
      </div>
    </div>
  </div>
  <script src="../vendor/JS/registration.js"></script>
  <script src="../vendor/JS/sweetalert2.min.js"></script>
</body>

</html>