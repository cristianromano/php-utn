<?php

require_once "./clases/productos.php";
require_once "./clases/ventas.php";




// $nombre = $_POST['nombre'];
// $codigo = $_POST['codigo'];
// $tipo = $_POST['tipo'];
// $precio = $_POST['precio'];
// $stock = $_POST['stock'];
$opcion = $_POST['opcion'];

//USUARIOS
// $nombre = $_POST['nombre'];
// $apellido = $_POST['apellido'];
// $mail = $_POST['mail'];
// $clave = $_POST['clave'];
// $localidad = $_POST['localidad'];


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
      $venta = new Venta('DFFS', 10, 52);
      //  var_dump($venta);
      Venta::verificarVenta($venta);
      break;
   case 'traerTabla':
      // $arr = Productos::TraerTodosLosProductos();
      // Productos::MostrarDatos($arr);
      // $arrUsuarios = Usuario::TraerTodosLosUsuarios();
      // Usuario::MostrarDatos($arrUsuarios);
      $arrVentas = Venta::TraerTodasLasVentas();
      Venta::MostrarDatos($arrVentas);
      break;
   case 'crearUsuario':
      $usuario = Usuario::crearUsuario($nombre,$apellido,$clave,$mail,$localidad);
      // var_dump($usuario);
      $usuario->InsertarUsuario();
      break;

   default:
      echo 'error';
      break;
}
