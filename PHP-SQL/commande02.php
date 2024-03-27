<?php

// Créé un CLIENT et effectue des vérifications
function createClient(PDO $db): bool
{
    $firstname = readline("Saisir le prénom: ");
    if (empty($firstname)) {
        echo "Prénom incorrect";
        return false;
    }
    $lastname = readline("Saisir le nom: ");
    if (empty($lastname)) {
        echo "Nom incorrect";
        return false;
    }
    $adresse = readline("Saisir une adresse: ");
    if (empty($adresse)) {
        echo "Adresse incorrecte";
        return false;
    }
    $zipCode = readline("Saisir un code postal: ");
    if (empty($zipCode)) {
        echo "Code postal incorrect";
        return false;
    }
    $city = readline("Saisir une ville: ");
    if (empty($city)) {
        echo "Ville incorrecte";
        return false;
    }
    $telephone = readline("Saisir un numéro de téléphone: ");
    if (empty($telephone)) {
        echo "Numéro incorrecte";
        return false;
    }
    $requestAddClient = "INSERT INTO 
                            client 
                            (firstname, lastname, adresse, zipCode, city, telephone) 
                        VALUES 
                            (:firstname, :lastname, :adresse, :zipCode, :city, :telephone)";

    $statement = $db->prepare($requestAddClient);

    $statement->bindValue(":firstname", $firstname);
    $statement->bindValue(":lastname", $lastname);
    $statement->bindValue(":adresse", $adresse);
    $statement->bindValue(":zipCode", $zipCode);
    $statement->bindValue(":city", $city);
    $statement->bindValue(":telephone", $telephone);

    $statement->execute();

    // Retourne le nombre de lignes affectées par la requête
    return $statement->rowCount() === 1;

}

// Permet d'afficher les étudiants
function showClient(PDO $db): void
{
    // Requête pour récupérer tous les étudiants triés par nom puis prénom
    $request = "SELECT * FROM client 
                ORDER BY lastname, firstname";
    $statement = $db->prepare($request);

    $statement->execute();

    $clients = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($clients as $client) {
        echo json_encode($client) . PHP_EOL;
    }
}

function addCommande(PDO $db): void
{
    $clientId = (int) readline("Saisir id de client");
    $client = getOneClientById($db, $clientId);
    if (!$client) {
        echo "Aucun étudiant trouvé avec l'id $clientId";
        return;
    }

    if (!empty($client)) {

        $date = date("Y-m-d H:i:s"); // Date actuelle
        $total = readline("Saisir le montant total de la commande: ");
        if (empty($total) || !is_numeric($total)) {
            echo "Montant total incorrect";
            return;
        }
        $requestAddCommande = "INSERT INTO 
                                commandes 
                                (date, total, client_id) 
                            VALUES 
                                (:date, :total, :clientId)";
        $db->beginTransaction();

        $statement = $db->prepare($requestAddCommande);

        $statement->bindValue(":date", $date);
        $statement->bindValue(":total", $total);
        $statement->bindValue(":clientId", $clientId);

        $statement->execute();

        $db->commit();
        // Retourne le nombre de lignes affectées par la requête
//    return $statement->rowCount() === 1;
    }
}


// Lance le programme
function start(): void
{
    $db = new PDO('mysql:host=localhost;dbname=commandeTransaction', "root", "");

    while (true) {
        menu();
        $input = readline("Saisir une option: ");
        match ($input) {
            "1" => createClient($db),
            "2" => showClient($db),
            "3" => addCommande($db),
            "6" => exit(),
            default => print("saisie invalide"),
        };
    }
}
// Affichage du menu
function menu(): void
{
    echo "1. Créer un client
2. Afficher les clients
3. Ajouter une commande
6. Quitter" . PHP_EOL;
}

start();


