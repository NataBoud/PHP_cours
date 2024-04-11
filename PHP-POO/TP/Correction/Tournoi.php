<?php
namespace TP\Correction;

use Joueur;
use JoueurInterface;
use TennisMatch;

require_once('./Joueur.php');

class Tournoi
{
    private static array $joueurs = [];
    private static array $matchs = [];

    public static function ajouterJoueur() : void {
        $nom = readline("Nom du joueur : ");
        $prenom = readline("Prénom du joueur : ");
        $joueur = new Joueur($nom, $prenom);
        self::$joueurs[] = $joueur;
        echo GREEN . "Joueur ajouté avec succès." . RESET . PHP_EOL;
    }

    public static function getJoueurs() : void {
        print_r(self::$joueurs);
    }

    public static function getJoueur(int $index) : JoueurInterface {
        return self::$joueurs[$index];
    }

    public static function modifierJoueur(int $index, JoueurInterface $joueur) : void
    {
        if (isset(self::$joueurs[$index])) {
            // Demande des nouvelles valeurs à l'utilisateur

            $nom = readline("Entrez le nouveau nom: ");
            $prenom = readline("Entrez le nouveau prénom: ");

            // Assignation via les setters de la classe Joueur
            $joueur->setNom($nom);
            $joueur->setPrenom($prenom);

            // Affichage de la modification
            print(GREEN . "Joueur a modifié avec succès.\n" . RESET);
            self::getJoueur($index);
        } else {
            echo RED . "Le numéro spécifié n'existe pas.\n" . RESET;
        }
    }

    public static function supprimerJoueur(int $index) : string {
        if (isset(self::$joueurs[$index])) {
            unset(self::$joueurs[$index]);
            return print(GREEN . "Le joueur avec le numéro" . ($index - 1) . "a bien été supprimé.\n" . RESET);
            } else {
            return print(RED . "L'utilisateur n'existe pas.\n" . RESET);
        }
    }

    public static function creerMatch(JoueurInterface $joueur1, JoueurInterface $joueur2) : void {
        $match = new TennisMatch($joueur1, $joueur2);
        self::$matchs[] = $match;
    }

    public static function listerMatchs() : void {
        print_r(self::$matchs);
    }

    public static function listerJoueurs() : array {
        if(empty(self::$joueurs)) {
            echo RED . "Aucun joueur n'a été ajouté." . RESET . PHP_EOL;
        }
        return self::$joueurs;
    }
}