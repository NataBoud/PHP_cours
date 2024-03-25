<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Market</title>
</head>
<body>
<div>
    <h1>Votre panier</h1>
    <?php
    // Démarrer une session PHP pour stocker les articles ajoutés
    session_start();

    // Initialisation des variables
    $articles = [
        [
            "Nom" => "sweat",
            "Prix" => 15.99,
            "Quantite en stock" => 2
        ],
        [
            "Nom" => "jeans",
            "Prix" => 30.99,
            "Quantite en stock" => 3
        ],
        [
            "Nom" => "chaussures",
            "Prix" => 130.99,
            "Quantite en stock" => 5
        ]
    ];

    $total = 0;
    $erreurs = [];

    // Traitement du formulaire si soumis
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["article"]) && isset($_POST["quantite"])) {
            $article = $_POST["article"];
            $quantite = $_POST["quantite"];

            if (empty($article) || empty($quantite)) {
                $erreurs[] = "Vous n'avez rien choisi.";
            }

            if (isset($_POST["vider_panier"])) {
                session_destroy();
            }

            $article_found = false;
            foreach ($articles as $art) {
                if ($art["Nom"] === $article) {
                    $article_found = true;
                    if ($quantite <= 0 || $quantite > $art["Quantite en stock"]) {
                        $erreurs[] = $quantite <= 0 ?
                            "La quantité doit être supérieure à zéro." :
                            "La quantité demandée pour $article est insuffisante.";
                        break;
                    } else {
                        // Ajouter l'article à la session
                        if (!isset($_SESSION['panier'][$article])) {
                            $_SESSION['panier'][$article] = [
                                "quantite" => 0,
                                "prix_unitaire" => $art["Prix"],
                                "prix_total_article" => 0
                            ];
                        }
                        $_SESSION['panier'][$article]["quantite"] += $quantite;
                        $_SESSION['panier'][$article]["prix_total_article"] += $quantite * $art["Prix"];
                    }
                }
            }
            if (!$article_found) {
                $erreurs[] = "Article non trouvé.";
            }

            if (!empty($erreurs)) {
                echo "<ul>";
                foreach ($erreurs as $erreur) {
                    echo "<li>$erreur</li>";
                }
                echo "</ul>";
            }
        }
    }

    // Calculer le total à partir de la session
    if (isset($_SESSION['panier'])) {
        foreach ($_SESSION['panier'] as $article => $details) {
            $total += $details['prix_total_article'];
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
        <button type="submit" name="vider_panier">Vider le panier</button>
    </form>
    <h2>Votre panier</h2>
    <?php if (empty($_SESSION['panier'])) { ?>
        <p>Votre panier est vide.</p>
    <?php } else { ?>
        <ul>
            <?php foreach ($_SESSION['panier'] as $article => $details) { ?>
                <li><?php echo "{$details['quantite']} x $article (Prix: {$details['prix_unitaire']} €) : {$details['prix_total_article']} €"; ?></li>
            <?php } ?>
        </ul>
        <p><strong>Total : <?php echo $total; ?> €</strong></p>
    <?php } ?>

</div>
</body>
</html>
