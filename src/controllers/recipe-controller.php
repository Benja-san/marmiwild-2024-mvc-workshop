<?php

require __DIR__ . '/../models/recipe-model.php';

function browseRecipes(): void
{
    $recipes = getAllRecipes();

    require __DIR__ . '/../views/indexRecipe.php';
}

function showRecipe( ?string $id) : void
{
    if(!$id){
        header('HTTP/1.1 404 Not Found');
        exit;
    }

    $recipe = getRecipeById($id);

    require __DIR__ . '/../views/showRecipe.php';

}

function addrecipe() : void
{
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
            exit;
        }
    }
    require __DIR__ . '/../views/form.php';
}
