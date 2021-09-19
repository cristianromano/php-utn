<?php

/*Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.

Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.

*/

$lapiceraUno = array("color"=>'azul ',"marca" =>'mattel ' ,"trazo"=> 'fino',"precio"=>'100 ');
$lapiceraDos = array("color"=>' rojo',"marca" =>'oslo' ,"trazo"=> 'grueso',"precio"=>'200 ');
$lapiceraTres = array("color"=>'verde ',"marca" =>'parker ' ,"trazo"=> 'transparente',"precio"=>'300 ');

$arrIndexeado = array($lapiceraUno , $lapiceraDos , $lapiceraTres);

foreach ($arrIndexeado as $lapicera) {
   foreach ($lapicera as $key => $value) {
      echo $key .": " . $value." ";
   }
   echo "<br>";
}