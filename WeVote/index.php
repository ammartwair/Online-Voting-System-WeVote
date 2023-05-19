<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>WeVote</title>
  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Fira+Sans&family=Germania+One&family=Playfair+Display:ital@0;1&family=Poppins:wght@500&family=Supermercado+One&family=Tajawal:wght@400;500;700&display=swap"
    rel="stylesheet">
  <!-- Bootstrap -->
  <link href="vendor/CSS/bootstrap.min.css" rel="stylesheet">
  <!-- Fontawesome -->
  <link href="vendor/CSS/all.min.css" rel="stylesheet">
  <!-- Custom CSS-->
  <link rel="stylesheet" href="css/stylesheet.css">
  <!-- Custom CSS-->
  <link href="css/sos.css" rel="stylesheet">
  <!-- Media CSS-->
  <link href="css/media.css" rel="stylesheet">
</head>

<body>
  <!-- Start Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light pt-2 row fixed-top" id="navbar">
    <div class="navimg col-4 col-lg-6 row px-5">
      <a class="navbar-brand" href="../">
        <img src="../img/logo-wevote-a-colores.png" alt="logo">
      </a>
    </div>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 col-8 col-lg-6 row">
      <div class="col-lg-4"></div>
      <a href="routes/login.php" class="col-4">
        <div class="btn-hover color-7 rounded-pill px-2 py-2 mx-3 d-flex align-items-center justify-content-evenly">
          <span class="text-capitalize px-2">Log in</span>
        </div>
      </a>
      <a href="routes/register.php" class="col-4">
        <div class="btn-hover color-7 rounded-pill px-2 py-2 mx-3 d-flex align-items-center justify-content-evenly">
          <span class="text-capitalize px-2">Register</span>
        </div>
      </a>
    </ul>
  </nav>
  <!-- End Navbar -->
  <!-- Start Header -->
  <header class="header" id="header">
    <div class="container">
      <div class="d-flex innerheader align-items-center justify-content-end  vh-100">
        <div class="header-content text-end">
          <h1>WE VOTE</h1>
          <p>CERTIFIED ELECTRONIC VOTING SERVICE</p>
        </div>
      </div>
    </div>
  </header>
  <!-- End Header -->
  <!-- Start Footer -->
  <footer class="footer py-4" id="footer">
    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-md-4 text-center copy">
           2023 All Rights Reserved.
        </div>
        <div class="col-md-4 text-center">
          <img src="img/logo-wevote-a-colores.png" alt="#" height=60px>
        </div>
        <div class="col-md-4 text-center ">
          <p class="mdby mb-0">Made By Ammar Twair</p>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <script src="vendor/JS/index.js"></script>
</body>
</html>