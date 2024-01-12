<h1>List of Recipes</h1>
<ul>
    <?php foreach ($recipes as $recipe): ?>
    <li>
        <a href="show?id=<?= $recipe['id'] ?>">
            <?= $recipe['title'] ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>