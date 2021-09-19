<?php

$conteo=0;
$sumaTotal = 1;

while ($sumaTotal < 1000) {
    $sumaTotal += $conteo;
    $conteo++;
}

echo('conteo final: ' . $conteo . ' sumados');

?>