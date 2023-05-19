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
$username = $_POST['username'];
$password = $_POST['password'];
$check = mysqli_query($connect, "select * from user where username='$username' ");
if (mysqli_num_rows($check) > 0) {
    $data = mysqli_fetch_array($check);
    if (password_verify($password, $data['password'])) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['data'] = $data;
        if ($data['isadmin'] == '1') {
            $isadmin = true;
            $_SESSION['isadmin'] = true;
        } else {
            $isadmin = false;
            $_SESSION['isadmin'] = false;
        }
        echo '<script>
                location = "../routes/dashboard.php";
            </script>';
    } else {
        $_SESSION['index'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = '';
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid credentials",
            text: "You entered an incorrect Password",
            showConfirmButton: false,
            timer: 2000
          });
          setTimeout(gologin, 2000);
          </script>';

    }
} else {
    $_SESSION['index'] = true;
    $_SESSION['username'] = '';
    $_SESSION['password'] = '';
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid credentials",
            text: "No username Found",
            showConfirmButton: false,
            timer: 2000
          });
          setTimeout(gologin, 2000);
          </script>';
}
?>