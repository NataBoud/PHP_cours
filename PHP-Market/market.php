<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Market</title>
</head>
<body>
<div>
    <h1>Votre panier</h1>
    <?php
    $articles = [
        [
            "Nom" => "sweat",
            "Prix" => 15.99,
            "Quantite en stock" => 800
        ],
        [
            "Nom" => "Jeans",
            "Prix" => 99.99,
            "Quantite en stock" => 260
        ],
        [
            "Nom" => "Chaussures",
            "Prix" => 130.99,
            "Quantite en stock" => 400
        ]
    ];
    var_dump($_POST);
    $panier = [];
    $erreurs = [];
    if (isset($_POST["article"]) && isset($_POST["quantite"])) {
        $article = $_POST["article"];
        $quantite = $_POST["quantite"];

        if (empty($article) || empty($quantite)) {
            $erreurs[] = "Vous n'avez rien choisi.";
        }
        if ($quantite <= 0) {
            $erreurs[] = "La quantité doit être supérieure à zéro.";
        }
        if (empty($erreurs)) {
            $panier[$article] = $quantite;
            echo "<div>Vous avez bien ajouté $article au panier avec une quantité de $quantite.</div>";
        } else {
            echo "<ul>";
            foreach ($erreurs as $erreur) {
                echo "<li>$erreur</li>";
            }
            echo "</ul>";
        }
    }
    ?>
    <form action="" method="post">
        <label for="article">Choisissez un article</label>
        <select name="article">
            <option value="">Article</option>
            <option value="sweat">Sweat</option>
            <option value="jeans">Jeans</option>
            <option value="chaussures">Chaussures</option>
        </select>
        <label for="quantite">Quantité</label>
        <input name="quantite" type="number"/>
        <button type="submit">Ajouter au panier</button>
    </form>
</div>
</body>
</html>



