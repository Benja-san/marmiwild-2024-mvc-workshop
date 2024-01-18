<?php

namespace App\Controllers;

use App\Models\RecipeModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class RecipeController
{
    private $model;
    private Environment $twig;

    public function __construct()
    {
        $this->model = new RecipeModel();
        $loader = new FilesystemLoader(__DIR__ . '/../Views/');
        $this->twig = new Environment($loader, [
            'debug' => true
        ]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    public function browse(): string
    {
        $recipes = $this->model->getAll();

        return $this->twig->render('indexRecipe.html.twig', [
            'recipes' => $recipes
        ]);
    }

    public function show( ?string $id) : string
    {
        if(!$id){
            header('HTTP/1.1 404 Not Found');
            exit;
        }

        $recipe = $this->model->getById($id);

        return $this->twig->render('showRecipe.html.twig', [
            'recipe' => $recipe
        ]);

    }

    public function add() : string
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
        return $this->twig->render('form.html.twig', [
            'errors' => $errors
        ]);
    }

    public function modify(?string $id) : string
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

        return $this->twig->render('form.html.twig', [
            'errors' => $errors,
            'recipe' => $recipe,
            'id' => $_GET['id']
        ]);
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