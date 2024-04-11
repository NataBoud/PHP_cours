<?php

namespace TP\Correction;

use JoueurInterface;

require_once('./JoueurInterface.php');

class Joueur implements JoueurInterface
{
    private string $nom;
    private string $prenom;
    private int $classement;

    public function __construct(string $nom, string $prenom, int $classement = 0) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->classement = $classement;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

     public function getClassement(): int
    {
        return $this->classement;
    }

    public function setNom(string $nouveauNom): void
    {
       $this->nom = $nouveauNom;
    }

    public function setPrenom(string $nouveauPrenom): void
    {
       $this->prenom = $nouveauPrenom;
    }
}