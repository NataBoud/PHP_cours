<?php

// Définir une fonction qui divise deux nombres
function diviser(int $a, int $b) : int {
    if ($b == 0) {
        throw new Exception('Division par zéro');
    }
    return $a / $b;
}

// Essaie de division de deux nombres et capture des exceptions
try {
    $resultat = diviser(10, 2.5);
    echo "Le résultat est : $resultat\n";
} catch (Exception $e) {
    if ($e->getMessage() == 'Division par zéro') {
        echo "Erreur: Vous ne pouvez pas diviser par zéro\n";
    } else {
        // Affiche un message d'erreur générique pour les autres exceptions
        echo "Une erreur s'est produite :", $e->getMessage();
    }
} finally {
    // Ferme les ressources ouvertes, par exemple une connexion à une base de données
    echo "Code exécuté dans le bloc finally";
}