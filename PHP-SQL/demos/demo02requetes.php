<?php

$db = new PDO("mysql:host=localhost;dbname=phpdemo01;", "root", "");

$request = "INSERT INTO dog (name, date_of_birth) VALUES (:name, :date);";

$statement = $db->prepare($request);

$name = "max";
$date = '2010-12-10';
// binding de paramètre à l'aide de la méthode BindParam
$statement->bindParam("name", $name);
$statement->bindParam("date", $date);

$statement->execute();

// Récupération du dernier id généré par la base de données sur la connexion
echo "L'id généré est: " . $db->lastInsertId();
