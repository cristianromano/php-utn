<?php

require_once "auto.php";

$auto1 = new Auto("Rojo", "Fiat", 300);
$auto2 = new Auto("Gris", "Fiat", 200);

$auto3 = new Auto("Verde", "Honda", 400, null);
$auto4 = new Auto("Verde", "Honda", 600, null);

 Auto::guardarAutos($auto1);
 Auto::guardarAutos($auto2);
// Auto::guardarAutos($auto3);
Auto::MostrarAuto($auto1);

echo "<br>";

if ($auto1->IgualesMarca($auto2) == TRUE) {
    echo "TRUE";
} else {
    echo "FALSE";
}

echo "<br>";

echo Auto::Add($auto3, $auto4);

echo "<br>";

$auto2->AgregarImpuestos(1500);
echo "<br>";
$auto3->AgregarImpuestos(1500);
echo "<br>";
$auto4->AgregarImpuestos(1500);

echo "<br>";

Auto::leerAutos();



