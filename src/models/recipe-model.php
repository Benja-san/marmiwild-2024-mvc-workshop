<?php 

function createConnection(): PDO
{
    return new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
}

function getAllRecipes(): array
{
    $connection = createConnection();

    $statement = $connection->query('SELECT id, title FROM recipe');
    $recipes = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $recipes;
}

function getRecipeById(int $id): array
{
    $connection = createConnection();

    $query = 'SELECT title, description FROM recipe WHERE id=:id';
    $statement = $connection->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $recipe = $statement->fetch(PDO::FETCH_ASSOC);

    return $recipe;
}

function saveRecipe(array $recipe): void
{
    $connection = createConnection();

    $query = 'INSERT INTO recipe (title, description) VALUES (:titlePlaceholder, :descriptionPlaceholder)';
    $statement = $connection->prepare($query);
    $statement->bindValue(':titlePlaceholder', $recipe['title'], PDO::PARAM_STR);
    $statement->bindValue(':descriptionPlaceholder', $recipe['description'], PDO::PARAM_STR);
    $statement->execute();
    
}