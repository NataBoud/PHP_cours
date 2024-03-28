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
function getOneClientById(PDO $db, int $id): array|false
{

    $request = "SELECT 
                    id, firstname, lastname, adresse, zipCode, city, telephone 
                FROM 
                    client 
                WHERE 
                    id=:id;";

    $statement = $db->prepare($request);

    $statement->execute(["id" => $id]);

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function addCommande(PDO $db): void
{
    $clientId = (int)readline("Saisir id de client");
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
    }
}
function showClientAndOrders(PDO $db): void
{
    $clientId = (int)readline("Saisir l'id du client pour afficher ses commandes: ");
    $client = getOneClientById($db, $clientId);
    if (!$client) {
        echo "Aucun client trouvé avec l'ID $clientId" . PHP_EOL;
        return;
    }
    echo "Informations du client :" . PHP_EOL;
    echo "Nom: {$client['lastname']}" . PHP_EOL;
    echo "Prénom: {$client['firstname']}" . PHP_EOL;
    echo "Adresse: {$client['adresse']}" . PHP_EOL;
    echo "Code postal: {$client['zipCode']}" . PHP_EOL;
    echo "Ville: {$client['city']}" . PHP_EOL;
    echo "Téléphone: {$client['telephone']}" . PHP_EOL;
    // récupération des commandes du client
    $request = "SELECT id, date, total FROM commandes WHERE client_id = :clientId";
    $statement = $db->prepare($request);
    $statement->execute([':clientId' => $clientId]);
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (empty($orders)) {
        echo "Ce client n'a pas de commandes." . PHP_EOL;
    } else {
        echo "Commandes du client :" . PHP_EOL;
        foreach ($orders as $order) {
            echo "ID Commande: {$order['id']}, Date: {$order['date']}, Total: {$order['total']}" . PHP_EOL;
        }
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
            "4" => showClientAndOrders($db),
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
4. Afficher le client et ses commandes
6. Quitter" . PHP_EOL;
}
start();


