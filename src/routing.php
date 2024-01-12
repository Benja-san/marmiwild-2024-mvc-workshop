<?php

require __DIR__ . '/controllers/recipe-controller.php';

$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

match($urlPath) {
    '/' => browseRecipes(),
    '/show' => showRecipe($_GET['id'] ?? null),
    '/add' => addRecipe(),
    default => header('HTTP/1.1 404 Not Found')
};