<?php
session_start();
if (isset($_SESSION['index'])) {
  if ($_SESSION['index'] == true) {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
  } else {
    $username = '';
    $password = '';
  }
} else {
  $username = '';
  $password = '';
}
$_SESSION['index'] = false;
?>
<html>

<head>
  <title>WeVote - Login</title>
  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Fira+Sans&family=Germania+One&family=Playfair+Display:ital@0;1&family=Poppins:wght@500&family=Supermercado+One&family=Tajawal:wght@400;500;700&display=swap"
    rel="stylesheet">

  <!-- Bootstrap -->
  <link href="../vendor/CSS/bootstrap.min.css" rel="stylesheet">
  <!-- Fontawesome -->
  <link href="../vendor/CSS/all.min.css" rel="stylesheet">
  <!-- Custom CSS-->
  <link rel="stylesheet" href="../css/stylesheet.css">
  <!-- Custom CSS-->
  <link rel="stylesheet" href="../css/sos.css">
  <!-- Media CSS-->
  <link href="../css/media.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light pt-2 row fixed-top" id="navbar">
    <div class=" navimg col-4 col-lg-6 row px-5">
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
  <div class="loginheader">
    <div id="loginSection" class="d-flex vh-100">
      <div class="container">
        <br><br><br><br>
        <form action="../api/login.php" method="POST" autocomplete="off">
          <label>Username</label>
          <div class="firstinput">
            <input id="username" type="text" placeholder="Type your username" value='<?php echo $username ?>'
              name="username" class="logininput form-control" required>
            <span class="focus-100">
              <i id="fa-user" class="fa-solid fa-user px-2 mx-2"></i>
              <i id="fa-usercheck" class="fa-solid fa-user-check px-2 mx-2"></i>
            </span>
          </div>
          <div class="small text-danger" id="userAlert">* Use 4 to 15 characters starting with a small letter</div>
          <br>
          <label>Password</label>
          <div class="firstinput">
            <input id="upass" type="password" placeholder="Type your password" value='<?php echo $password ?>'
              name="password" class="logininput form-control" required>
            <span class="focus-100">
              <i id="fa-lock" class="fa-solid fa-lock px-2 mx-2"></i>
              <i id="fa-unlock" class="fa-solid fa-unlock px-2 mx-2"></i>
            </span>
          </div>
          <div class="small text-danger" id="passwordAlert">* Use 6 to 25 characters starting with a letter</div>
          <div id="showHide">
            <i id="showIcon" class="fa-solid fa-eye-slash showhide"></i>
            <i id="hideIcon" class="fa-solid fa-eye showhide"></i>
            <span id="showPass" class="showhide">Show Password</span>
            <span id="hidePass" class="showhide">Hide Password</span>
          </div>
          <br><br>
          <button type="button" name="loginbtn" id="lginbtn" class="btn btn-outline-secondary"
            disabled>Login</button><br><br>
          <center>
            New user? <a href="register.php">Register here</a>
          </center>
        </form>
      </div>
    </div>
  </div>
  <script src="../vendor/JS/login.js"></script>
</body>

</html>