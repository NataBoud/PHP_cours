<?php

namespace TP\Correction;

use MenuTemplate;
use Tournoi;

require_once('./Joueur.php');
require_once ('TennisMatch.php');
require_once ('Tournoi.php');
require_once ('MenuTemplate.php');

class Menu extends MenuTemplate
{
    public function ajouterJoueur(): void
    {
        Tournoi::ajouterJoueur();
        count(Tournoi::listerJoueurs()) > 2 ? $this->afficherMenu() : null;
    }
    public function listerJoueurs(): void
    {
        $joueurs = Tournoi::listerJoueurs();
        foreach ($joueurs as $index => $joueur) {
            echo YELLOW ."Joueur numéro " . ($index + 1) . ": " . $joueur->getNom() . " " . $joueur->getPrenom() . " (Classement: " . $joueur->getClassement() . ")" . RESET . PHP_EOL;
        }
        $this->afficherMenu();
    }

    public function modifierJoueur(): void
    {
        $index = (int)readline(GREEN . "Numéro du joueur à modifier : " . RESET);
        $joueur = Tournoi::getJoueur($index - 1);
        Tournoi::modifierJoueur($index - 1, $joueur);
        $this->afficherMenu();
    }

    public function supprimerJoueur(): void
    {
        $index = (int)readline(GREEN . "Numéro du joueur à supprimer : ");
        Tournoi::supprimerJoueur($index - 1);
        $this->afficherMenu();
    }
}

$menu = new \Menu();
$menu->start();








