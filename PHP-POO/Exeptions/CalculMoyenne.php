<?php

function getAverage(array $array): float
{
    $sum = array_sum($array);
    if (empty($array)) {
        throw new InvalidArgumentException('Le tableau est vide');
    }
    return round($sum / count($array), 2);
}

try {
    $result = getAverage([]);
    echo "La moyenne est de: $result\n";
} catch (InvalidArgumentException $e) {
    if ($e->getMessage() == 'Le tableau est vide') {
        echo "Erreur: Le tableau ne peut pas être vide pour calculer la moyenne.\n";
    } else {
        // Affiche un message d'erreur générique pour les autres exceptions
        echo "Une erreur s'est produite :", $e->getMessage();
    }
}