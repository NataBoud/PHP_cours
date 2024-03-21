<?php
// while
//$prenoms = readline("Saisir le prenom: ");

//while ($prenoms !== "Natalia") {
////    echo "Erreur. Je veux un plus un beau prénom\n";
//    $prenoms = readline("Saisir le prenom: ");
//}

// for
for ($compteur = 1; $compteur <= 10; $compteur++) {
    echo $compteur, PHP_EOL;
}

for ($compteur = 10; $compteur > 0; $compteur--) {
    echo $compteur, PHP_EOL;
}

// do while

do {
    $saisie = readline("Saisir une lettre:");
} while($saisie !== "a");

$tableau = [10, 11, 13];

foreach ($tableau as $element) {
    echo $element, PHP_EOL;
}

for ($compteur = 0; $compteur < count($tableau); $compteur++) {
    echo $tableau[$compteur], PHP_EOL;
}

$tableauAssociatif = ["un" => 1, "deux" => 2];
# echo $tableauAssociatif["un"];

foreach ($tableauAssociatif as $key => $value) {
    echo "$key => $value\n";
}