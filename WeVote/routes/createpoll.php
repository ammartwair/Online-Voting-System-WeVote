<?php
session_start();
if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] == false) {
  header("location: dashboard.php");
}
if (isset($_SESSION['index'])) {
  if ($_SESSION['index'] == true) {
    $title = $_SESSION['title'];
    $desc = $_SESSION['desc'];
    $visibility = $_SESSION['visibility'];
    $editVote = $_SESSION['editVote'];
    $candidate1 = $_SESSION['candidate1'];
    $candidate2 = $_SESSION['candidate2'];
  } else {
    $title = '';
    $desc = '';
    $visibility = '0';
    $editVote = '0';
    $candidate1 = '';
    $candidate2 = '';
  }
} else {
  $title = '';
  $desc = '';
  $visibility = '0';
  $editVote = '0';
  $candidate1 = '';
  $candidate2 = '';
}
$_SESSION['index'] = false;
$data = $_SESSION['data'];
$img = $data['photo'];
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>WeVote - Create Election</title>
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
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
  <div class="pollheader pt-5">
    <div class="createPoll col-lg-5 mx-4">
      <form action="../api/createpoll.php" class="pt-5" method="POST" autocomplete="off">
        <div class="row">
          <label class="col-lg-2">Title:</label>
          <div class="firstinput col-lg-10">
            <input id="polltitle" type="text" value='<?php echo $title ?>' name="title" class="logininput form-control"
              required>
            <span class="focus-100">
              <i id="fatitle" class="fa-solid fa-square-poll-horizontal fa-xl"></i>
            </span>
          </div>
          <div class="small text-danger" id="titleAlert"><span>Use 4 to 15 characters</span></div>
        </div>
        <span id="descShowHide"><i id="plusdesc" class="fa-solid fa-plus"></i><i id="minusdesc"
            class="fa-solid fa-minus"></i> Add Description about your event (optional)</span>
        <div class="firstinput" id="optionaldesc">
          <input id="polldesc" type="text" value='<?php echo $desc ?>' name="desc" class="logininput form-control">
          <span class="focus-100"></span>
        </div><br>
        <label class="mt-2">Candidates :</label>
        <div id="candcontainer">
          <div class="firstinput">
            <span>1- </span><input id="candidate1" type="text" value="<?php echo $candidate1 ?>" name="candidate1"
              class="logininput form-control" required>
            <span class="focus-100"></span>
          </div>
          <div class="small text-danger" id="cand1alert"><span>Use 4 to 15 characters starting with a small
              letter</span></div>
          <div class="firstinput">
            <span>2- </span><input id="candidate2" type="text" value="<?php echo $candidate2 ?>" name="candidate2"
              class="logininput form-control" required>
            <span class="focus-100"></span>
          </div>
          <div class="small text-danger" id="cand2alert"><span>Use 4 to 15 characters starting with a small
              letter</span></div>
        </div>
        <label>Results Visibilty :</label>
        <select name="visibility" id="visibility" class="form-select mt-2" required>
          <option value="" <?php if ($visibility == '0') {
            echo 'selected';
          } ?> disabled>Select one</option>
          <option value="1" <?php if ($visibility == '1') {
            echo 'selected';
          } ?>>Always public</option>
          <option value="2" <?php if ($visibility == '2') {
            echo 'selected';
          } ?>>Public after voting</option>
          <option value="3" <?php if ($visibility == '3') {
            echo 'selected';
          } ?>>Not public</option>
        </select><br>
        <div class="d-flex align-items-center justify-content-evenly">
          <label>Edit Vote Right :</label>
          <ul class="radio-switch ">
            <li class="radio-switch__item">
              <input class="radio-switch__input ri5-sr-only" type="radio" name="editVote" id="radio-1" value="1" <?php if ($editVote != '2')
                echo 'checked'; ?> required>
              <label class="radio-switch__label" for="radio-1">Prevent</label>
            </li>
            <li class="radio-switch__item">
              <input class="radio-switch__input ri5-sr-only" type="radio" name="editVote" id="radio-2" value="2" <?php if ($editVote == '2')
                echo 'checked'; ?>>
              <label class="radio-switch__label" for="radio-2">Allow</label>
              <div aria-hidden="true" class="radio-switch__marker"></div>
            </li>
          </ul>
        </div><br>
        <input type="hidden" id="hidtitle" value='<?php echo $title; ?>'>
        <input type="hidden" id="hidcand1" value='<?php echo $candidate1; ?>'>
        <input type="hidden" id="hidcand2" value='<?php echo $candidate2; ?>'>
        <button type="submit" name="createbtn" id="createbtn" class="btn btn-outline-secondary" disabled>Create</button>
      </form>
    </div>
  </div>
  <script src="../vendor/JS/createpoll.js"></script>
</body>

</html>