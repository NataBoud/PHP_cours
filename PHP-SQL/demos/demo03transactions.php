<?php

$db = new PDO("mysql:host=127.0.0.1;dbname=demo03transaction;", "root", "");

$requestAddMaster = "INSERT INTO master (firstname, lastname) VALUES (:firstname, :lastname)";
$requestAddCat = "INSERT INTO cat (name, breed, master_id) VALUES (:name, :breed, :master_id)";

$db->beginTransaction();

try {
    $statement = $db->prepare($requestAddMaster);
    $statement->execute([":firstname" => "Michel", ":lastname" => "ange"]);

// on récupère l'id du maitre généré en base de données
    $masterId = $db->lastInsertId();

    $statement = $db->prepare($requestAddCat);
    $statement->execute(["name" => "Garfield", "breed" => "sphinx", "master_id" => $masterId]);
    $db->commit();
    echo "la transaction s'est bien passée!";
} catch (PDOException $ex) {
    echo $ex->getMessage();
    $db->rollBack();
}


