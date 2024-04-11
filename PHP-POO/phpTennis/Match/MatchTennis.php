<?php

namespace phpTennis\Match;
use DateTime;
use phpTennis\Joueur\JoueurInterface;

class MatchTennis
{
    private int $scoreJoueur1;
    private int $scoreJoueur2;
    private DateTime $date;

    public function __construct(private JoueurInterface $joueur1, private JoueurInterface $joueur2, int $scoreJoueur1 = 0, int $scoreJoueur2 = 0) {

        $this->scoreJoueur1 = $scoreJoueur1;
        $this->scoreJoueur2 = $scoreJoueur2;
        $this->date = new DateTime();
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