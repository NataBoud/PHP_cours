<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Superglobales</title>
</head>

<body>
<div>
    <h2>Les superglobales en PHP</h2>
    <p>$_GET et $_POST sont des variables superglobales. On va les utiliser pour récupérer des valeurs dans l'URL ou dans un formulaire</p>

    <?php
    // $_GET est un tableau qui conient les paramètres de l'URL
    // Si on va sur index.php?nom=toto&age=21, $_GET contient
    // [ 'nom' => 'toto', 'age' => 21]
    // var_dump($_GET)
    // On va récupérer le nom dans l'url s'il est présent
    // L'opérateur null coalescing permet de vérifier si une valeur existe
    $nom = $_GET['nom'] ?? null;
    $age = $_GET['age'] ?? null;
    ?>

    <?php
    if ($nom) { ?>
        <h1>
            Bonjour <?= $nom; ?>

            <?php if ($age) { ?>
                , tu as <?= $age?>ans.
            <?php } ?>
        </h1>
        <?php
    }
    ?>

    <a href="index.php?nom=toto&age=21">Hello Toto</a>
    <a href="index.php?nom=tata">Hello Tata</a>
    <a href="index.php">Hello</a>

    <h2>Un formulaire avec $_GET</h2>

    <!-- Attention, les names sont très importants dans les formulaires -->
    <form method="get">
        <label>
            <select name="age">
                <option value="20">20ans</option>
                <option value="30">30ans</option>
            </select>
        </label>
        <div>
            <label>Nom: </label>
            <label>
                <input name="nom" type="text"/>
            </label>
            <button>Go</button>
        </div>
    </form>

    <a href="candidature.php">Candidater</a>
</div>
</body>
</html>


