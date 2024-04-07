<?php

namespace phpTennis\Tournoi;

require_once 'Tournoi.php';
class MonTournoi extends Tournoi
{
    public function debuterTournoi(): void {
        echo "Le tournoi a débuté." . PHP_EOL;
    }

}