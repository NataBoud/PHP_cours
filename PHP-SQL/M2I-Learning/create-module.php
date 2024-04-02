<?php

function moduleVerification(array $module): bool
{

    // Le module doit avoir 5 éléments (name, start, end, status, tags)
    if (count($module) !== 5) {
        return false;
    }

    // On vérifie que toutes les clés soient présentes dans l'objet envoyé
    $expectedKeys = ["name", "start", "finish", "status", "tags"];

    foreach ($module as $key => $value) {
        // Si la clé n'est pas dans le tableau des clés valides
        // OU que l'élément est vide, la fonction renvoie faux
        if (!in_array($key, $expectedKeys) || empty($value)) {
            return false;
        }
    }

    return true;
}

// Vérification de la méthode utilisée
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["code" => "405", "message" => "method not allowed"]);
    return;
}

// Lire le corps de la requête HTTP et la déserialiser de JSON vers un tableau associatif
$data = json_decode(file_get_contents('php://input'), true);

// Vérification de l'objet envoyé
if (!moduleVerification($data)) {
    http_response_code(400);
    echo json_encode(["code" => "400", "message" => "Wrong object send"]);
    return;
}

$db = new PDO("mysql:host=localhost;dbname=exercice03m2ilearning;charset=utf8mb4", "root", "");

$db->beginTransaction();

try {
    // Enregistrement du module
    $request = "INSERT INTO module (name, start, finish, status_id) VALUES (:name, :start, :finish, :status_id)";

    $statement = $db->prepare($request);
    $statement->bindValue(":name", $data["name"]);
    $statement->bindValue(":start", $data["start"]);
    $statement->bindValue(":finish", $data["finish"]);
    $statement->bindValue(":status_id", $data["status"]["id"]);
    $statement->execute();

    $moduleId = $db->lastInsertId();

    // Enregistrement des tags liés au module dans la table de jointure
    foreach ($data["tags"] as $tag) {
        $request = "INSERT INTO module_tag (module_id, tag_id) VALUES (:module_id, :tag_id)";
        $statement = $db->prepare($request);
        $statement->bindValue(":module_id", $moduleId);
        $statement->bindValue(":tag_id", $tag["id"]);
        $statement->execute();
    }

    // On ajoute l'id au tableau associatif du module
    $data["id"] = $moduleId;

    $db->commit();

} catch (PDOException $ex) {
    $db->rollBack();
    http_response_code(500);
    echo json_encode(["code" => "500", "message" => "SQL ERROR"]);
    return;
}

echo json_encode($data);