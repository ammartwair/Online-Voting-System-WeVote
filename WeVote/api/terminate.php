<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>WeVote - Request</title>
  <link rel="stylesheet" href="../vendor/CSS/dark.min.css">
</head>

<body>
  <!-- Custom JS-->
  <script src="../vendor/JS/main.js"></script>
  <!-- Sweetalert2 JS-->
  <script src="../vendor/JS/sweetalert2.min.js"></script>
</body>

</html>
<?php
session_start();
include("connection.php");
if (!isset($_SESSION['id'])) {
  header("location: ../routes/login.php");
}
if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] == false) {
  header("location: ../routes/dashboard.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pollid = $_POST['pollid'];
} else {
  header("location: ../routes/dashboard.php");
}
$cand = mysqli_query($connect, "select * from candidates where pollid = '$pollid'");
$getPoll = mysqli_query($connect, "select * from polls where id = '$pollid'");
if (mysqli_num_rows($getPoll) == 0) {
  header("location: ../routes/dashboard.php");
} else {
  $delvoters = mysqli_query($connect, "delete from voters where pollid = '$pollid'");
  $delcands = mysqli_query($connect, "delete from candidates where pollid = '$pollid'");
  $delreqs = mysqli_query($connect, "delete from requests where pollid = '$pollid'");
  $delpolls = mysqli_query($connect, "delete from polls where id = '$pollid'");
  echo '<script>
        Swal.fire({position: "center",
            icon: "success",
            title: "Election Terminated Successfully",
            showConfirmButton: false,
            timer: 2000});
        setTimeout(reloadDash, 2000);</script>';
}
?>