<?php

require __DIR__ . '/../models/RecipeModel.php';


class RecipeController
{
    private $model;

    public function __construct()
    {
        $this->model = new RecipeModel();
    }

    public function browse(): void
    {
        $recipes = $this->model->getAll();

        require __DIR__ . '/../views/indexRecipe.php';
    }

    public function show( ?string $id) : void
    {
        if(!$id){
            header('HTTP/1.1 404 Not Found');
            exit;
        }

        $recipe = $this->model->getById($id);

        require __DIR__ . '/../views/showRecipe.php';

    }

    public function add() : void
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
                $this->model->save($recipe);
                header('Location: /');
                exit;
            }
        }
        require __DIR__ . '/../views/form.php';
    }

    public function modify(?string $id) : void
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
                $this->model->edit($recipe);
                header('Location: /show?id='.$recipe['id']);
                exit;
            }
        }

        if(!$id){
            header('HTTP/1.1 404 Not Found');
            exit;
        }

        $recipe = $this->model->getById($id);

        require __DIR__ . '/../views/form.php';
    }

    public function suppress(?string $id) : void
    {

        if(!$id){
            header('HTTP/1.1 404 Not Found');
            exit;
        }

        $this->model->delete($id);

        header('Location: /');
    }

}