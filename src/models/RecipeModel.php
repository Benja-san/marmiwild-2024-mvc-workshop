<?php

namespace App\Models;

use PDO;

class RecipeModel {
     private $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
    }

    public function getAll(): array
    {
        $statement = $this->connection->query('SELECT id, title FROM recipe');
        $recipes = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $recipes;
    }

    public function getById(int $id): array
    {
        $query = 'SELECT title, description FROM recipe WHERE id=:id';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $recipe = $statement->fetch(PDO::FETCH_ASSOC);

        return $recipe;
    }

    public function save(array $recipe): void
    {
        $query = 'INSERT INTO recipe (title, description) VALUES (:titlePlaceholder, :descriptionPlaceholder)';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':titlePlaceholder', $recipe['title'], PDO::PARAM_STR);
        $statement->bindValue(':descriptionPlaceholder', $recipe['description'], PDO::PARAM_STR);
        $statement->execute();
        
    }

    public function edit(array $recipe): void
    {
        $query = 'UPDATE recipe SET title = :title, description = :description WHERE id = :id';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':title', $recipe['title'], PDO::PARAM_STR);
        $statement->bindValue(':description', $recipe['description'], PDO::PARAM_STR);
        $statement->bindValue(':id', $recipe['id'], PDO::PARAM_INT);
        $statement->execute();
    }

    public function delete(int $id): void
    {
        $query = 'DELETE FROM recipe WHERE id = :id';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}