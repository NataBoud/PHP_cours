<?php

// Les Classes (POO)


// Création d'une classe en PHP
class Fruit {
    // Création des propriétés (data)
    public string $color;
    public string $shape;
    public string $season;

    // Création d'un constructeur
    public function __construct($color, $shape = "inconnue") {
        $this->color = $color;
        $this->shape = $shape;;
    }

    // Création des méthodes (fonctions)
    public function peel() {
        print("je suis ".$this->color." et je suis épluché").PHP_EOL;
    }
}

// Création d'une instance de classe (objet) sans constructeur
$fraise = new Fruit();

// Appel d'une méthode
$fraise->peel();

// Création d'un objet avec constructeur
$undefined = new Fruit("bleu", "");
$apple = new Fruit("rouge", "ronde");

print($undefined->color);
