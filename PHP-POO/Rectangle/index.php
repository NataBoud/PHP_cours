<?php

include "Rectangle.php";

$monRectangle = new Rectangle(5, 3);


echo "Le périmètre du rectangle est : " . $monRectangle->perimetre() . PHP_EOL;
echo "La surface du rectangle est : " . $monRectangle->surface() . PHP_EOL;