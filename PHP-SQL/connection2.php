<?php

$db = null;

try {
    $db = new PDO('mysql:host=localhost;dbname=phpdemo01', "root", "");
    echo "la connexion est établie !";
} catch(PDOException $ex) {
    echo $ex->getMessage();
}

// Exec permet d'éxecuter des commandes SQL à partir de la connexion
//$db?->exec("CREATE DATABASE IF NOT EXISTS phpdemo01 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");

$request = "CREATE TABLE IF NOT EXISTS `dog` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `date_of_birth` DATETIME
)";

$db->exec($request);

//$request = "INSERT INTO dog (name, date_of_birth) VALUES ('rex', '2020-10-01'), ('milou', '2000-12-10');";

$db->exec($request);

// On prépare notre requête SQL pour se prémunir des injections
$request = "SELECT id, name, date_of_birth FROM dog WHERE id=:id";

// La méthode prepare renvoie un objet PDOStatement qui va nous permettre de binder nos paramètres et lire les résultats de nos requêtes
$query = $db->prepare($request);

// Pour binder le paramètre :id à une valeur, il suffit de passer un tableau associatif avec en clé le paramètre
$query->execute([":id" => 1]);

// Fetch permet de lire le premier résultat de la requête, il renvoie false quand il n'y a plus de données
// Par défaut, fetch renvoie un tableau, nous pouvons utiliser une constante de la classe PDO pour qu'il nous renvoie un tableau associatif
$result = $query->fetch(PDO::FETCH_ASSOC);
print_r($result);


$request = "SELECT id, name, date_of_birth FROM dog";
$query = $db->prepare($request);
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $dog) {
    print_r($dog);
}

echo json_encode($results);