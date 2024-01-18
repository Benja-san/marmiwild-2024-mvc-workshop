<h1>List of Recipes</h1>
<ul>
    <?php foreach ($recipes as $recipe): ?>
    <li>
        <a href="show?id=<?= $recipe['id'] ?>">
            <?= $recipe['title'] ?>
        </a>
        <a href="edit?id=<?= $recipe['id'] ?>">
            <?= "edit " . $recipe['title'] ?>
        </a>
        <a href="delete?id=<?= $recipe['id'] ?>">
            <?= "supprimer " . $recipe['title'] ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
<a href="add">Add recipe</a>