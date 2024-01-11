<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="add.php" method="POST">
        <label for="title">Votre titre</label>
        <input type="text" id="title" name="title" required />
        <label for="description">Votre description</label>
        <textarea id="description" name="description" required></textarea>
        <button type="submit">Ajouter la recette</button>
    </form>
</body>
</html>