<?php
// opérateurs
echo 1 + 1, PHP_EOL;
echo 1 - 1, PHP_EOL;
echo 1 / 1, PHP_EOL;
echo 1 * 1, PHP_EOL;
echo 1 ** 1, PHP_EOL;
echo 4 % 1, PHP_EOL;

// opérateurs d'affectation
$monEntier = 1;
$monEntier += 1;
$monEntier -= 1;
$monEntier *= 1;
$monEntier /= 1;

$maChaine = 'Hello';
$maChaine .= "world";
echo $maChaine, PHP_EOL;

// opérateurs de comparaisons
var_export(1 == "1");
echo PHP_EOL;
var_export(1 === "1");
echo PHP_EOL;
var_export(1 > 2);
echo PHP_EOL;
var_export(1 >= 2);
echo PHP_EOL;
var_export(1 != "1");
echo PHP_EOL;
var_export(1 !== "1");
echo PHP_EOL;

// incrémentation

$compteur = 0;
$compteur++;
$compteur--;

++$compteur;
--$compteur;

// OU

$res = true || false; // true
var_export($res);
echo PHP_EOL;

$res = true && false; // false
var_export($res);

