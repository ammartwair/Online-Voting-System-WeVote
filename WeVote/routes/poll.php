<?php
session_start();
include("../api/connection.php");
if (!isset($_SESSION['id'])) {
  header("location: login.php");
}
if (!isset($_POST['pollid'])) {
  header("location: polls.php");
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header("location: polls.php");
}
$data = $_SESSION['data'];
$voterid = $data['id'];
$pollid = $_POST['pollid'];
$getpolls = mysqli_query($connect, "select * from polls where id ='$pollid'");
$polls = mysqli_fetch_array($getpolls);
$polltitle = $polls['title'];
$polldesc = $polls['description'];
$polledit = $polls['editvote'];
$pollvisibility = $polls['visibility'];
$pollvotes = $polls['total'];
$isadmin = $_SESSION['isadmin'];
$cand = mysqli_query($connect, "select * from candidates where pollid = '$pollid' ");
$voters = mysqli_query($connect, "select * from voters where pollid = '$pollid' and userid = '$voterid'");
if (mysqli_num_rows($voters) > 0) {
  $voteddata = mysqli_fetch_array($voters);
  $votedto = $voteddata['candid'];
  $hasvoted = true;
} else {
  $hasvoted = false;
}
$checkvoter = mysqli_query($connect, "select * from candidates where userid = '$voterid' and pollid ='$pollid' ");
if (mysqli_num_rows($checkvoter) > 0) {
  $isCandidate = true;
} else {
  $isCandidate = false;
}
$checkreq = mysqli_query($connect, "select * from requests where userid = '$voterid' and pollid ='$pollid' ");
if (mysqli_num_rows($checkreq) > 0) {
  $hasRequested = true;
} else {
  $hasRequested = false;
}
$img = $data['photo'];
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>WeVote - Election</title>
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
  <div class="pollheader row pt-5">
    <div class="col-lg-6 row pt-5">
      <div class="pollinfo row align-items-center">
        <div class="d-flex polltitle justify-content-center">
          <h2>
            <?php echo $polltitle; ?>
          </h2>
        </div>
        <?php if ($polldesc != '') { ?>
          <div class="polldesc d-flex align-items-center">
            <h3>Description:
              <?php echo $polldesc ?>
            </h3>
          </div>
        <?php }
        if (!$isadmin and !$isCandidate and !$hasvoted) { ?>
          <div class="candbtn">
            <form action="../api/request.php" method="POST">
              <input type="hidden" name="userid" value="<?php echo $voterid ?>">
              <input type="hidden" name="pollid" value="<?php echo $pollid ?>">
              <input type="hidden" name="reqtype" value="<?php if (!$hasRequested) {
                echo '1';
              } else {
                echo '2';
              } ?>">
              <button class="btn btn-outline-secondary" type="submit">
                <?php if (!$hasRequested) { ?>Request to be a candidate
                <?php } else { ?>Cancel Request
                <?php } ?>
              </button>
            </form>
          </div>
        <?php } else if ($isadmin) { ?>
            <div class="row">
              <div class="candbtn col-4 d-flex align-items-center justify-content-center">
                <h3>Total Votes:
                <?php echo $polls['total']; ?>
                </h3>
              </div>
              <div class="candbtn col-4 d-flex align-items-center justify-content-center">
                <form action="requests.php" method="POST">
                  <input type="hidden" name="pollid" value="<?php echo $pollid; ?>">
                  <button type="submit" name="pollbtn" id="pollbtn" class="btn btn-primary">See Requests</button>
                </form>
              </div>
              <div class="terminatebtn col-4 d-flex align-items-center justify-content-center">
                <form action="../api/terminate.php" method="POST">
                  <input type="hidden" name="pollid" value="<?php echo $pollid; ?>">
                  <button type="submit" name="pollbtn" id="terminatebtn" class="btn btn-danger">Terminate Election</button>
                </form>
              </div>
            </div>
        <?php } ?>
      </div>
      <hr class="my-0">
      <?php
      $i = 1;
      while ($row = $cand->fetch_assoc()) {
        $candname = $row['name'];
        $candid = $row['userid'];
        $candphoto = $row['photo'];
        $candvotes = $row['votes'];
        ?>

        <div class="candInfo col-lg-4 my-2 d-flex justify-content-center align-items-center">
          <div class="d-flex candname justify-content-center align-items-center">
            <h4>#
              <?php echo $i . ' : ' . $candname ?>
            </h4>
          </div>
        </div>
        <div class="candInfo col-lg-4 my-2 d-flex justify-content-center align-items-center">
          <?php
          if ($isadmin or $pollvisibility == '1' or ($pollvisibility == '2' && $hasvoted)) {
            ?>
            <div class=" d-flex justify-content-center align-items-center candvotes">
              <h5>Votes:
                <?php echo $candvotes; ?>
              </h5>
            </div>
            <?php
          }
          ?>
        </div>
        <div class="col-lg-4 candimg my-2 d-flex justify-content-center align-items-center">
          <img id="candimg" src="../uploads/<?php echo $candphoto; ?>" alt="candidate picture" width=75>
        </div>
        <?php if (!$isadmin and !$hasRequested and !$isCandidate and !$hasvoted) {
          ?>
          <div class="voteform">
            <form action="../api/vote.php" method="POST">
              <input type="hidden" value="<?php echo $candid ?>" name="candid">
              <input type="hidden" value="<?php echo $pollid ?>" name="pollid">
              <input type="hidden" value="<?php echo $voterid ?>" name="voterid">
              <button type="submit" name="votebtn" class="votebtn btn btn-outline-success" id="votebtn">Vote</button>
            </form>
          </div>
          <?php
        } else if ($hasvoted and $polledit == '2' and $votedto == $candid) {
          ?>
            <div class="voteform">
              <form action="../api/withdrawvote.php" method="POST">
                <input type="hidden" value="<?php echo $candid ?>" name="candid">
                <input type="hidden" value="<?php echo $pollid ?>" name="pollid">
                <input type="hidden" value="<?php echo $voterid ?>" name="voterid">
                <button type="submit" name="votebtn" class="votebtn btn btn-outline-danger" id="votebtn">Cancel Your
                  Vote</button>
              </form>
            </div>
          <?php
        }
        ?>
        <hr class="my-0">
        <?php
        $i++;
      }
      ?>
    </div>
    <div class="col-lg-6 pt-5">
    </div>
  </div>
</body>

</html>