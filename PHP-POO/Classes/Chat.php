<?php

namespace Classes;

class Chat
{
    public $breed;
    public $poid;
    public $couleur;

    public function __construct($breed, $couleur, $poid = "inconnue")
    {
        $this->breed = $breed;
        $this->poid = $poid;
        $this->couleur = $couleur;
    }

    public function miauler(): void
    {
        print("C'est la race ".$this->breed." qui miau miau");
    }
}