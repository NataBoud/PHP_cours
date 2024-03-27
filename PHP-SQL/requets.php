<?php

$db = new PDO('mysql:host=localhost;dbname=phpdemo01', "root", "");

$request = "INSERT INTO dog (name, date_of_birth) VALUES (:name, :date)";

$statement = $db->prepare($request);
$name = "max";
$date = "2020-12-04";
$statement->bindParam("name", $name);
$statement->bindParam("date", $date);

$statement->execute();
echo "id généré est:" . $db->lastInsertId();

