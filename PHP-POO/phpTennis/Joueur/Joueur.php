<?php

namespace phpTennis\Joueur;

require_once 'JoueurInterface.php';

class Joueur implements JoueurInterface
{
    private string $nom;
    private string $prenom;
    private int $classement;
    private int $nombreMatchsGagnes;

    public function __construct(string $nom, string $prenom, int $classement = 0, int $nombreMatchsGagnes = 0) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->classement = $classement;
        $this->nombreMatchsGagnes = $nombreMatchsGagnes;
    }
    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getClassement(): int {
        return $this->classement;
    }

    public function incrementerMatchsGagnes(): void {
        $this->nombreMatchsGagnes++;
    }
}