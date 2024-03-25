<?php
$db = null;

try {
    $db = new PDO('mysql:host=localhost;dbname=tp01', "root", "");
    echo "La connexion est établie !<br>";
} catch(PDOException $ex) {
    echo $ex->getMessage();
}

// Ajouter un étudiant
function ajouterEtudiant($db, $nom, $prenom, $date_naissance, $email): void
{
    try {
        $requete = "INSERT INTO student (nom, prenom, date_de_naissance, adresse_email) VALUES (:nom, :prenom, :date_naissance, :email)";

        $query = $db->prepare($requete);

        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':date_naissance', $date_naissance);
        $query->bindParam(':email', $email);

        $query->execute();
        //  echo "L'étudiant a été ajouté avec succès.";

    } catch (PDOException $ex) {
        // Gestion des erreurs PDO
        echo "Erreur : " . $ex->getMessage();
    }
}

ajouterEtudiant($db, "Doe", "Hohn", "1990-05-15", "john.doe@example.com");
ajouterEtudiant($db, "Foe", "John", "1990-05-15", "john.doe@example.com");
ajouterEtudiant($db, "Moe", "Lohn", "1990-05-15", "john.doe@example.com");
ajouterEtudiant($db, "Toe", "Mohn", "1990-05-15", "john.doe@example.com");
ajouterEtudiant($db, "Toto", "Mohn", "1990-05-15", "john.doe@example.com");

function afficherEtudiants($db): void
{
    $requete = "SELECT * FROM student;";

    $query = $db->prepare($requete);
    $query->execute();
    $etudiants = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($etudiants as $etud) {
        print_r($etud);
    }
}
afficherEtudiants($db);