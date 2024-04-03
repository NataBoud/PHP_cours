<?php

class Rectangle
{   public $largeur;
    public $hauteur;

    public function __construct($largeur, $hauteur)
    {
        $this->largeur = $largeur;
        $this->hauteur = $hauteur;

    }

    public function perimetre() {
        return 2 * ($this->largeur + $this->hauteur);
    }

    public function surface() {
        return $this->largeur * $this->hauteur;
    }

}