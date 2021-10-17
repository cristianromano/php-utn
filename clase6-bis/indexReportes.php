<?php

require_once "./clases/reportes.php";

$opcion = $_POST['opcion'];
// $orden = $_POST['orden'];
// $fecha1 = $_POST['fecha1'];
// $fecha2 = $_POST['fecha2'];
// $cantidad = $_POST['cantidad'];

switch ($opcion) {
    case 'ordenarUsuarios':
        Usuario::MostrarDatos(Reportes::TraerUsuariosOrdenados($orden));
        break;
    case 'ordenarProductos':
        Productos::MostrarDatos(Reportes::TraerProductosOrdenados($orden));
        break;
    case 'ventaFiltrada':
        Venta::MostrarDatos(Reportes::TraerVentasFiltradas(2, 5));
        break;
    case 'ventaFechas':
        $arr = Reportes::TreaerTotalProductosVendidos($fecha1, $fecha2);
        $json_string = json_encode($arr);
        $file = './reportes/ventasEntreDosFechas.json';
        file_put_contents($file, $json_string);
        // Venta::MostrarDatos($arr);
        break;
    case 'ProductosLimitados':
        $arr = Reportes::TreaerProductosLimitados($cantidad);
        $json_string = json_encode($arr);
        $file = './reportes/ProductosLimite.json';
        file_put_contents($file, $json_string);
        Productos::MostrarDatos($arr);
        break;
    case 'MontoTotalVenta':
        $arr = Reportes::MontoTotalVentas();
        $json_string = json_encode($arr);
        $file = './reportes/MontoTotalVenta.json';
        file_put_contents($file, $json_string);
        break;
    case 'CantidadTotalVenta':
        $arr = Reportes::TotalProductoVendido(104, 1003);
        $json_string = json_encode($arr);
        $file = './reportes/CantidadTotalVendida.json';
        file_put_contents($file, $json_string);
        var_dump($arr);
        break;
    case 'FiltroLocalidad':
        $arr = Reportes::UsuarioFiltradoLocalidad('Quilmes');
        $json_string = json_encode($arr);
        $file = './reportes/FiltroXLocalidad.json';
        file_put_contents($file, $json_string);
        var_dump($arr);
        break;
    case 'FiltroPorLetras':
        $arr = Reportes::FiltradoPorLetras('Ronaldo');
        $json_string = json_encode($arr);
        $file = './reportes/FiltroPorNombreApellido.json';
        file_put_contents($file, $json_string);
        var_dump($arr);
        break;
    case 'FiltradoPorFecha':
        $arr = Reportes::FiltradoPorFechas("2020-01-10" , "2020-10-10");
        $json_string = json_encode($arr);
        $file = './reportes/FiltroPorFechas.json';
        file_put_contents($file, $json_string);
        // var_dump($arr);
        break;


    default:
        'err';
        break;
}
