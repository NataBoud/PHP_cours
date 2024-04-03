<?php
// Définition de la classe Rectangle
class Rectangle {
    // Déclaration des propriétés
    public int $largeur;
    public int $hauteur;

    // Création d'un constructeur
    public function __construct($largeur, $hauteur) {
        $this->largeur = $largeur;
        $this->hauteur = $hauteur;
    }

    // Définition des méthodes
    public function perimetre() : int {
        return 2 * ($this->largeur + $this->hauteur);
    }

    public function surface() : int {
        return $this->largeur * $this->hauteur;
    }
}

// Création d'un objet monRectangle à partir de la classe Rectangle
$monRectangle = new Rectangle(5, 10);

// Appel des méthodes de l'objet monRectangle
echo "Périmètre: ". $monRectangle->perimetre(). PHP_EOL;
echo "Surface: ". $monRectangle->surface();