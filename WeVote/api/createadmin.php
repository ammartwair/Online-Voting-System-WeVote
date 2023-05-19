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
if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] == false) {
    header("location: ../routes/login.php");
}
$useradmin = $_POST['useradmin'];
$usercheck = mysqli_query($connect, "select * from user where username ='$useradmin'");
if (mysqli_num_rows($usercheck) == 0) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid credentials",
            text: "No user found !",
            showConfirmButton: false
          });
          setTimeout(reloadProf, 2500);
            </script>';
} else {
    $user = mysqli_fetch_array($usercheck);
    $userid = $user['id'];
    if ($user['isadmin'] == 1) {
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid credentials",
            text: "This user is an admin already",
            showConfirmButton: false
          });
          setTimeout(reloadProf, 2500);
            </script>';
    } else {
        $checkcand = mysqli_query($connect, "select * from candidates where userid = '$userid'");
        if (mysqli_num_rows($checkcand) > 0) {
            echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid credentials",
            text: "This user is a candidate in an election",
            showConfirmButton: false
          });
          setTimeout(reloadProf, 2500);
            </script>';
        } else {
            $checkcvote = mysqli_query($connect, "select * from voters where userid = '$userid'");
            if (mysqli_num_rows($checkcvote) > 0) {
                echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid credentials",
            text: "This user has a vote in an election",
            showConfirmButton: false
          });
          setTimeout(reloadProf, 2500);
            </script>';
            } else {
                $update_user = mysqli_query($connect, "update user set isadmin = '1' where id='$userid' ");
                echo '<script>
    Swal.fire({position: "center",
        icon: "success",
        title: "New Admin Has Been Added!",
        showConfirmButton: false,
        timer: 2000});
        setTimeout(reloadDash, 2000);</script>';
            }
        }
    }
}
?>