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

$name = $_POST['name'];
$username = $_POST['username'];
$mobile = $_POST['mob'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];
$add = $_POST['add'];
$prefix = $_POST['prefix'];
$id = $_SESSION['id'];
$data = $_SESSION['data'];
if ($pass != $cpass) {
    $_SESSION['index'] = true;
    $_SESSION['name'] = $name;
    $_SESSION['username'] = $username;
    $_SESSION['mobile'] = $mobile;
    $_SESSION['pass'] = '';
    $_SESSION['add'] = $add;
    $_SESSION['prefix'] = $prefix;
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Passwords do not match",
            showConfirmButton: false,
            timer: 2000
          });
          setTimeout(goBackEdit, 2000);
          </script>';

}
if ($data['username'] != $username) {
    $checkinput = mysqli_query($connect, "select * from user where username = '$username'");
    if (mysqli_num_rows($checkinput) > 0) {
        $_SESSION['index'] = true;
        $_SESSION['name'] = $name;
        $_SESSION['username'] = '';
        $_SESSION['mobile'] = $mobile;
        $_SESSION['pass'] = $pass;
        $_SESSION['add'] = $add;
        $_SESSION['prefix'] = $prefix;
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "This username is already taken",
            showConfirmButton: false,
            timer: 2000
          });
          setTimeout(goBackEdit, 2000);
          </script>';

    }
}
if ($pass == '') {
    $update = mysqli_query($connect, "update user set name='$name', username='$username' ,mobile='$mobile', prefix='$prefix' , address='$add' where id='$id' ");
    if ($update) {
        $check = mysqli_query($connect, "select * from user where id='$id' ");
        $data = mysqli_fetch_array($check);
        $_SESSION['id'] = $data['id'];
        $_SESSION['data'] = $data;
        echo '<script>
        Swal.fire({position: "center",
            icon: "success",
            title: "Updated Successfully",
            showConfirmButton: false,
            timer: 2000});
            setTimeout(reloadDash, 2000);</script>';
    }
} else {
    $newPass = password_hash($pass, PASSWORD_DEFAULT);
    $update = mysqli_query($connect, "update user set name='$name', username='$username' ,mobile='$mobile', password='$newPass' ,prefix='$prefix' , address='$add' where id='$id' ");
    if ($update) {
        $check = mysqli_query($connect, "select * from user where id='$id' ");
        $data = mysqli_fetch_array($check);
        $_SESSION['id'] = $data['id'];
        $_SESSION['data'] = $data;
        echo '<script>
        Swal.fire({position: "center",
            icon: "success",
            title: "Updated Successfully",
            showConfirmButton: false,
            timer: 2000});
            setTimeout(reloadDash, 2000);</script>';
    }

}
?>