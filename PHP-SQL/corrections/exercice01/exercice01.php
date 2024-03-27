<?php

// Définition des regex à utiliser sous forme de constantes
const DATE_PATTERN = "/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/";
const EMAIL_PATTERN = "/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,}$/";

// Permet d'afficher les étudiants
function showStudents(PDO $db): void
{
    // Requête pour récupérer tous les étudiants trié par nom puis prénom
    $request = "SELECT id, firstname, lastname, date_of_birth, email FROM student ORDER BY lastname, firstname";
    $statement = $db->prepare($request);

    $statement->execute();

    // On récupère tous les enregistrements sous forme de tableaux associatifs
    $students = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($students as $student) {
        // On affiche chaque étudiant récupéré depuis la base de données
        echo json_encode($student) . PHP_EOL;
    }
}

// Créé un étudiant et effectue des vérifications
function createStudent(PDO $db): bool
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

    $dob = readline("Saisir date naissance (aaaa-mm-jj): ");


    if (!preg_match(DATE_PATTERN, $dob)) {
        echo "Date incorrecte";
        return false;
    }

    $email = readline("Saisir email: ");

    if (!preg_match(EMAIL_PATTERN, $email)) {
        echo "Email incorrect";
        return false;
    }

    $request = "INSERT INTO 
                    student 
                    (firstname, lastname, date_of_birth, email)
                VALUES 
                    (:firstname, :lastname, :date_of_birth, :email)";

    $statement = $db->prepare($request);

    // Le charactère ":" est facultatif lorsque l'on bind les paramètres
    $statement->bindValue(":firstname", $firstname);
    $statement->bindValue(":lastname", $lastname);
    $statement->bindValue(":date_of_birth", $dob);
    $statement->bindValue(":email", $email);

    $statement->execute();

    // Retourne le nombre de lignes affectés par la requête
    return $statement->rowCount() === 1;
}

// Récupère un étudiant par son id
function getOneStudentById(PDO $db, int $id): array|false
{

    $request = "SELECT id, firstname, lastname, date_of_birth, email FROM student WHERE id=:id;";

    $statement = $db->prepare($request);

    $statement->execute(["id" => $id]);

    return $statement->fetch(PDO::FETCH_ASSOC);
}

// Permet d'édutier un étudiant
function editStudent(PDO $db): void
{
    $id = (int)readline("Saisir l'id de l'étudiant: ");

    // On récupère l'étudiant en base de données s'il existe
    $student = getOneStudentById($db, $id);

    // Si l'étudiant n'est pas trouvé, on quitte la fonction
    if (!$student) {
        echo "Aucun étudiant trouvé avec l'id {$id}";
        return;
    }

    $firstname = readline("Saisir prénom: ");

    // Si l'utilisateur ne saisit rien, firstname garde son ancienne valeur
    if (empty($firstname)) {
        $firstname = $student["firstname"];
    }

    $lastname = readline("Saisir nom: ");

    if (empty($lastname)) {
        $lastname = $student["lastname"];
    }

    $dob = readline("Saisir date naissance: ");

    if (empty($dob)) {
        $dob = $student["date_of_birth"];
    }

    $email = readline("Saisir email: ");

    if (empty($email)) {
        $email = $student["email"];
    }

    echo $dob;

    $request = "UPDATE student SET firstname=:firstname, lastname=:lastname, date_of_birth=:date_of_birth, email=:email WHERE id=:id;";

    $statement = $db->prepare($request);

    $statement->bindValue(":firstname", $firstname);
    $statement->bindValue(":lastname", $lastname);
    $statement->bindValue(":date_of_birth", $dob);
    $statement->bindValue(":email", $email);
    $statement->bindValue(":id", $id);

    $statement->execute();
}

// Supprime un étudiant par son id
function deleteStudent(PDO $db): void
{

    $id = (int)readline("Saisir l'id de l'étudiant: ");

    $query = "DELETE FROM student WHERE id=:id;";

    $statement = $db->prepare($query);

    $statement->execute(["id" => $id]);
}

function searchStudentsByIdentity(PDO $db): void {
    // On prépare le paramètre pour le like
    $input = '%' . readline("Saisir le nom ou prénom de l'étudiant: ") . '%';

    $request = "SELECT id, firstname, lastname, date_of_birth, email FROM student WHERE firstname LIKE :input OR lastname LIKE :input";

    $statement = $db->prepare($request);
    $statement->execute([":input" => $input]);

    $students = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($students as $student) {
        // On affiche chaque étudiant récupéré depuis la base de données
        echo json_encode($student) . PHP_EOL;
    }
}

// Lance le programme
function start(): void
{
    $db = new PDO("mysql:host=127.0.0.1:3306;dbname=exercice01;", "root", "");

    echo "       _             _ _             _
   ___| |_ _   _  __| (_) __ _ _ __ | |_ ___
  / _ \ __| | | |/ _` | |/ _` | '_ \| __/ __|
 |  __/ |_| |_| | (_| | | (_| | | | | |_\__ \
  \___|\__|\__,_|\__,_|_|\__,_|_| |_|\__|___/" . PHP_EOL;

    while (true) {
        menu();
        $input = readline("Saisir une option: ");
        match ($input) {
            "1" => showStudents($db),
            "2" => createStudent($db),
            "3" => editStudent($db),
            "4" => deleteStudent($db),
            "5" => searchStudentsByIdentity($db),
            "6" => exit(),
            default => print("saisie invalide"),
        };
    }
}

// Affichage du menu
function menu(): void
{
    echo "1. Afficher les étudiants
2. Créer un étudiant
3. Editer un étudiant
4. Supprimer un étudiant
5. Chercher par nom ou prénom
6. Quitter" . PHP_EOL;
}

start();