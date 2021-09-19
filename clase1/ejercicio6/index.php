<?php

/*Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado. */

$arr = [];
$sumaTotal = 0;

for ($i=0; $i < 5 ; $i++) { 
    $arr[$i] = $numeroRand = rand(1,10);
}
var_dump($arr);

for ($i=0; $i < count($arr) ; $i++) { 
    $sumaTotal += $arr[$i];
}

$promedio = $sumaTotal / count($arr);

if ($promedio > 6 ) {
  echo "el promedio es mayor a 6";
}
elseif ($promedio < 6) {
    echo "el promedio es menor a 6";
}
else{
    echo "el promedio es igual a 6";
}