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
      $usuario = Usuario::crearUsuario($nombre, $apellido, $clave, $mail, $localidad);
      // var_dump($usuario);
      $usuario->InsertarUsuario();
      break;
   case 'verificoUsuario':
      $usuario = Usuario::crearUsuario(rand(106, 200), 'Cristian', 'Romano', '777', 'cromano94@gmail.com', 'CABA');
      $usuario->VerificarUsuario();
      break;
   case 'verificoProducto':
      $producto = Productos::crearProducto(77900563, 'Manteca', 'Lacteo', 100, '89.99');
      $producto->AltaProducto();
      break;
   case 'realizoVenta':
      $venta = Venta::crearVenta(1014, 50, 53);
      $venta->RealizarVenta();
      break;
   case 'modificarPassword':
      $usuario = Usuario::UsuarioAux("Cristiano", 710, 999, "cronaldo7@gmail.com");
      // var_dump($usuario);
      $usuario->ModificarPassword();
      break;
   case 'modificarProducto':
      $producto = Productos::crearProducto(77900563, 'Cofler', 'Chocolate', 100, '109.99');
      // var_dump($usuario);
      $producto->AltaProducto();
      break;

   default:
      echo 'error';
      break;
}
