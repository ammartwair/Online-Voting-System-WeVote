<?php
session_start();
include("../api/connection.php");
if (!isset($_SESSION['id'])) {
  header("location: login.php");
}
$data = $_SESSION['data'];
$isadmin = $_SESSION['isadmin'];
$requests = mysqli_query($connect, "select * from requests");
$reqnum = mysqli_num_rows($requests);
$img = $data['photo'];
?>
<html>

<head>
  <title>WeVote - Dashboard</title>
  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Fira+Sans&family=Germania+One&family=Playfair+Display:ital@0;1&family=Poppins:wght@500&family=Supermercado+One&family=Tajawal:wght@400;500;700&display=swap"
    rel="stylesheet">
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
  <link rel="stylesheet" href="../css/media.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light pt-2 row fixed-top" id="navbar">
    <div class="navimg col-6 row align-items-center justify-content-center px-5">
      <a class="navbar-brand mx-0 mb-sm-2" href="../">
        <img src="../img/logo-wevote-a-colores.png" alt="logo" height="60px">
      </a>
    </div>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 col-6 align-items-center row">
      <div class="col-4 d-flex justify-content-center">
      <img class="profimg" src="../uploads/<?php echo $img; ?>" alt="pic">
      </div>
      <a href="profile.php" class="col-4">
        <div class="btn-hover color-7 rounded-pill px-2 py-2 mx-3 d-flex align-items-center justify-content-evenly">
          <span class="text-capitalize px-2">Profile </span><i class="fa-solid fa-user"></i>
        </div>
      </a>
      <a href="logout.php" class="col-4">
        <div class="btn-hover color-7 rounded-pill px-2 py-2 mx-3 d-flex align-items-center justify-content-evenly">
          <span class="text-capitalize px-2">Log out </span><i class="fa-solid fa-arrow-right-from-bracket"></i>
        </div>
      </a>
    </ul>
  </nav>
  <div class="t941">
    <div class="t941__wrapper t-container" style="height: 100vh;">
      <div class="t941__content t-col">
        <div></div>
        <h2>“The ballot is stronger than the bullet.” </h2>
        <h3>— Abraham Lincoln, 16th President of the United States from 1861 to 1865</h3><br>
        <?php
        if ($isadmin) {
          ?>
          <a href="createpoll.php">
            <div class="d-flex customz justify-content-center btn-hover color-7 rounded-pill px-2 py-2 my-3">
              <span class="text-capitalize px-2">Create Election</span>
            </div>
          </a>
        <?php } ?>
        <a href="polls.php">
          <div class="d-flex customz justify-content-center btn-hover color-7 rounded-pill px-2 py-2 my-3">
            <span class="text-capitalize px-2">View Elections</span>
          </div>
        </a>
        <?php
        if ($isadmin) {
          ?>
          <a href="requests.php">
            <div class="d-flex customz justify-content-center btn-hover color-7 rounded-pill px-2 py-2 my-3">
              <span class="text-capitalize px-2">See Requests
                <?php if ($reqnum > 0) {
                  echo "(" . $reqnum . ")";
                } ?>
              </span>
            </div>
          </a>
        <?php } ?>
      </div>
      <div class="t941__cover-wrap">
        <div class="t941__cover t-bgimg loaded"
          data-original="../img/tild3830-3138-4364-a662-383535646563__main-new.jpg" bgimgfield="img"
          style="background-image: url(&quot;../img/tild3830-3138-4364-a662-383535646563__main-new.jpg&quot;);"
          itemscope="" itemtype="http://schema.org/ImageObject" src="">
          <meta itemprop="image" content="../img/tild3830-3138-4364-a662-383535646563__main-new.jpg">
        </div>
      </div>
    </div>
  </div>
</body>

</html>