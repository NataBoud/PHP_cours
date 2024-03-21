<?php
$tableau = [1, 2, 3];
$tableau1 = array(1, 2, 3);

$tableauAssociatif = [1 => "un", "deux" => 2, true => 24];

//echo $tableau[1];
//echo $tableauAssociatif[true];

$tableau[] = 4;

print_r($tableau);
$tableauAssociatif["toto"] = false;

print_r($tableauAssociatif);
// Destructuration de tableau

["USERNAME" => $user] = $_SERVER;
//echo $user;

// skip les premiers elements

[,,,$a] = $tableau;
echo $a;
// spread opérateur

$tableau2 = [...$tableau, ...$tableau1];
print_r($tableau2);


$tabMult = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];

foreach ($tabMult as $tab) {
    foreach ($tab as $val) {
        echo $val, PHP_EOL;
    }
}