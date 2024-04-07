<?php

namespace phpTennis\Tournoi;

use phpTennis\Joueur\JoueurInterface;

require_once 'MatchTennis.php';

abstract class Tournoi
{
    protected array $joueurs = [];
    protected array $matchs = [];

    public function ajouterJoueur(JoueurInterface $joueur): void {
        $this->joueurs[] = $joueur;
    }

    public function modifierJoueur(int $index, JoueurInterface $joueur): void {
        if (isset($this->joueurs[$index])) {
            $this->joueurs[$index] = $joueur;
        }
    }

    public function supprimerJoueur(int $index): void {
        if (isset($this->joueurs[$index])) {
            array_splice($this->joueurs, $index, 1);
        }
    }

    public function listerJoueurs(): array {
        return $this->joueurs;
    }

    public function creerMatch(JoueurInterface $joueur1, JoueurInterface $joueur2): void {
        $scoreJoueur1 = rand(0, 7);
        $scoreJoueur2 = rand(0, 7);

        $match = new MatchTennis($joueur1, $joueur2, $scoreJoueur1, $scoreJoueur2);
        $this->matchs[] = $match;
    }
    public function listerMatchs(): array {
        return $this->matchs;
    }

    abstract public function debuterTournoi(): void;

}