<?php

namespace phpTennis\Joueur;

require_once 'Joueur.php';
interface JoueurInterface
{
    public function getNom(): string;

    public function getPrenom(): string;

    public function getClassement(): int;
}