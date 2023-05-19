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
$image = $_FILES['file-input']['name'];
$tmp_name = $_FILES['file-input']['tmp_name'];
if ($cpass != $pass) {
    $_SESSION['index'] = true;
    $_SESSION['name'] = $name;
    $_SESSION['username'] = $username;
    $_SESSION['mobile'] = $mobile;
    $_SESSION['prefix'] = $prefix;
    $_SESSION['password'] = '';
    $_SESSION['add'] = $add;
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid credentials",
            text: "The Passwords do not match",
            showConfirmButton: false
          });
          setTimeout(reloadReg, 2500);
            </script>';
} else {
    $check = mysqli_query($connect, "select * from user where username='$username' ");
    if (mysqli_num_rows($check) > 0) {
        $_SESSION['index'] = true;
        $_SESSION['name'] = $name;
        $_SESSION['username'] = '';
        $_SESSION['mobile'] = $mobile;
        $_SESSION['password'] = $pass;
        $_SESSION['prefix'] = $prefix;
        $_SESSION['add'] = $add;
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid credentials",
            text: "This username is already taken",
            showConfirmButton: false
          });
          setTimeout(reloadReg, 2500);
            </script>';
    } else {
        $img_ex = pathinfo($image, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");
        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = '../uploads/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
            $password = password_hash($pass, PASSWORD_DEFAULT);
            $insert = mysqli_query($connect, "insert into user (name, username, mobile, prefix, password, address, photo, isadmin) values('$name', '$username' , '$mobile', '$prefix' ,'$password', '$add', '$new_img_name', 0) ");
            if ($insert) {
                echo '<script>
            Swal.fire({position: "center",
                icon: "success",
                title: "Registration Successful!",
                showConfirmButton: false,
                timer: 2000});
                setTimeout(goBack, 2000);</script>';
            }
        } else {
            $_SESSION['index'] = true;
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
            $_SESSION['mobile'] = $mobile;
            $_SESSION['password'] = $pass;
            $_SESSION['prefix'] = $prefix;
            $_SESSION['add'] = $add;
            echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid credentials",
            text: "This File is not supprted ",
            showConfirmButton: false
          });
          setTimeout(reloadReg, 2500);
            </script>';

        }
    }
}
?>