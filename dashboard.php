<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
require("db.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>NutriCare</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/b8044e56f8.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3 p-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">NutriCare</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-md-auto gap-2">
            <li class="nav-item rounded">
                <a class="nav-link" href="login.php"><i class="fa-regular fa-user me-2"></i>Profile</a>
              </li>
              <li class="nav-item rounded">
                <a class="nav-link active" aria-current="page" href=""><i class="fa fa-solid fa-house me-2"></i>Home</a>
              </li>
              <li class="nav-item rounded">
                <a class="nav-link" href="About"><i class="fa-solid fa-feather me-2"></i>About</a>
              </li>
              <li class="nav-item rounded"><a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- Navbar ends -->

      <div class="vh-100 d-flex justify-content-center flex-column">

      <div class="container form">
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p>You are now on user dashboard page.</p>
    </div>


      <!-- Progress bar goes here -->
      <?php
      include('progress.php')?>
      <!-- Gives completionPercentage -->
      <div class="container">
  <h2>Profile Completeness <?php echo " ".$completionPercentage ?></h2>
  <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:    <?php echo $completionPercentage ?>%">
      <span class="sr-only"><?php echo $completionPercentage ?>% Complete</span>
    </div>
  </div>
  <?php if ($completionPercentage <100): ?>
        <p>Your profile is not complete. <a href="profile.php?stage=1">Complete it now</a></p>
        <?php endif; ?>
</div>

    </div>
      <div class="bg-dark text-white">
    
      </div>

      <iframe src="footer.html" frameborder="0" class="vw-100 vh-100"></iframe>

</body>
</html>