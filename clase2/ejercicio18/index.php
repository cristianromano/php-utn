<?php

require_once "garage.php";

$garage = new Garage("REND S.A" , 800);

$auto1 = new Auto("Rojo", "Fiat", 300);
$auto2 = new Auto("Gris", "Mercedes", 200);
$auto3 = new Auto("Gris", "Peugeot", 200);
$auto4 = new Auto("Gris", "Mercedes", 200);

var_dump($auto4);
echo "<br>";
$garage->Add($auto1);
echo "<br>";
$garage->Add($auto2);
echo "<br>";
$garage->Add($auto3);
echo "<br>";
$garage->Add($auto2);
echo "<br>";
echo "<br>";
$garage->MostrarGarage();
echo "<br>";
echo "<br>";
$garage->Remove($auto2);
echo "<br>";
echo "<br>";
$garage->Remove($auto2);
echo "<br>";
echo "<br>";
$garage->Add($auto2);
echo "<br>";
$garage->Add($auto3);

