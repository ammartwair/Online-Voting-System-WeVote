<?php
session_start();
include("../api/connection.php");
if (!isset($_SESSION['id'])) {
  header("location: login.php");
}
if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] == false) {
  header("location: dashboard.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pollid = $_POST['pollid'];
  $requests = mysqli_query($connect, "select * from requests where pollid ='$pollid'");
  if (mysqli_num_rows($requests) == 0) {
    $norequests = true;
  } else {
    $norequests = false;
  }
} else {
  $requests = mysqli_query($connect, "select * from requests");
  if (mysqli_num_rows($requests) == 0) {
    $norequests = true;
  } else {
    $norequests = false;
  }
}
$data = $_SESSION['data'];
$img = $data['photo'];
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>WeVote - Admin Requests</title>
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
  <!-- Custom CSS-->
  <link rel="stylesheet" href="../css/stylesheet.css">
  <!-- Custom CSS-->
  <link rel="stylesheet" href="../css/sos.css">
  <!-- Media CSS-->
  <link rel="stylesheet" href="../css/media.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light pt-2 row fixed-top" id="navbar">
    <div class="navimg col-lg-6 row px-5">
      <a class="navbar-brand d-flex justify-content-center mx-0 col-6" href="../">
        <img src="../img/logo-wevote-a-colores.png" alt="logo">
      </a>
      <div class="col-6 d-flex justify-content-center">
        <img class="profimg" src="../uploads/<?php echo $img; ?>" alt="pic">
      </div>
    </div>
    <ul class="navbar-nav m-auto mb-2 mb-lg-0 col-8 col-lg-6 row">
      <a href="dashboard.php" class="col-4">
        <div class="btn-hover color-7 rounded-pill px-2 py-2 mx-3 d-flex align-items-center justify-content-evenly">
          <span class="text-capitalize px-2">Dashboard </span><i class="fa-solid fa-house"></i>
        </div>
      </a>
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
  <div class="reqheader justify-content-center <?php if ($norequests){ echo 'align-items-center'; } ?> row">
    <div class="requestsdiv col-lg-6 row">
      <?php if ($norequests) {
        ?>
        <h2>No Requests to show right now</h2>
        <?php
      } else {
        ?>
        <div class="d-flex pt-5 justify-content-center align-items-center">
          <h1 class="mt-4">Requests</h1>
        </div>
        <hr>
        <?php
        while ($row = $requests->fetch_assoc()) {
          $pollid = $row['pollid'];
          $userid = $row['userid'];
          $reqid = $row['id'];
          $poll = mysqli_query($connect, "select * from polls where id = '$pollid' ");
          $user = mysqli_query($connect, "select * from user where id = '$userid' ");
          $userdata = mysqli_fetch_array($user);
          $polldata = mysqli_fetch_array($poll);
          ?>
          <div class="col-4 d-flex align-items-center justify-content-center">
            <img id="candimg" src="../uploads/<?php echo $userdata['photo']; ?>" alt="candidate's photo" width="120">
          </div>
          <div class="col-4 d-flex align-items-center row">
            <div class="pollname ">
              <h3>Poll's Title:
                <?php echo $polldata['title']; ?>
              </h3>
            </div>
            <div class="userreqnamedesc">
              <h3>Name:
                <?php echo $userdata['name']; ?>
              </h3>
            </div>
          </div>
          <div class="reqbuttons d-flex align-items-center col-4 row">
            <div class="accept">
              <form class="d-flex justify-content-center" action="../api/acceptreq.php" method="POST">
                <input type="hidden" name="reqid" value="<?php echo $reqid ?>">
                <input type="hidden" name="userid" value="<?php echo $userid ?>">
                <input type="hidden" name="pollid" value="<?php echo $pollid ?>">
                <button type="submit" class="acceptreq btn btn-success px-4" id="acceptreq">Accept</button>
              </form>
            </div>
            <div class="reject">
              <form class="d-flex justify-content-center" action="../api/rejectreq.php" method="POST">
                <input type="hidden" name="reqid" value="<?php echo $reqid ?>">
                <input type="hidden" name="userid" value="<?php echo $userid ?>">
                <input type="hidden" name="pollid" value="<?php echo $pollid ?>">
                <button type="submit" class="rejectreq btn btn-danger px-4" id="rejectreq">Reject</button>
              </form>
            </div>
          </div>
          <hr class="my-2">
        <?php
        }
      }
      ?>
    </div>
    <div class="col-lg-6"></div>
  </div>
</body>

</html>