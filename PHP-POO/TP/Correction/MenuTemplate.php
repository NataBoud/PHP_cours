<?php

namespace TP\Correction;

use Tournoi;

require_once('./Joueur.php');
require_once ('Tournoi.php');
include "tools.php";
class MenuTemplate
{
    public function  menuTemplate($choices) : string
    {
        do {
            foreach ($choices as $nb => $choice) {
                echo GREEN ." $nb. $choice" .RESET;
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

    public function menu(): void
    {
        echo YELLOW . "Menu :" . RESET . PHP_EOL;
        echo YELLOW . "1. Ajoutez au moins deux joueurs pour commencer le match" . RESET . PHP_EOL;
        echo RED . "2. Quitter" . RESET . PHP_EOL;
    }

    public function afficherMenu() : void
    {
        $choice = readline(GREEN . "Afficher le menu ? (y/n) " . RESET );
        match (strtolower($choice)) {
            "y" => $this->menuUtilisateur(),
            "n" => exit(),
            default => RED ."Saisie invalide" . RESET . PHP_EOL
        };
    }
    public function start(): void
    {

        $this->menu();
        do {
            $choix = readline(YELLOW . "Choisissez une option : " . RESET );
            match ($choix) {
                '1' => $this->ajouterJoueur(),
                '2' => exit(GREEN . "Fin du programme." . RESET . PHP_EOL),
                default =>  RED . "Veuillez choisir une option valide." . RESET . PHP_EOL
            };
        } while (count(Tournoi::listerJoueurs()) < 2);

        echo YELLOW . "Vous pouvez commencer jouer !". RESET . PHP_EOL;
        $this->menuUtilisateur();
    }

    public function menuUtilisateur(): void
    {
        echo GREEN . "Menu :\n" . RESET;
        $mainMenuArray = array(
            1 =>  GREEN . "Ajouter un joueur\n",
            2 =>   "Modifier un joueur\n",
            3 =>  "Supprimer un joueur\n" ,
            4 =>  "Lister les joueurs\n",
//            5 =>  "Créer un match\n",
//            6 =>  "Lister les matchs\n" . RESET,
            7 =>  RED . "Quitter\n" . RESET,
        );
        $userChoice = $this->menuTemplate($mainMenuArray);
        match ($userChoice) {
            '1' => $this->ajouterJoueur(),
            '2' => $this->modifierJoueur(),
            '3' => $this->supprimerJoueur(),
            '4' => $this->listerJoueurs(),
//            '5' => $this->creerMatch($tournoi),
//            '6' => $this->listerMatchs($tournoi),
            '7' => exit("Fin du programme." . PHP_EOL),
            default => RED . "Veuillez choisir une option valide.". RESET . PHP_EOL
        };
    }

}

