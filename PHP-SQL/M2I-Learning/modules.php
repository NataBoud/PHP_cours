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
function getTagsByModuleId(PDO $db, int $moduleId): array
{
    $request = "
SELECT tag.id, tag.title 
FROM tag 
    INNER JOIN module_tag ON tag.id = module_tag.tag_id 
WHERE module_id=:moduleId";
    $statement = $db->prepare($request);
    $statement->execute(["moduleId" => $moduleId]);
    $tags = $statement->fetchAll(PDO::FETCH_ASSOC);
    // Retourne un tableau vide si la valeur est fausse
    return $tags ?: [];
}
function getStatusById(PDO $db, int $id): array|false
{
    $statement = $db->prepare("SELECT * FROM status WHERE id=:id");
    $statement->execute(["id" => $id]);

    return $statement->fetch(PDO::FETCH_ASSOC);
}
function getOneModuleById(PDO $db, int $id): array|false
{
    $statement = $db->prepare("SELECT * FROM module WHERE id=:id;");
    $statement->execute(["id" => $id]);

    $module = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$module) {
        return false;
    }
    $status = getStatusById($db, $module["status_id"]);
    $tags = getTagsByModuleId($db, $module["id"]);
    $moduleFull = [...$module, "status" => $status, "tags" => $tags];
    unset($moduleFull["status_id"]);

    return $moduleFull;
}


function getAllModules(PDO $db): array
{
    $statement = $db->query("SELECT * FROM module");
    $statement->execute();

    $modules = $statement->fetchAll(PDO::FETCH_ASSOC);

    $modulesFull = [];

    foreach ($modules as $module) {
        $status = getStatusById($db, $module["status_id"]);
        $tags = getTagsByModuleId($db, $module["id"]);

        // On crée notre tableau associatif avec les informations nécessaires
        $moduleFull = [...$module, "status" => $status, "tags" => $tags];

        // On supprime la clé "status_id" pour éviter la redondance
        unset($moduleFull["status_id"]);

        // On ajoute le module à notre tableau
        $modulesFull[] = $moduleFull;
    }

    return $modulesFull;
}

$db = new PDO("mysql:host=localhost;dbname=exercice03m2ilearning;charset=utf8mb4", "root", "");

if(isset($_GET["id"])) {
    $id = (int) htmlspecialchars($_GET["id"]);

    $module = getOneModuleById($db, $id);

    if(!$module) {
        http_response_code(404);
        echo json_encode(["code" => "404", "message" => "tag not found with id: $id"]);
        return;
    }

    echo json_encode($module,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} else {
    $modules = getAllModules($db);
    echo json_encode($modules, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}







