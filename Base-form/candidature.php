<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Superglobales: POST</title>
</head>
<body>
<div>
    <h2>Formulaire de candidature</h2>
    <a href="index.php">Retour à l'accueil</a>

    <?php
    // Grâce à la superglobale $_POST, on va pouvoir traiter le formulaire.
    var_dump($_POST);
    // On va commencer par récupérer tous les champs
    $prenom = $_POST['prenom'] ?? null;
    $password = $_POST['password'] ?? null;
    $erreurs = [];

    // On vérifie si le formulaire est soumis
    if (!empty($_POST)) {
        // Vérifier s'il y a des erreurs dans le formulaire
        // Si le prénom est vide, on ajoute une erreur dans le tableau
        if (empty($prenom)) {
            $erreurs[] = "Le prénom est invalide";
        }
        // Vérifier que le mot de passe fasse au minimum 6 caractères
        if (strlen($password) < 6) {
            $erreurs[] = "Le mot de passe est trop court";
        }

        if (empty($erreurs)) {
            // On affiche un message de succès
            echo "<div>Merci pour votre candidature</div>";
        } else {
            // Afficher les erreurs...
            echo "<ul>";
            foreach ($erreurs as $erreur) {
                echo "<li>$erreur</li>";
            }
            echo "</ul>";
        }
    }
    ?>

    <form method="post" action="index.php">
        <label for="prenom">Prénom:</label>
        <input name="prenom" type="text" />

        <label for="password">Mot de passe:</label>
        <input name="password" type="password">

        <button name="form1">Postuler</button>
    </form>
    <form method="post">
        <label for="prenom">Prénom:</label>
        <input name="prenom" type="text" />

        <label for="password">Mot de passe:</label>
        <input name="password" type="password">

        <button name="form2">Postuler</button>
    </form>
</div>

</body>
</html>