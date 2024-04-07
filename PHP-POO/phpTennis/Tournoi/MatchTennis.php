<?php

namespace phpTennis\Tournoi;
use phpTennis\Joueur\JoueurInterface;

class MatchTennis
{
    private JoueurInterface $joueur1;
    private JoueurInterface $joueur2;
    private int $scoreJoueur1;
    private int $scoreJoueur2;

    public function __construct(JoueurInterface $joueur1, JoueurInterface $joueur2, $scoreJoueur1 = 0, $scoreJoueur2 = 0) {
        $this->joueur1 = $joueur1;
        $this->joueur2 = $joueur2;
        $this->scoreJoueur1 = $scoreJoueur1;
        $this->scoreJoueur2 = $scoreJoueur2;

    }
    public function getJoueur1(): JoueurInterface {
        return $this->joueur1;
    }

    public function getJoueur2(): JoueurInterface {
        return $this->joueur2;
    }

    public function getScoreJoueur1(): int {
        return $this->scoreJoueur1;
    }

    public function getScoreJoueur2(): int {
        return $this->scoreJoueur2;
    }

    public function getVainqueur(): ?JoueurInterface {
        if ($this->scoreJoueur1 > $this->scoreJoueur2) {
            return $this->joueur1;
        } elseif ($this->scoreJoueur1 < $this->scoreJoueur2) {
            return $this->joueur2;
        } else {
            return null;
        }
    }
}