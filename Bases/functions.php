<?php
$message = "Hello World";
function helloWord(string $message) : string
{
    return print($message);
}
//var_dump(helloWord($message));
//helloWord($message);

function soustraction(int $a,int $b) : int
{
 return $a - $b;
}
$res = soustraction(5, 3);

echo $res;

