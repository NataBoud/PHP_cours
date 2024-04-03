<?php

include "CompteBancaire.php";
include "tools.php";

function deposer($compte): void
{
    $montant = readline("Montant à déposer : ");
    if (!is_numeric($montant) || $montant <= 0) {
        echo RED . "Veuillez saisir un montant valide et supérieur à zéro." . RESET . PHP_EOL;
        return;
    }
    $compte->deposer($montant);
    menuUtilisateur($compte);
}

function retirer($compte): void
{
    $montant = readline("Montant à retirer : ");
    if (!is_numeric($montant) || $montant <= 0) {
        echo RED . "Veuillez saisir un montant valide et supérieur à zéro." . RESET . PHP_EOL;
        return;
    }
    if (!$compte->retirer($montant)) {
        echo RED . "Le montant du retrait est insuffisant !" . RESET . PHP_EOL;
    }
    menuUtilisateur($compte);
}

function afficherSolde($compte): void
{
    $compte->afficherSolde();
    menuUtilisateur($compte);
}

function detruireCompte(CompteBancaire $compte): void {
    unset($compte);
    echo YELLOW . "Le compte a été détruit." . RESET . PHP_EOL;
}

function creerUnCompte(CompteBancaire $compte): void
{
    // Titulaire
    GREEN .  $inputTitulaire  = readline("Saisir votre nom et votre prénom: ") . RESET;
    while (empty($inputTitulaire)) {
        echo RED . "Caractères alphabétiques et espaces uniquement !" . RESET . PHP_EOL;
        GREEN . $inputTitulaire = readline("Saisir votre nom et votre prénom: ");
    }
    // Solde
    GREEN . $inputSolde = readline("Saisir votre solde: ") . RESET;
    while (empty($inputSolde)) {
        echo RED . "Veuillez saisir un montant valide pour le solde !" . RESET . PHP_EOL;
        $inputSolde = readline("Saisir votre solde: ");
    }
    // Devise
    GREEN . $inputDevise = readline("Saisir votre devise: ") . RESET;
    while (empty($inputDevise)) {
        echo RED . "Veuillez saisir une devise." . RESET . PHP_EOL;
        $inputDevise = readline("Saisir devise: ");
    }

    // Création du compte
    $compte->setTitulaire($inputTitulaire, $inputSolde, $inputDevise);
    // Confirmation
    echo YELLOW . "Vous êtes connecté à votre compte avec succès !" . RESET . PHP_EOL;
    menuUtilisateur($compte);
}

function start(): void
{
    menu();
    $input = readline("Saisir une option: ");
    match ($input) {
        "1" => creerUnCompte(new CompteBancaire("Titulaire par défaut", 0, "€")),
        "2" => exit(),
        default => print("saisie invalide"),
    };
}

function menuTemplate($choices) : string
{
    do {
        echo "Veuillez indiquer votre choix: " . PHP_EOL;
        foreach ($choices as $nb => $choice) {
            echo "$nb- $choice";
        }
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

function menuUtilisateur(CompteBancaire $compte): void
{
    $mainMenuArray = array(
        1 => GREEN . "Deposer\n" . RESET,
        2 =>  GREEN . "Retirer\n" . RESET,
        3 =>  GREEN . "Afficher le solde\n" . RESET,
        4 =>  GREEN . "Fermer le compte\n" . RESET,
        5 =>  GREEN . "Quitter\n" . RESET,
    );
    // Affichage de la sélection du menu
    $userChoice = menuTemplate($mainMenuArray);
    match ($userChoice) {
        "1" => deposer($compte),
        "2" => retirer($compte),
        "3" => afficherSolde($compte),
        "4" => detruireCompte($compte),
        "5" => exit()
    };
}

function menu(): void
{
    echo GREEN . "1. Créer un compte" . RESET . PHP_EOL;
    echo RED . "2. Quitter" . RESET . PHP_EOL;
}

start();
