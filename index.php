<?php
require_once 'config.php';

// Fetching all recipes from database - assuming the database is okay
require __DIR__.'/src/models/recipe-model.php';

// Fetching all recipes
$recipes = getAllRecipes();

// Generate the web page
require __DIR__ . '/src/views/indexRecipe.php';
