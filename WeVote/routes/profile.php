<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("location: login.php");
}
$data = $_SESSION['data'];
if (isset($_SESSION['index'])) {
  if ($_SESSION['index'] == true) {
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
    $password = $_SESSION['pass'];
    $cpassword = $_SESSION['pass'];
    $mobile = $_SESSION['mobile'];
    $address = $_SESSION['add'];
    $prefix = $_SESSION['prefix'];
  } else {
    $username = $data['username'];
    $name = $data['name'];
    $password = $cpassword = '';
    $mobile = $data['mobile'];
    $address = $data['address'];
    $prefix = $data['prefix'];
  }
} else {
  $username = $data['username'];
  $name = $data['name'];
  $password = $cpassword = '';
  $mobile = $data['mobile'];
  $address = $data['address'];
  $prefix = $data['prefix'];
}
if ($data['isadmin'] == 1) {
  $isadmin = true;
} else {
  $isadmin = false;
}
$_SESSION['index'] = false;
$img = $data['photo'];
?>
<html lang="en">

<head>
  <title>WeVote - Profile</title>
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
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center col-8 col-lg-6 row">
      <div class="col-4 d-flex justify-content-center">
        <img class="profimg" src="../uploads/<?php echo $img; ?>" alt="pic">
      </div>
      <a href="dashboard.php" class="col-4">
        <div class="btn-hover color-7 rounded-pill px-2 py-2 mx-3 d-flex align-items-center justify-content-evenly">
          <span class="text-capitalize px-2">Dashboard </span><i class="fa-solid fa-house"></i>
        </div>
      </a>
      <a href="logout.php" class="col-4">
        <div class="btn-hover color-7 rounded-pill px-2 py-2 mx-3 d-flex align-items-center justify-content-evenly">
          <span class="text-capitalize px-2">Log out </span><i class="fa-solid fa-arrow-right-from-bracket"></i>
        </div>
      </a>
    </ul>
  </nav>
  <div class="row profileheader d-flex justify-content-evenly">
    <form action="../api/edit.php" method="POST" class="col-lg-4" enctype="multipart/form-data" autocomplete="off">
      <div class="myform">
        <div id="firstpagelogin" class="firstpagelogin">
          <label class="firstpage">Full name</label>
          <div class="firstinput ">
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Chage your name" id="regname"
              class="logininput  form-control" required>
            <span class="focus-100">
              <i id="fa-user" class="fa-solid fa-user px-2 mx-2"></i>
              <i id="fa-usercheck" class="fa-solid fa-user-check px-2 mx-2"></i>
            </span>
          </div>
          <div class="small text-danger" id="nameAlert"><span>Use 4 to 15 characters starting with a capital
              letter</span></div>
          <label>Username</label>
          <div class="firstinput">
            <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Chage your username"
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
            <input type="password" name="pass" value="<?php echo $password; ?>" placeholder="type a new password"
              id="regpass" class="logininput form-control">
            <span class="focus-100">
              <i id="fa-lock" class="fa-solid fa-lock px-2 mx-2"></i>
              <i id="fa-unlock" class="fa-solid fa-unlock px-2 mx-2"></i>
            </span>
          </div>
          <div class="small text-danger" id="passAlert"><span>Use 6 to 25 characters</span></div>
          <label>Confirm Password</label>
          <div class="firstinput">
            <input type="password" name="cpass" value="<?php echo $cpassword; ?>" placeholder="confirm your password"
              id="regconf" class="logininput form-control">
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
            <span><select name="prefix" id="prefix">
                <option <?php if ($prefix == 1) {
                  echo 'selected';
                } ?> value="1">+970</option>
                <option <?php if ($prefix != 1) {
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
            <input type="text" name="add" value="<?php echo $address; ?>" placeholder="Address" id="regadd"
              class="logininput finput form-control" required>
            <span class="focus-100">
              <i id="fa-address" class="fa-solid fa-location-dot px-2 mx-2"></i>
            </span>
          </div>
          <div class="small text-danger" id="addAlert"><span>Use 5 to 120 characters starting with a letter</span></div>
          <br>
          <div class="regbtn">
            <button class="btn btn-outline-secondary" id="regbtn" type="button" name="registerbtn"
              disabled>Update</button><br>
          </div><br><br>
        </div>
      </div>
      <input id="iname" type="hidden" value="<?php echo $name; ?>">
      <input id="iuser" type="hidden" value="<?php echo $username; ?>">
      <input id="imob" type="hidden" value="<?php echo $mobile; ?>">
      <input id="iadd" type="hidden" value="<?php echo $address; ?>">
      <input id="ipass" type="hidden" value="<?php echo $password; ?>">
      <input id="iprefix" type="hidden" value="<?php echo $prefix; ?>">
    </form>
    <div class="col-lg-4">
      <div class="profileimg">
        <img src="../img/undraw_success_factors_re_ce93.svg" alt="profile page image" width="460">
      </div>
      <?php if ($isadmin) { ?>
        <form action="../api/createadmin.php" method="POST">
          <label>Make a new admin:</label>
          <div class="firstinput ">
            <input type="text" name="useradmin" placeholder="Enter a username" id="useradmin"
              class="logininput form-control" required>
            <span class="focus-100">
            </span>
          </div>
          <div class="small text-danger" id="adminAlert"><span>Please Enter a valid username</span></div>
          <div class="regbtn">
            <button class="btn btn-outline-secondary" id="adminbtn" type="button" name="adminbtn" disabled>Make an
              admin</button><br>
          </div>
        </form>
      <?php } else { ?>
        <input type="hidden" id="adminAlert" value="">
        <input type="hidden" id="useradmin" value="">
        <input type="hidden" id="adminbtn" value="">
      <?php } ?>
    </div>
  </div>

  <script src="../vendor/JS/profile.js"></script>
  <!-- Sweetalert2 JS-->
  <script src="../vendor/JS/sweetalert2.min.js"></script>
</body>

</html>