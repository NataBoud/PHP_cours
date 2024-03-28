<?php

//{
//    "id": 1,
//    "name": "PHP",
//    "start": "2020-10-01 12:00:00",
//    "end": "2020-10-03 18:00:00",
//    "statut": {"id": 1, "title": "en cours"}
//    "tags": [{"id": 1, "title": "php"}, {"id": 2, "title": "backend"}]
//}

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(405);
    echo json_encode(["code" => "405", "message" => "methode not allowed"]);
    return;
}
function getAllModules(PDO $db): array
{
    $statement = $db->query("SELECT * FROM module");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getTagsByModuleId(PDO $db, int $moduleId): array
{
    $statement = $db->prepare(
//        "SELECT t.* FROM tag t INNER JOIN module_tag mt ON t.id = mt.tag_id WHERE mt.module_id = :moduleId");
        "SELECT * FROM module INNER JOIN module_tag ON module.module_tag = tag.tag_id");
    $statement->execute(["moduleId" => $moduleId]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}




function getModuleById(PDO $db, int $id): array|false
{
    $statement = $db->prepare("SELECT * FROM module WHERE id=:id;");
    $statement->execute(["id" => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

try {
    $db = new PDO("mysql:host=localhost;dbname=exercice03m2ilearning;charset=utf8mb4", "root", "");
} catch(PDOException $ex) {
    echo json_encode(["code" => "500", "message" => "Erreur de connexion à la base de données: " . $ex->getMessage()]);
    return;
}

if (isset($_GET["id"])) {
    $id = (int)htmlspecialchars($_GET["id"]);
    $module = getModuleById($db, $id);
    if(!$module) {
        http_response_code(404);
        echo json_encode(["code" => "404", "message" => "Module non trouvé avec l'ID: $id"]);
        return;
    }
    $module['tags'] = getTagsByModuleId($db, $id);
    echo json_encode($module, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} else {
    $allModules = getAllModules($db);
    echo json_encode($allModules, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}








