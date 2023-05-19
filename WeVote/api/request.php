<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>WeVote - Request</title>
    <link rel="stylesheet" href="../vendor/CSS/dark.min.css">
</head>

<body>
    <!-- Custom JS-->
    <script src="../vendor/JS/createpoll.js"></script>
    <!-- Sweetalert2 JS-->
    <script src="../vendor/JS/sweetalert2.min.js"></script>
</body>

</html>
<?php
session_start();
include("connection.php");
if (!isset($_SESSION['id'])) {
    header("location: login.php");
}
if (!isset($_POST['pollid'])) {
    header("location: polls.php");
}
$pollid = $_POST['pollid'];
$userid = $_POST['userid'];
$reqtype = $_POST['reqtype'];
if ($reqtype == '1') {
    $insert = mysqli_query($connect, "insert into requests (userid,pollid) values('$userid','$pollid') ");
    $delete = false;
} else {
    $insert = false;
    $delete = mysqli_query($connect, "delete from requests where userid = '$userid' and pollid = '$pollid' ");
}

if ($insert) {
    echo '<script>
        Swal.fire({position: "center",
            icon: "success",
            title: "Request Sent Successfully",
            showConfirmButton: false,
            timer: 2000});
        setTimeout(goBack, 2000);</script>';
}
if ($delete) {
    echo '<script>
        Swal.fire({position: "center",
            icon: "success",
            title: "Request Cancelled Successfully",
            showConfirmButton: false,
            timer: 2000});
        setTimeout(goBack, 2000);</script>';
}
?>