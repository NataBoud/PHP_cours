<?php

// Vérifier que la requête HTTP est en GET
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(405);
    echo json_encode(["code" => "405", "message" => "methode not allowed"]);
    return;
}
function getTags(PDO $db): array
{
    // La méthode query() prépare une requête SQL (sans binding de paramètres) et renvoie un PDOStatement
    $statement = $db->query("SELECT * FROM tag");
    $statement->execute();
    // Renvoyer un JSON contenant les tags ;  thunder client - http://[::1]:8000/tags.php, navigateur - http://localhost:8000/tags.php
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getTagByID(PDO $db, int $id): array|false
{
    $statement = $db->prepare("SELECT * FROM tag WHERE id=:id;");
    $statement->execute(["id" => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

// Récupérer les tags depuis la base de données
$db = new PDO("mysql:host=localhost; dbname=exercice03m2ilearning", "root", "");

// On regarde si le paramètre id est présent dans l'URL: ex tags.php?id=3
if (isset($_GET["id"])) {
    // htmlspecialchars() permet de retirer les caractères spéciaux
    $id = (int)htmlspecialchars($_GET["id"]);

    $tag = getTagById($db, $id);

    // On regarde si le tag existe
    if (!$tag) {
        http_response_code(404);
        echo json_encode(["code" => "404", "message" => "tag not found with id: $id"]);
        return;
    }
    // On renvoie le tag récupéré depuis la base de données
    echo json_encode($tag);

} else {
    // Récupère tous les tags depuis la database
    $tags = getTags($db);
    echo json_encode($tags);
}

