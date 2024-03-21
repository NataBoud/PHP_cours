<?php

$age = 18;

if ($age > 18) {
    echo "Vous êtes majeur\n";
}

if (pi() > 4) {
    echo "Votre pi est bizarre\n";
} else {
    echo "Tout va bien\n";
}

$random = rand(1, 100);
if ($random < 10) {
    echo "le nombre $random est un chiffre\n";
} elseif ($random <= 80) {
    echo "le nombre $random est compris entre 10 et 80\n";
} else {
    echo "le nombre $random est compris entre 80 et 100\n";
}

$codeHttp = 900;
$message = "";

switch ($codeHttp) {
    case 300:
    case 200:
        $message = "Ok\n";
        break;
    case 400:
        $message = "Not found\n";
        break;
    case 500:
        $message = "Server error\n";
        break;
    default:
        $message = "Unknown code\n";
}
//echo $message;
$codeHttp = 500;
$message = match ($codeHttp) {
    200, 300 => 'Ok',
    400 => 'Not found',
    500 => 'Server error',
    default => 'Unknown code'
};
echo "Code status: $message\n";

$i = 5;
while ($i <= 10) {
    echo $i++;
}