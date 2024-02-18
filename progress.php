      <?php
$username = $_SESSION['username'];
$sql = "SELECT gender, age, units, height_ft, height_in, weight_kg, activity_level, weight_goal, weekly_variety, max_recipe_complexity, daily_meals, diet_type, budget FROM users WHERE username = '$username'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
   $requiredFields = ['gender', 'age', 'units', 'height_ft', 'height_in', 'weight_kg', 'activity_level', 'weight_goal', 'weekly_variety', 'max_recipe_complexity', 'daily_meals', 'diet_type', 'budget'];
    $completedFields = array_reduce($requiredFields, function ($carry, $field) use ($row) {
        return $carry + (!empty($row[$field]) ? 1 : 0);
    }, 0);
    $completionPercentage = round($completedFields / count($requiredFields) * 100);

} else {
    echo "User profile not found.";
}
?>