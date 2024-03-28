<?php
// Vérifier que la requête HTTP est en GET
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(405);
    echo json_encode(["code" => "405", "message" => "methode not allowed"]);
    return;
}
function getAllStatus(PDO $db): array
{
    // La méthode query() prépare une requête SQL (sans binding de paramètres) et renvoie un PDOStatement
    $statement = $db->query("SELECT * FROM status");
    $statement->execute();
    // Renvoyer un JSON contenant les tags ;  thunder client - http://[::1]:8000/tags.php, navigateur - http://localhost:8000/tags.php
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getStatusByID(PDO $db, int $id): array|false
{
    $statement = $db->prepare("SELECT * FROM status WHERE id=:id;");
    $statement->execute(["id" => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}
// Récupérer les status depuis BDD
$db = new PDO("mysql:host=localhost; dbname=exercice03m2ilearning", "root", "");

// On regarde si le paramètre id est présent dans l'URL: ex status.php?id=3
if (isset($_GET["id"])) {
    // htmlspecialchars() retirer les caractères spéciaux
    $id = (int)htmlspecialchars($_GET["id"]);
    $status = getStatusByID($db, $id);
    if(!$status) {
        http_response_code(404);
        echo json_encode(["code" => "404", "message" => "status not found with id: $id"]);
        return;
    }
    // On renvoie le status récupéré depuis BDD
    echo json_encode($status);
} else {
    // Récupère tous les status depuis la database
    $allStatus = getAllStatus($db);
    echo json_encode($allStatus);
}