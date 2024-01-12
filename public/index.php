<?php

require __DIR__ . '/../config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>Mon super site</header>
    <main>
        <?php require __DIR__ . '/../src/routing.php'; ?>
    </main>
</body>
</html>
