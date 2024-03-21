<?php
$tableau = ['Tata', 'Titi', 'Toto', 'Arthur'];
$letter = "a";

foreach ($tableau as $prenom) {
    echo $prenom, PHP_EOL;
    for ($i = 0; $i < strlen($prenom); $i++) {
        if (strtoLower($prenom[$i]) === $letter) {
            $found = true;
            break;
        }
    }
    if ($found) {
        echo "Le prénom $prenom contient la lettre $letter.", PHP_EOL;
    } else {
        echo "Le prénom $prenom ne contient pas la lettre $letter'.";
    }
    $found = false; // redéfinir $found
}
