<?php

// On récupère la méthode envoyée sur le serveur
// Si la méthode n'est pas du POST, on renvoie un message d'erreur
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405); // On modifie le code de la réponse HTTP
    echo json_encode(["code" => "405", "message" => "method not allowed"]); // On envoie une réponse sous forme d'objet JSON
    return;
}
// Permet de sérialiser un objet json en tableau associatif depuis la requête
$data = json_decode(file_get_contents('php://input'), true);
// Si la clé n'existe pas ou que le titre est vide, on renvoie une erreur
if (!key_exists("title", $data) || empty($data["title"])) {
    http_response_code(400);
    echo json_encode(["code" => "400", "message" => "The title is not defined"]);
    return;
}
// On ouvre la connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=exercice03m2ilearning", "root", "");

$request = "INSERT INTO tag (title) VALUES (:title)";
$statement = $db->prepare($request);
$statement->execute(["title" => $data["title"]]);

// On renvoie l'objet précédemment créé
echo json_encode(["id" => $db->lastInsertId(), "title" => $data["title"]]);