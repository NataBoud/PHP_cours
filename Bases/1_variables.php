<?php
//echo '<p>Bonjour le monde</p>';
//echo '<p>Bonjour le monde</p>';
//echo '<p>Bonjour le monde</p>';

$nom = 'Natalia';
$age = 10;
$myBoolean = true;
$myFloatNumber = 11.5;

//echo("Hello world\n");
//echo $nom;
const PRENOM = "\tTata\n";
//echo PRENOM;
//
//echo PHP_EOL;
const PRENOM2 = "\tTata\n";
define("IS_ACTIVE", true); // ancien syntax
//echo PRENOM2;
//
//echo "Type de mon boolean: ", gettype($myBoolean), PHP_EOL;
// La fonction print()
//print($nom);

//$name = readline( "Veuillez entrez votre prenom: ");
//echo $name;

// Convertir une chaîne de caractère en entier
//$age2 = (int)readline("Saisir un âge: ");
//echo gettype($age2);

$age = $age + 10;

$num = 51;
function hello($some)
{
    $some = $some + 10;
    return $some;
}

$blabla = 90;
//echo  hello($blabla);

$pseudo = "nat16";
$motDePass = "topsecret\n";
//echo $pseudo . ":" . $motDePass;
echo "pseudo: $pseudo mdp: $motDePass";

// détruire une variable
unset($age);

echo PHP_VERSION;