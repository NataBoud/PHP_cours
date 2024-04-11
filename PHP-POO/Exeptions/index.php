<?php

// Les Classes (POO)


// Création d'une classe en PHP
class Fruit {
    // Création des propriétés (data)
    public string $name;
    public string $color;
    public string $shape;
    public string $season;

    // Création d'un constructeur
    public function __construct($name, $color, $shape = "inconnue") {
        $this->name = $name;
        $this->color = $color;
        $this->shape = $shape;
        echo "L'objet $this->name a été construit\n";
    }

    // Création d'un destructeur
    public function __destruct() {
        echo "L'objet $this->name a été détruit\n";
    }

    // Création des méthodes (fonctions)
    public function peel() : void {
        print("je suis ".$this->name." et je suis épluché").PHP_EOL;
    }
}

// Création d'une instance de classe (objet) sans constructeur
//$fraise = new Fruit();

// Appel d'une méthode
//$fraise->peel();

// Création d'un objet avec constructeur
$undefined = new Fruit("inconnu","bleu", "");
$apple = new Fruit("pomme", "rouge", "ronde");

// Destruction de l'objet
unset($apple);
