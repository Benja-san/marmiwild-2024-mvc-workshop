<?php

use App\Controllers\RecipeController;

$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$recipeController = new RecipeController();

echo match($urlPath) {
    '/' => $recipeController->browse(),
    '/show' => $recipeController->show($_GET['id'] ?? null),
    '/add' => $recipeController->add(),
    '/edit' => $recipeController->modify($_GET['id'] ?? null),
    '/delete' => $recipeController->suppress($_GET['id'] ?? null),
    default => header('HTTP/1.1 404 Not Found')
};