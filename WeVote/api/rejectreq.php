<html lang="en">

<head>
     <meta charset="UTF-8">
     <title></title>
     <!-- Sweetalert2 CSS-->
     <link rel="stylesheet" href="../vendor/CSS/dark.min.css">
</head>

<body>
     <script src="../vendor/JS/main.js"></script>
     <!-- Sweetalert2 JS-->
     <script src="../vendor/JS/sweetalert2.min.js"></script>
</body>

</html>
<?php
session_start();
include("connection.php");
$reqid = $_POST['reqid'];
$userid = $_POST['userid'];
$pollid = $_POST['pollid'];
$delete = mysqli_query($connect, "delete from requests where id ='$reqid' ");
echo '<script>
            Swal.fire({position: "center",
                icon: "success",
                title: "Request Rejected Successfully!",
                showConfirmButton: false,
                timer: 2000});
                setTimeout(reloadDash, 2000);</script>';
?>