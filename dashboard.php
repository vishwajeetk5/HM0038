<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/b8044e56f8.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3 p-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Nutriscape</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-md-auto gap-2">
            <li class="nav-item rounded">
                <a class="nav-link" href="login.php"><i class=" me-2"></i>Profile</a>
              </li>
              <li class="nav-item rounded">
                <a class="nav-link active" aria-current="page" href="#"><i class="fa fa-solid fa-house me-2"></i>Home</a>
              </li>
              <li class="nav-item rounded">
                <a class="nav-link" href="#"><i class="bi bi-people-fill me-2"></i>About</a>
              </li>
              <li class="nav-item rounded"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="vh-100 d-flex justify-content-center align-items-center">
        <h2>Main Content</h2>

      </div>
      <div class="bg-dark text-white">
        <p class="text-center p-4 m-0">Footer Content</p>
      </div>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p>You are now user dashboard page.</p>
        <p><a href="logout.php">Logout</a></p>
    </div>


</body>
</html>