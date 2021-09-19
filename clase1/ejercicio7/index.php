<?php

/*Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
Neiner, Maximiliano – Villegas, Octavio PHP- Página 1

salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números utilizando
las estructuras while y foreach. */

$arr = [];
$contador = 0;
for ($i=0; $i < 100 ; $i++) { 
    if ($i %2 != 0 && $contador < 10 ) {
        $arr[$i] = $i;
        $contador++;
    }
}

foreach ($arr as $key => $value) {
    echo $value . "<br>";
}