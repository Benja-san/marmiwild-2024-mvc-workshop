<form method="POST">
    <?php if(isset($_GET['id'])) : ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
    <?php endif ?>
    <label for="title">Votre titre</label>
    <input type="text" id="title" name="title" required value="<?php echo $recipe['title'] ?? '' ?>" />
    <label for="description">Votre description</label>
    <textarea id="description" name="description" required><?php echo $recipe['description'] ?? '' ?></textarea>
    <button type="submit">
        <?php echo isset($_GET['id']) ? "Modifier la recette" : "Ajouter la recette" ?>
    </button>
</form>