<?php
// Tableau associatif contenant les articles disponibles
$articles = [
    1 => ['nom' => 'Article 1', 'prix' => 10.00, 'stock' => 10],
    2 => ['nom' => 'Article 2', 'prix' => 20.00, 'stock' => 5],
    3 => ['nom' => 'Article 3', 'prix' => 30.00, 'stock' => 7]
];

// Initialisation du panier
$panier = [];

// Traitement du formulaire d'ajout d'article
if (isset($_POST['ajouter'])) {
    $code = $_POST['code'];
    $quantite = $_POST['quantite'];

    if (isset($articles[$code]) && $articles[$code]['stock'] >= $quantite) {
        $panier[$code] = $quantite;
        $articles[$code]['stock'] -= $quantite;
    } else {
        echo "Erreur : l'article n'est pas disponible ou la quantité demandée est insuffisante.";
    }
}

// Traitement du formulaire de suppression d'article
if (isset($_POST['supprimer'])) {
    $code = $_POST['code'];

    if (isset($panier[$code])) {
        unset($panier[$code]);
    } else {
        echo "Erreur : cet article n'est pas dans votre panier.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier d'achats</title>
</head>
<body>
<h1>Panier d'achats</h1>

<!-- Formulaire d'ajout d'article -->
<form method="post" action="">
    <label for="code">Code de l'article :</label>
    <select name="code" id="code">
        <?php foreach ($articles as $code => $article) : ?>
            <option value="<?= $code ?>"><?= $article['nom'] ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="quantite">Quantité :</label>
    <input type="number" name="quantite" id="quantite" min="1" max="<?= max(array_column($articles, 'stock')) ?>">
    <br>
    <input type="submit" name="ajouter" value="Ajouter au panier">
</form>

<!-- Formulaire de suppression d'article -->
<form method="post" action="">
    <label for="code">Code de l'article :</label>
    <select name="code" id="code">
        <?php foreach ($panier as $code => $quantite) : ?>
            <option value="<?= $code ?>"><?= $articles[$code]['nom'] ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <input type="submit" name="supprimer" value="Supprimer du panier">
</form>

<!-- Affichage du panier -->
<h2>Votre panier</h2>
<table border="1">
    <tr>
        <th>Nom</th>
        <th>Prix unitaire</th>
        <th>Quantité</th>
        <th>Prix total</th>
    </tr>
    <?php
    $total = 0;
    foreach ($panier as $code => $quantite) :
        $prix_total = $articles[$code]['prix'] * $quantite;
        $total += $prix_total;
        ?>
        <tr>
            <td><?= $articles[$code]['nom'] ?></td>
            <td><?= $articles[$code]['prix'] ?> €</td>
            <td><?= $quantite ?></td>
            <td><?= $prix_total ?> €</td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3" align="right"><strong>Total :</strong></td>
        <td><?= $total ?> €</td>
    </tr>
</table>
</body>
</html>
