<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
require("db.php");
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
    // Display user data
    $username = $user_data['username'];
    $email = $user_data['email'];
    $create_datetime = $user_data['create_datetime'];
    $gender = $user_data['gender'];
    $age = $user_data['age'];
    $units = $user_data['units'];
    $height_ft = $user_data['height_ft'];
    $height_in = $user_data['height_in'];
    $weight_kg = $user_data['weight_kg'];
    $activity_level = $user_data['activity_level'];
    $weight_goal = $user_data['weight_goal'];
    $weekly_variety = $user_data['weekly_variety'];
    $max_recipe_complexity = $user_data['max_recipe_complexity'];
    $daily_meals = $user_data['daily_meals'];
    $diet_type = $user_data['diet_type'];
    $budget = $user_data['budget'];

     // Calculate BMI
     $height_cm = ($height_ft * 30.48) + ($height_in * 2.54);
     if($height_cm){
      $bmi = round($weight_kg / (($height_cm / 100) * ($height_cm / 100)), 1);

     }


     switch ($activity_level) {
      case 'Sedentary':
          $activity_factor = 1.2;
          break;
      case 'Lightly Active':
          $activity_factor = 1.375;
          break;
      case 'Moderately Active':
          $activity_factor = 1.55;
          break;
      case 'Very Active':
          $activity_factor = 1.725;
          break;
      case 'Super Active':
          $activity_factor = 1.9;
          break;
      default:
          $activity_factor = 1.2;
  }

  switch ($units) {
      case 'Imperial':
          $weight = $weight_kg * 2.20462; // Convert weight to pounds
          $height = $height_cm / 2.54; // Convert height to inches
          break;
      case 'Metric':
          $weight = $weight_kg;
          $height = $height_cm;
          break;
      default:
          $weight = $weight_kg;
          $height = $height_cm;
  }

  if ($gender == 'Male') {
      $bmr = 10 * $weight + 6.25 * $height - 5 * $age + 5;
  } else {
      $bmr = 10 * $weight + 6.25 * $height - 5 * $age - 161;
  }

  $calories_required = round($bmr * $activity_factor);

  // Recommended macronutrient distribution
  switch ($weight_goal) {
      case 'Lose fat':
          $protein_percentage = 30;
          $carb_percentage = 40;
          $fat_percentage = 30;
          break;
      case 'Build muscle':
          $protein_percentage = 40;
          $carb_percentage = 40;
          $fat_percentage = 20;
          break;
      case 'Maintain weight':
          $protein_percentage = 30;
          $carb_percentage = 50;
          $fat_percentage = 20;
          break;
      default:
          $protein_percentage = 30;
          $carb_percentage = 50;
          $fat_percentage = 20;
  }

  $protein_calories = round($calories_required * ($protein_percentage / 100));
  $carb_calories = round($calories_required * ($carb_percentage / 100));
  $fat_calories = round($calories_required * ($fat_percentage / 100));
  function suggestStatus($bmi, $age) {
    if ($bmi < 18.5) {
        return "Underweight";
    } elseif ($bmi >= 18.5 && $bmi < 24.9) {
        return "Normal weight";
    } elseif ($bmi >= 25 && $bmi < 29.9) {
        return "Overweight";
    } elseif ($bmi >= 30) {
        return "Obese";
    } else {
        return "BMI not in standard range";
    }
}

} else {
    echo "User not found.";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>NutriCare</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" type="text/css" href="print.css" media="print">

    <script src="https://kit.fontawesome.com/b8044e56f8.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
  .show_data{
    max-width:700px;
  background-color:#FFEAA7;
  border-radius:15px;
  }
  #greet{
   font-size:20px;
  }
</style>
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
                <a class="nav-link" href="#profile"><i class="fa-regular fa-user me-2"></i>Profile</a>
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

      <div class="d-flex justify-content-center flex-column">

      <div class="container form d-flex justify-content-center flex-column" id="greet">
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

        <div class="show_data m-5 p-3" id="profile">
        <h1>Welcome <?php echo $username; ?>!</h1>
        <p>Email: <?php echo $email; ?></p>
        <p>Joined: <?php echo $create_datetime; ?></p>
        <p>Gender: <?php echo $gender; ?></p>
        <p>Age: <?php echo $age; ?></p>
        <p>Units: <?php echo $units; ?></p>
        <p>Height: <?php echo $height_ft . " ft " . $height_in . " in"; ?></p>
        <p>Weight: <?php echo $weight_kg . " kg"; ?></p>
        <p>Activity Level: <?php echo $activity_level; ?></p>
        <p>Weight Goal: <?php echo $weight_goal; ?></p>
        <p>Weekly Variety: <?php echo $weekly_variety; ?></p>
        <p>Max Recipe Complexity: <?php echo $max_recipe_complexity; ?></p>
        <p>Daily Meals: <?php echo $daily_meals; ?></p>
        <p>Diet Type: <?php echo $diet_type; ?></p>
        <p>Budget: <?php echo $budget; ?></p>
        <br>
        <div class="bg-secondary text-white p-3" id="suggestion">
          <img src="./images/diet_plan_3d.png" height="330px" alt=""> 
          <p>BMI: 
            <?php echo $bmi;
$status = suggestStatus($bmi, $age);
echo "<br>Based on BMI of $bmi and age of $age,<br> the status is: $status";
          ?>
          </p>
        <p>Calories Required: <?php echo $calories_required; ?></p>
        <p>Protein: <?php echo $protein_calories; ?> calories (<?php echo $protein_percentage; ?>%)</p>
        <p>Carbohydrates: <?php echo $carb_calories; ?> calories (<?php echo $carb_percentage; ?>%)</p>
        <p>Fat: <?php echo $fat_calories; ?> calories (<?php echo $fat_percentage; ?>%)</p>

      </div>
      <button class="btn btn-danger mt-2" onclick="printDiv()"><i class="fa-solid fa-print"></i>  Print My Report</button>
      <div>
     <button class="btn btn-info mt-3" onclick="generateRecipes()"><i class="fa-solid fa-kitchen-set"></i>  Suggest Healty Recipes</button>
     <p id="recipes">
<?php include("recipes.php")?>
<img src="images/plate.webp" width="60%" alt="">
     </p>
      </div>
    </div>
</div>

      </div>
<script>
  function generateRecipes(){
location.reload();
  } 
  function printDiv() { 
    var divContents = document.getElementById("suggestion").innerHTML; 
    var a = window.open('', 'My report', 'height=800, width=700'); 
    a.document.write('<html>'); 
    a.document.write('<head><link rel="stylesheet" type="text/css" href="print.css" media="print"></head>'); 
    a.document.write('<body>'); 
    a.document.write(divContents); 
    a.document.write('</body></html>'); 
    a.document.close(); 
    a.print(); 
} 

 
</script>

      <iframe src="footer.html" frameborder="0" class="vw-100 vh-100"></iframe>


</body>
</html>