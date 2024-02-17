<?php
// Include auth_session.php file on all user panel pages
include("auth_session.php");
require("db.php");
include("progress.php");

// Define the stages and their corresponding fields
$stage1Fields = ['gender', 'age'];
$stage2Fields = ['units', 'height_ft', 'height_in', 'weight_kg', 'activity_level', 'weight_goal', 'weekly_variety', 'max_recipe_complexity', 'daily_meals', 'diet_type', 'budget'];

// Process form submission for each stage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stage = $_POST['stage'];
    if ($stage == 1) {
        $username = $_SESSION['username'];
        $sql = "SELECT gender, age FROM users WHERE username = '$username'";
        $result = mysqli_query($con, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['gender'] !== null && $row['age'] !== null) {
                header("Location: profile.php?stage=2");
                exit();
            }
        }
    
        // If gender and age are not set in the database, update the fields
        $updateFields = [];
        foreach ($stage1Fields as $field) {
            $updateFields[] = "$field = '" . $_POST[$field] . "'";
        }
        $updateFieldsStr = implode(", ", $updateFields);
    
        $updateSql = "UPDATE users SET $updateFieldsStr WHERE username = '$username'";
        if (mysqli_query($con, $updateSql)) {
            header("Location: profile.php?stage=2");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    }
    
    
    
    elseif ($stage == 2) {
        foreach ($stage2Fields as $field) {
            $_SESSION[$field] = $_POST[$field];
        }
        // Update the profile if it already exists, otherwise insert a new record
        $username = $_SESSION['username']; // Assuming 'username' is set in auth_session.php
        $gender = $_SESSION['gender'];
        $age = $_SESSION['age'];
        $units = $_SESSION['units'];
        $height_ft = $_SESSION['height_ft'];
        $height_in = $_SESSION['height_in'];
        $weight_kg = $_SESSION['weight_kg'];
        $activity_level = $_SESSION['activity_level'];
        $weight_goal = $_SESSION['weight_goal'];
        $weekly_variety = $_SESSION['weekly_variety'];
        $max_recipe_complexity = $_SESSION['max_recipe_complexity'];
        $daily_meals = implode(', ', $_SESSION['daily_meals']);
        $diet_type = $_SESSION['diet_type'];
        $budget = $_SESSION['budget'];
    
        // Check if the user's profile already exists in the database
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            // Update the existing record
            $updateFields = [];
            if (!empty($gender)) {
                $updateFields[] = "gender = '$gender'";
            }
            if (!empty($age)) {
                $updateFields[] = "age = $age";
            }
            if (!empty($units)) {
                $updateFields[] = "units = '$units'";
            }
            if (!empty($height_ft)) {
                $updateFields[] = "height_ft = $height_ft";
            }
            if (!empty($height_in)) {
                $updateFields[] = "height_in = $height_in";
            }
            if (!empty($weight_kg)) {
                $updateFields[] = "weight_kg = $weight_kg";
            }
            if (!empty($activity_level)) {
                $updateFields[] = "activity_level = '$activity_level'";
            }
            if (!empty($weight_goal)) {
                $updateFields[] = "weight_goal = '$weight_goal'";
            }
            if (!empty($weekly_variety)) {
                $updateFields[] = "weekly_variety = $weekly_variety";
            }
            if (!empty($max_recipe_complexity)) {
                $updateFields[] = "max_recipe_complexity = $max_recipe_complexity";
            }
            if (!empty($daily_meals)) {
                $updateFields[] = "daily_meals = '$daily_meals'";
            }
            if (!empty($diet_type)) {
                $updateFields[] = "diet_type = '$diet_type'";
            }
            if (!empty($budget)) {
                $updateFields[] = "budget = $budget";
            }
    
            $updateFieldsStr = implode(", ", $updateFields);
            $sql = "UPDATE users SET $updateFieldsStr WHERE username = '$username'";
            if (mysqli_query($con, $sql)) {
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($con);
            }
        } else {
            echo "User profile not found.";
        }
    }
    

}

// Get the current stage from the query parameter, default to stage 1
$stage = isset($_GET['stage']) ? intval($_GET['stage']) : 1;
$fields = ($stage == 1) ? $stage1Fields : $stage2Fields;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile Completion - Nutriscape</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="container">
    <h2>Profile Completion - Stage <?php echo $stage; ?>

</h2>
    <form method="post" action="profile.php">
        <?php foreach ($fields as $field): ?>
            <label for="<?php echo $field; ?>"><?php echo ucfirst(str_replace('_', ' ', $field)); ?>:</label><br>
            <?php if ($field === 'gender'): ?>
                <select name="<?php echo $field; ?>" id="<?php echo $field; ?>">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select><br><br>
            <?php elseif ($field === 'units'): ?>
                <input type="radio" name="<?php echo $field; ?>" value="Imperial" id="imperial" checked>
                <label for="imperial">Imperial</label>
                <input type="radio" name="<?php echo $field; ?>" value="Metric" id="metric">
                <label for="metric">Metric</label><br><br>
            <?php elseif ($field === 'activity_level'): ?>
                <select name="<?php echo $field; ?>" id="<?php echo $field; ?>">
                    <option value="Sedentary">Sedentary</option>
                    <option value="Lightly Active">Lightly Active</option>
                    <option value="Moderately Active">Moderately Active</option>
                    <option value="Very Active">Very Active</option>
                    <option value="Super Active">Super Active</option>
                </select><br><br>
            <?php elseif ($field === 'weight_goal'): ?>
                <select name="<?php echo $field; ?>" id="<?php echo $field; ?>">
                    <option value="Lose fat">Lose fat</option>
                    <option value="Build muscle">Build muscle</option>
                    <option value="Maintain weight">Maintain weight</option>
                </select><br><br>
                <?php elseif ($field === 'daily_meals'): ?>
                <input type="checkbox" name="daily_meals[]" value="breakfast" id="breakfast">
                <label for="breakfast">Breakfast</label>
                <input type="checkbox" name="daily_meals[]" value="lunch" id="lunch">
                <label for="lunch">Lunch</label>
                <input type="checkbox" name="daily_meals[]" value="dinner" id="dinner">
                <label for="dinner">Dinner</label>
                <input type="checkbox" name="daily_meals[]" value="snack" id="snack">
                <label for="snack">Snack</label><br><br>
            <?php else: ?>
                <input type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>"><br><br>
            <?php endif; ?>
        <?php endforeach; ?>
        <input type="hidden" name="stage" value="<?php echo $stage; ?>">
        <?php if ($stage == 1): ?>
            <input type="submit" value="Next">
        <?php else: ?>
            <input type="submit" value="Finish">
        <?php endif; ?>
    </form>
</div>
</body>
</html>

