<?php

 require_once "productos.php";
 require_once "ventas.php";


// $nombre = $_POST['nombre'];
// $codigo = $_POST['codigo'];
// $tipo = $_POST['tipo'];
// $precio = $_POST['precio'];
// $stock = $_POST['stock'];
   $opcion = $_POST['opcion'];


// if (isset($nombre) && isset($codigo) && isset($tipo) && isset($precio) && isset($stock)) {
//    $producto = new Productos($codigo, $nombre, $tipo, $stock, $precio);

//    Productos::verificarJSON($producto);

//    $arr = json_decode(file_get_contents('./archivos/productos.json',true));
//    array_push($arr,$producto);
//    Productos::guardarJSON($arr);
// }




switch ($opcion) {
   case 'leer':
      Productos::leerJSON();
      break;
   case 'venta':
       $venta = new Venta('DFFS', 10, 22);
      //  var_dump($venta);
       Venta::verificarVenta($venta);
      break;

   default:
      echo 'error';
      break;
}


?>