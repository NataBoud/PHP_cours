<?php

namespace phpTennis;

use phpTennis\Joueur\Joueur;
use phpTennis\Tournoi\MonTournoi;
include 'Tournoi\MonTournoi.php';
include 'Joueur\Joueur.php';
include "tools.php";

class Menu
{
    function menuTemplate($choices) : string
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
    function menu(): void
    {
        echo YELLOW . "Menu :" . RESET . PHP_EOL;
        echo YELLOW . "1. Ajoutez au moins deux joueurs pour commencer le match" . RESET . PHP_EOL;
        echo RED . "2. Quitter" . RESET . PHP_EOL;
    }
    function start(): void
    {
        $tournoi = new MonTournoi(); // Instancier l'objet tournoi1
        $this->menu();
        do {
            $choix = readline(YELLOW . "Choisissez une option : " . RESET );
            match ($choix) {
                '1' => $this->ajouterJoueur($tournoi),
                '2' => exit(GREEN . "Fin du programme." . RESET . PHP_EOL),
                default =>  RED . "Veuillez choisir une option valide." . RESET . PHP_EOL
            };
        } while (count($tournoi->listerJoueurs()) < 2);

        echo YELLOW . "Vous pouvez commencer jouer !". RESET . PHP_EOL;
        $this->menuUtilisateur($tournoi);
    }
    private function ajouterJoueur(MonTournoi $tournoi): void
    {
        $nom = readline("Nom du joueur : ");
        $prenom = readline("Prénom du joueur : ");
        $joueur = new Joueur($nom, $prenom);
        $tournoi->ajouterJoueur($joueur);
        count($tournoi->listerJoueurs()) > 2 ? $this->afficherMenu($tournoi) : null;
        echo GREEN . "Joueur ajouté avec succès." . RESET . PHP_EOL;
    }
    function menuUtilisateur(MonTournoi $tournoi): void
    {
        echo GREEN . "Menu :\n" . RESET;
        $mainMenuArray = array(
            1 =>  GREEN . "Ajouter un joueur\n",
            2 =>   "Modifier un joueur\n",
            3 =>  "Supprimer un joueur\n" ,
            4 =>  "Lister les joueurs\n",
            5 =>  "Créer un match\n",
            6 =>  "Lister les matchs\n" . RESET,
            7 =>  RED . "Quitter\n" . RESET,
        );
        $userChoice = $this->menuTemplate($mainMenuArray);
        match ($userChoice) {
            '1' => $this->ajouterJoueur($tournoi),
            '2' => $this->modifierJoueur($tournoi),
            '3' => $this->supprimerJoueur($tournoi),
            '4' => $this->listerJoueurs($tournoi),
            '5' => $this->creerMatch($tournoi),
            '6' => $this->listerMatchs($tournoi),
            '7' => exit("Fin du programme." . PHP_EOL),
            default => RED . "Veuillez choisir une option valide.". RESET . PHP_EOL
        };
    }

    public function afficherMenu(MonTournoi $tournoi) : void
    {
        $choice = readline(GREEN . "Afficher le menu ? (y/n) " . RESET );
        match (strtolower($choice)) {
            "y" => $this->menuUtilisateur($tournoi),
            "n" => exit(),
            default => RED ."Saisie invalide" . RESET . PHP_EOL
        };
    }

    private function modifierJoueur(MonTournoi $tournoi): void
    {
        do {
            $index = (int)readline(GREEN . "Numéro du joueur à modifier : " . RESET);
            $joueurs = $tournoi->listerJoueurs();
            // Vérifications
            if ($index < 1 || $index > count($joueurs)) {
                echo RED . "Veuillez entrer un numéro de joueur valide." . RESET . PHP_EOL;
            }
        } while ($index < 1 || $index > count($joueurs));

        $nom = readline("Nom du joueur : ");
        $prenom = readline("Prénom du joueur : ");
        $joueur = new Joueur($nom, $prenom);

        $tournoi->modifierJoueur($index, $joueur);
        echo GREEN ."Joueur modifié avec succès.". RESET . PHP_EOL;
        $this->afficherMenu( $tournoi);
    }

    private function supprimerJoueur(MonTournoi $tournoi): void
    {
        $index = (int)readline(GREEN . "Numéro du joueur à supprimer : ");
        $tournoi->supprimerJoueur($index);
        echo "Joueur supprimé avec succès." . RESET . PHP_EOL;
        $this->afficherMenu( $tournoi);
    }

    private function listerJoueurs(MonTournoi $tournoi): void
    {
        $joueurs = $tournoi->listerJoueurs();
        if (empty($joueurs)) {
            echo "Aucun joueur n'a été ajouté." . PHP_EOL;
        } else {
            foreach ($joueurs as $index => $joueur) {
                echo YELLOW ."Joueur numéro " . ($index + 1) . ": " . $joueur->getNom() . " " . $joueur->getPrenom() . " (Classement: " . $joueur->getClassement() . ")" . RESET . PHP_EOL;
            }
        }
        $this->afficherMenu( $tournoi);
    }
    private function creerMatch(MonTournoi $tournoi): void
    {
        $indexJoueur1 = (int)readline(YELLOW . "Numéro du premier joueur : ");
        $indexJoueur2 = (int)readline("Numéro du deuxième joueur : " );

        $tournoi->creerMatch($tournoi->listerJoueurs()[$indexJoueur1 - 1], $tournoi->listerJoueurs()[$indexJoueur2 - 1]);
        $tournoi->debuterTournoi() . PHP_EOL;
        $this->afficherMenu( $tournoi). RESET;
    }

    private function listerMatchs(MonTournoi $tournoi): void
    {
        $matchs = $tournoi->listerMatchs();

        foreach ($matchs as $index => $match) {
            $joueur1 = $match->getJoueur1()->getNom() . " " . $match->getJoueur1()->getPrenom();
            $joueur2 = $match->getJoueur2()->getNom() . " " . $match->getJoueur2()->getPrenom();
            $scoreJoueur1 = $match->getScoreJoueur1();
            $scoreJoueur2 = $match->getScoreJoueur2();

            $vainqueur = $match->getVainqueur();

            $result = ($vainqueur !== null) ? $vainqueur->getNom() . " " . $vainqueur->getPrenom() : "Match nul";
            echo YELLOW . "Match " . ($index + 1) . ": $joueur1 (Score: $scoreJoueur1) VS $joueur2 (Score: $scoreJoueur2). Le vainqueur est: $result" . RESET . PHP_EOL;
        }
        $this->afficherMenu($tournoi);
    }
}

$menu = new Menu();

$menu->start();