<?php
const COLOR_RED = "\033[31m";
const COLOR_GREEN = "\033[32m";
const COLOR_YELLOW = "\033[33m";
const COLOR_RESET = "\033[0m";

function continuer()
{
    echo COLOR_GREEN . "Vous avez gagné!!!" . COLOR_RESET . PHP_EOL;
    $choix = trim(readline(COLOR_GREEN . "Rejouer ? (y/n) " . COLOR_RESET));
    if ($choix === "y") {
        start();
        return "y";
    } elseif ($choix === "n") {
        exit();
        return "n";
    } else {
        return false;
    }
}
function menuTemplate($choices) : string
{

    do {
        echo "Veuillez indiquer votre choix: " . PHP_EOL;
        foreach ($choices as $nb => $choice) {
            echo "$nb- $choice";
        }
        echo COLOR_RESET;
        // Demande de saisie à l'utilisateur
        echo "Entrez le nombre correspondant à votre sélection : ";
        $userChoice = trim(fgets(STDIN));

        // Vérification de la validité de la saisie
        if (!in_array($userChoice, array_keys($choices))) {
            // Demande de saisie à nouveau
            echo RED . "Saisie erronée. Veuillez entrer un choix valide : ";
            $userChoice = trim(fgets(STDIN));
        }
    } while (!in_array($userChoice, array_keys($choices)));

    return $userChoice;
}


function choixUtilisateur(): string|false
{
    $choix = trim(readline(COLOR_GREEN . "Taper gauche/droite (g/d) " . COLOR_RESET));

    if ($choix === "g") {
        echo COLOR_YELLOW . "Vous avez choisi aller à gauche" . COLOR_RESET . PHP_EOL;
        menuGame();
        return "g";

    } elseif ($choix === "d") {
        echo COLOR_YELLOW . "Vous avez choisi aller à droite". COLOR_RESET . PHP_EOL;
        menuGame();
        return "d";

    } else {
        return false;
    }
}

function startDuJeux(): void
{
    echo COLOR_YELLOW . "Vous décidez d'entrer dans la forêt et de partir à l'aventure ! Vous arrivez à un carrefour." . COLOR_RESET . PHP_EOL;

    do {
        $reponse = choixUtilisateur();
        if ($reponse != "gauche" && $reponse != "droite") {
            echo "Votre réponse n'est pas valide. Veuillez répondre par 'droite' ou 'gauche'." . PHP_EOL;
        }
    } while ($reponse != "gauche" && $reponse != "droite");
}

echo "Vous vous tenez à l'entrée d'une forêt ancienne. Un trésor légendaire est dit être caché quelque part à l'intérieur." . PHP_EOL;
function start(): void
{
        menu();
        $input = readline("Saisir une option: ");
        match ($input) {
            "1" => startDuJeux(),
            "2" => exit(),
            default => print("saisie invalide"),
        };
}

function menuGame():void
{
    $mainMenuArray = array(
        1 => COLOR_GREEN . "Continuer\n" . COLOR_RESET,
        2 =>  COLOR_RED . "Quitter\n" . COLOR_RESET
    );
    // Affichage de la sélection du menu
    $userChoice = menuTemplate($mainMenuArray);
    match ($userChoice) {
        "1" => continuer(),
        "2" => exit()
    };
}

function menu(): void
{
    echo COLOR_GREEN . "1. Vous voulez entrer" . COLOR_RESET . PHP_EOL;
    echo COLOR_RED . "2. Quitter" . COLOR_RESET . PHP_EOL;
}

start();