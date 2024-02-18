<?php
        // Sample Indian recipes data
        $indianRecipes = [
          ['name' => 'Tandoori Chicken', 'calories' => 250, 'protein' => 30, 'carbs' => 5, 'fat' => 12],
          ['name' => 'Khichdi', 'calories' => 300, 'protein' => 10, 'carbs' => 50, 'fat' => 5],
          ['name' => 'Moong Dal Soup', 'calories' => 150, 'protein' => 8, 'carbs' => 25, 'fat' => 3],
          ['name' => 'Methi Thepla', 'calories' => 200, 'protein' => 5, 'carbs' => 30, 'fat' => 8],
          ['name' => 'Palak Dal', 'calories' => 250, 'protein' => 12, 'carbs' => 30, 'fat' => 8],
          ['name' => 'Sprout Salad', 'calories' => 150, 'protein' => 10, 'carbs' => 20, 'fat' => 5],
          ['name' => 'Ragi Dosa', 'calories' => 200, 'protein' => 6, 'carbs' => 35, 'fat' => 4],
          ['name' => 'Vegetable Upma', 'calories' => 250, 'protein' => 7, 'carbs' => 40, 'fat' => 6],
          ['name' => 'Cabbage Thoran', 'calories' => 150, 'protein' => 5, 'carbs' => 20, 'fat' => 4],
          ['name' => 'Masala Oats', 'calories' => 200, 'protein' => 6, 'carbs' => 30, 'fat' => 5],
          // Add more healthy recipes as needed
      ];
      

// Function to get a random Indian recipe suggestion
function getRandomIndianRecipe($indianRecipes) {
  $index = array_rand($indianRecipes);
  return $indianRecipes[$index];
}

// Get a random Indian recipe suggestion
$indianRecipeSuggestion = getRandomIndianRecipe($indianRecipes);

// Display the Indian recipe suggestion
echo '<h2>Indian Recipe Suggestion:</h2>';
echo '<p>Name: ' . $indianRecipeSuggestion['name'] . '</p>';
echo '<p>Calories: ' . $indianRecipeSuggestion['calories'] . '</p>';
echo '<p>Protein: ' . $indianRecipeSuggestion['protein'] . 'g</p>';
echo '<p>Carbs: ' . $indianRecipeSuggestion['carbs'] . 'g</p>';
echo '<p>Fat: ' . $indianRecipeSuggestion['fat'] . 'g</p>';

        ?>