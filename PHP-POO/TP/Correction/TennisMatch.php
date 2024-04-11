<?php
namespace TP\Correction;
use DateTime;
use JoueurInterface;

class TennisMatch
{
    private string $score;
    private DateTime $date;

    public function __construct(private JoueurInterface $joueur1, private JoueurInterface $joueur2)
    {
        $this->score = "[0-0]";
        $this->date = new DateTime();
    }

    public function getVainqueur(): JoueurInterface
    {
        // Suppression des crochets de mon score
        $score_trim = trim($this->score, "[]");

        // Décomposition de mon string en tableau
        $score_split = explode("-", $score_trim);

        // Transformation des valeurs du tableau en int
        $score_joueur1 = (int)$score_split[0];
        $score_joueur2 = (int)$score_split[1];

        if ($score_joueur1 > $score_joueur2) {
            return $this->joueur1;
        } else {
            return $this->joueur2;
        }
    }
}