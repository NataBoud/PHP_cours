<?php
// Exercice 1 Les variables
// Niveau 1 :
$firstName = "Boudard";
$lastName = "Natalia";
$age = 35;
$mail = "nboudard@mail.com";

echo "Nom: $lastName\nPrénom: $firstName\nAge: $age\nAdresse e-mail: $mail";

// Niveau 2 :
$isStudent = false;
$favoriteNumber = rand(1, 100);

echo PHP_EOL;
//if ($isStudent === true) {
//    echo "Vous êtes étudiant et votre nombre favori est $favoriteNumber";
//}  else {
//    echo "Vous n'êtes pas étudiant et votre nombre favori est $favoriteNumber";
//}
$message1 = $isStudent ? "Vous êtes étudiant" : "Vous n'êtes pas étudiant";
$message1 .= " et votre nombre favori est $favoriteNumber";
echo $message1;

// Niveau 3 :
$tableauAssociatif = [
    "lastName" => $lastName,
    "firstName" => $firstName,
    "age" => $age,
    "mail" => $mail,
    "isStudent" => $isStudent,
    "favoriteNumber" => $favoriteNumber
    ];
print_r($tableauAssociatif);
foreach ($tableauAssociatif as $key => $value) {
    echo "$key: $value\n";
}

// Exercice 2 Les opérateurs
// Niveau 1 :
$a = rand(1, 50);
$b = rand(1, 50);
$tabOperators = ["+", "-", "/", "*"];
$sum = $a + $b;
$dif = $a - $b;
$produit = $a * $b;
$quotient = $a / $b;
echo "La somme: $sum\nLa différence: $dif\nLe produit: $produit\nLe quotient: $quotient";

// Niveau 2 :
echo PHP_EOL;
$isEven = $a % 2 === 0 ? "paire" : "impaire";
echo "Le nombre ". $a ." est ".$isEven;

// Niveau 3
echo PHP_EOL;
$age1 = 18;
$age2 = 13;

if ($age1 >= 18 && $age2 >= 18) {
    echo "Vous pouvez accéder à l'événement\n";
} elseif ($age1 < 18 && $age2 >= 25 || $age2 < 18 && $age1 >= 25) {
    echo "L'une des deux personnes a moins de 18 ans mais elle peut être accompagnée d'une personne de 25 ans ou plus\n";
} else {
    echo "Vous ne pouvez pas accéder à l'événement\n";
}

// Exercice 3 Les structures conditionnelles
// Niveau 1 :
echo PHP_EOL;
$saisie = readline("Saisissez votre âge: ");
$res = $saisie < 18 ? "mineur" : "majeur";
echo "Vous êtes $res";

// Niveau 2 :
echo PHP_EOL;
$saisie2 = readline("Saisissez votre nombre:");
if ($saisie2 > 0) {
    echo "Le nombre est positif.";
} elseif ($saisie2 < 0) {
    echo "Le nombre est négatif.";
} else {
    echo "Le nombre est nul.";
}
// Niveau 3 :
echo PHP_EOL;
$note = readline("Veuillez entrer une note entre 0 et 20:");
if ($note >= 0 && $note <= 9) {
    echo "Insuffisant";
} elseif ($note >= 10 && $note <= 11) {
    echo "Passable";
} elseif ($note >= 12 && $note <= 13) {
    echo "Assez bien";
} elseif ($note >= 14 && $note <= 15) {
    echo "Bien";
} elseif ($note >= 16 && $note <= 17) {
    echo "Très bien";
} elseif ($note >= 18 && $note <= 20) {
    echo "Excellent";
} else {
    echo "La note doit être comprise entre 0 et 20.";
}

$n = readline("Veuillez entrer une note entre 0 et 20:");
$message = match (true) {
    $n >= 0 && $n <= 9 => "Insuffisant",
    $n >= 10 && $n <= 11 => "Passable",
    $n >= 12 && $n <= 13 => "Assez bien",
    $n >= 14 && $n <= 15 => "Bien",
    $n >= 16 && $n <= 17 => "Très bien",
    $n >= 18 && $n <= 20 => "Excellent",
    default => 'La note doit être comprise entre 0 et 20.'
};
echo "$message\n";

// Exercice 4 Les structures conditionnelles
// Niveau 1 :
echo PHP_EOL;
for ($compteur = 1; $compteur <= 10; $compteur++) {
    echo $compteur, PHP_EOL;
}
// Niveau 2 :
$sum = 0;
$i = 0;
while ($i <= 100) {
    if ($i % 2 == 0) {
        $sum += $i;
    }
    $i++;
}
echo "La somme des nombres pairs entre 0 et 100 est : " . $sum;

// Niveau 3 :
echo PHP_EOL;

//foreach ($tableau as $prenom) {
//    echo $prenom, PHP_EOL;
//
//    if (strpos($prenom, 'a') == true) {
//        echo "Le prénom $prenom contient la lettre 'a'.", PHP_EOL;
//    }
//}
$tableau = ['Tata', 'Titi', 'Toto', 'Arthur'];
$letter = "a";
$found = false;

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
    $found = false;
}