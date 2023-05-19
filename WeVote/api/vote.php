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
$candid = $_POST['candid'];
$voterid = $_POST['voterid'];
$pollid = $_POST['pollid'];
$data = $_SESSION['data'];
$votername = $data['name'];
$usercheck = mysqli_query($connect, "select * from voters where userid='$voterid' and pollid = '$pollid'");
if (mysqli_num_rows($usercheck) > 0) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid credentials",
            text: "You can vote only one time per poll",
            showConfirmButton: false
          });
          setTimeout(reloadpolls, 2500);
            </script>';
} else {
    $update_votes = mysqli_query($connect, "update candidates set votes=votes + 1 where userid='$candid' and pollid='$pollid' ");

    $update_total = mysqli_query($connect, "update polls set total=total + 1 where id='$pollid' ");

    $insertVoter = mysqli_query($connect, "insert into voters(name , userid , pollid, candid) values ( '$votername', '$voterid' ,'$pollid','$candid')");

    if ($update_votes and $update_total and $insertVoter) {
        echo '<script>
            Swal.fire({position: "center",
                icon: "success",
                title: "Voting Successful!",
                showConfirmButton: false,
                timer: 2000});
                setTimeout(reloadDash, 2000);</script>';
    } else {
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Operation failed",
            text: "Voting unsuccessful!",
            showConfirmButton: false
          });
          setTimeout(reloadDash, 2000);</script>';
    }
}
?>