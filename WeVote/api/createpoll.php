<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>WeVote - Create a poll</title>
    <!-- Sweetalert2 CSS-->
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
if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] == false) {
    header("location: ../");
}
$title = $_POST['title'];
$desc = $_POST['desc'];
$visibility = $_POST['visibility'];
if (isset($_POST['candidate1'])) {
    $candidate1 = $_POST['candidate1'];
} else {
    $candidate1 = '';
}
if (isset($_POST['candidate1'])) {
    $candidate2 = $_POST['candidate2'];
} else {
    $candidate2 = '';
}
$editVote = $_POST['editVote'];
$check = mysqli_query($connect, "select * from polls where title='$title' ");

if (mysqli_num_rows($check) > 0) {
    $_SESSION['index'] = true;
    $_SESSION['title'] = $title;
    $_SESSION['desc'] = $desc;
    $_SESSION['visibility'] = $visibility;
    $_SESSION['editVote'] = $editVote;
    $_SESSION['candidate1'] = $candidate1;
    $_SESSION['candidate2'] = $candidate2;
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid credentials",
            text: "This poll title already exists",
            showConfirmButton: false
          });
          setTimeout(reloadpoll, 2500);
            </script>';

} else if (($visibility != '1' and $visibility != '2' and $visibility != '3') or ($editVote != '1' and $editVote != '2')) {
    $_SESSION['index'] = true;
    $_SESSION['title'] = $title;
    $_SESSION['desc'] = $desc;
    $_SESSION['visibility'] = $visibility;
    $_SESSION['editVote'] = $editVote;
    $_SESSION['candidate1'] = $candidate1;
    $_SESSION['candidate2'] = $candidate2;
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid credentials",
            text: "Please fill all fields",
            showConfirmButton: false
          });
          setTimeout(reloadpoll, 2500);
            </script>';

} else {
    $checkcand1 = mysqli_query($connect, "select * from user where username ='$candidate1'");
    $checkcand2 = mysqli_query($connect, "select * from user where username ='$candidate2'");
    $checkadmin1 = mysqli_fetch_array($checkcand1);
    $checkadmin2 = mysqli_fetch_array($checkcand2);
    if (mysqli_num_rows($checkcand1) == 0 or mysqli_num_rows($checkcand2) == 0) {
        $_SESSION['index'] = true;
        $_SESSION['candidate1'] = $candidate1;
        $_SESSION['candidate2'] = $candidate2;
        $_SESSION['title'] = $title;
        $_SESSION['desc'] = $desc;
        $_SESSION['visibility'] = $visibility;
        $_SESSION['editVote'] = $editVote;
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Invalid credentials",
                text: "Check Candidates\' Usernames",
                showConfirmButton: false
              });
              setTimeout(reloadpoll, 2500);
                </script>';

    } else if ($checkadmin1['isadmin'] == 1 or $checkadmin2['isadmin'] == 1) {
        $_SESSION['index'] = true;
        $_SESSION['candidate1'] = $candidate1;
        $_SESSION['candidate2'] = $candidate2;
        $_SESSION['title'] = $title;
        $_SESSION['desc'] = $desc;
        $_SESSION['visibility'] = $visibility;
        $_SESSION['editVote'] = $editVote;
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Invalid credentials",
                text: "An admin cannot be a candidate",
                showConfirmButton: false
              });
              setTimeout(reloadpoll, 2500);
                </script>';

    } else {
        /* insert poll values into polls table */
        $insert = mysqli_query($connect, "insert into polls (title, description, editvote, visibility, total) values('$title', '$desc' , '$editVote' , '$visibility', 0) ");
        /* get poll id from polls table */
        $getId = mysqli_query($connect, "select id from polls where title='$title'");
        $row = mysqli_fetch_array($getId);
        $getId = $row['id'];
        /* insert candidates values into Candidates table */
        $getcand1 = mysqli_query($connect, "select * from user where username ='$candidate1'");
        $cand1Row = mysqli_fetch_array($getcand1);
        $cand1id = $cand1Row['id'];
        $cand1name = $cand1Row['name'];
        $cand1photo = $cand1Row['photo'];
        $insert1 = mysqli_query($connect, "insert into candidates (pollid , userid , name , photo ,votes) values ('$getId' , '$cand1id','$cand1name','$cand1photo', 0 ) ");

        $getcand2 = mysqli_query($connect, "select * from user where username ='$candidate2'");
        $cand2Row = mysqli_fetch_array($getcand2);
        $cand2id = $cand2Row['id'];
        $cand2name = $cand2Row['name'];
        $cand2photo = $cand2Row['photo'];
        $insert2 = mysqli_query($connect, "insert into candidates (pollid , userid , name , photo ,votes) values ('$getId' , '$cand2id','$cand2name','$cand2photo', 0 ) ");

        echo '<script>
        Swal.fire({position: "center",
            icon: "success",
            title: "Creating Poll Successful!",
            showConfirmButton: false,
            timer: 2000});
            setTimeout(goBack, 2000);</script>';
    }
}
?>