<?php

require_once 'config.php';
require __DIR__ . '/src/models/recipe-model.php';

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $recipe = [];
    foreach($_POST as $key => $value) {
        $recipe[$key] = htmlentities(trim((string) $value));
        if(empty($recipe[$key])){
            $errors[$key] = "Veuillez remplir le champ $key";
        }
        if(strlen($recipe[$key]) > 255 && $key === 'title'){
            $errors[$key] = "Votre titre est trop long";
        }
    }

    if (empty($errors)) {
        saveRecipe($recipe);
        header('Location: /');
    }
}

require __DIR__ . '/src/views/form.php';