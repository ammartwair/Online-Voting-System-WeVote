<?php
session_start();
include("../api/connection.php");
if (!isset($_SESSION['id'])) {
  header("location: login.php");
}
$pollsIsEmpty = true;
$polls = mysqli_query($connect, "select * from polls");
if (mysqli_num_rows($polls) > 0) {
  $pollsIsEmpty = false;
}
$isadmin = $_SESSION['isadmin'];
$data = $_SESSION['data'];
$voterid = $data['id'];
$img = $data['photo'];
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>WeVote - Elections</title>
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
  <div class="pollheader <?php if ($pollsIsEmpty) {
    echo 'd-flex align-items-center';
  } else {
    echo 'pt-5';
  } ?> ">
    <div class="pollsdiv row">

      <?php if ($pollsIsEmpty) {
        ?>
        <div>
          <h2>No Elections to show right now</h2>
        </div>
        <?php
      } else {
        ?>
        <div class="col-lg-6">
          <div class="pt-5 row">
            <h2>“Voting is a civic sacrament” </h2>
            <h3>- Rev. Theodore Hesburgh, C.S.C.</h3>
            <hr class="my-0">
            <?php
            while ($row = $polls->fetch_assoc()) {
              $pollid = $row['id'];
              $polltitle = $row['title'];
              $polldesc = $row['description'];
              $pollvisibility = $row['visibility'];
              $total_votes = $row['total'];
              ?>
              <div class="pollrow row my-3">
                <div class="col-6">
                  <div class="pollname"><b>Title: </b><span class="ms-3">
                      <?php echo $polltitle; ?>
                    </span></div>
                  <?php if ($polldesc != '') { ?>
                    <div class="polldesc"><b>Description: </b><span class="ms-3">
                        <?php echo $polldesc; ?>
                      </span></div>
                  <?php }
                  $voters = mysqli_query($connect, "select * from voters where pollid = '$pollid' and userid = '$voterid'");
                  if (mysqli_num_rows($voters) > 0) {
                    $hasvoted = true;
                  } else {
                    $hasvoted = false;
                  }
                  if ($isadmin or ($pollvisibility == '1') or ($pollvisibility == '2' && $hasvoted)) {
                    ?>
                    <div class="pollvotes"><b>Total Votes: </b><span class="ms-3">
                        <?php if ($total_votes == '0') {
                          echo 'No votes yet';
                        } else {
                          echo $total_votes;
                        } ?>
                      </span></div>
                  <?php } ?>
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center">
                  <div class="pollbtn">
                    <form action="poll.php" class="my-0" method="POST">
                      <input type="hidden" name="pollid" value="<?php echo $pollid; ?>">
                      <button type="submit" name="pollbtn" id="pollbtn" class="btn btn-primary">See Candidates</button>
                    </form>
                  </div>
                </div>
              </div>
              <hr>
              <?php
            }
      }
      ?>
        </div>
      </div>
    </div>
  </div>

</body>

</html>