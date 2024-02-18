<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="login_style.css">
    <script src="https://kit.fontawesome.com/b8044e56f8.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<?php
    require('db.php');
    session_start();
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']); 
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
<div id="container">
  <div id="left">
    <h1 id="welcome">Welcome</h1>
    <p id="lorem">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>
      Vivamus sodales eros non arcu pellentesque convallis.<br>
      Nunc dignissim lectus in malesuada porta.<br>
      Proin ac erat sed urna congue suscipit.<br>
      Morbi aliquet eget nisl id ornare.
    </p>
  </div>
  <div id="right">
    <form class="form" method="post" name="login">
    <h1 id="login">Login</h1><br>
    <input type="text" id="email" class="client-info" name="username" placeholder="username">
    <label for="email">Username</label>
    <input type="password" id="password" class="client-info" name="password" placeholder="password">
    <label for="password">Password</label>
    <input type="submit" id="submit" class="client-info" value="Login">
    <p class="text-center">You don't have an account?<a class="client-info pt-2" id="submit" href="registration.php">Sign up</a></p>
    
</form>

  </div>
</div>

    
        <!-- <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php">New Registration</a></p> -->
  
<?php
    }
?>
</body>
</html>