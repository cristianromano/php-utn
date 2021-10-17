<?php

require_once "./clases/AccesoDatos.php";
require_once "./clases/usuarios.php";
require_once "./clases/productos.php";
require_once "./clases/ventas.php";


class Reportes
{

    // Obtener los detalles completos de todos los usuarios y poder ordenarlos alfabéticamente de forma ascendente o descendente.

    public static function TraerUsuariosOrdenados($orden)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuario ORDER BY apellido , :orden ");
        $consulta->bindValue(':orden', $orden, PDO::PARAM_STR);
        if ($consulta->execute()) {
            return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
        } else {
            echo 'err';
        }
    }

    // Obtener los detalles completos de todos los productos y poder ordenarlos alfabéticamente de forma ascendente y descendente.

    public static function TraerProductosOrdenados($orden)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM producto ORDER BY id " . $orden);
        if ($consulta->execute()) {
            return $consulta->fetchAll(PDO::FETCH_CLASS, "Productos");
        } else {
            echo 'err';
        }
    }

    // Obtener todas las compras filtradas entre dos cantidades.

    public static function TraerVentasFiltradas($cantidadUno, $cantidadDos)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM venta WHERE cantidad >= :cant1 AND cantidad <= :cant2 ");
        $consulta->bindValue(':cant1', $cantidadUno, PDO::PARAM_INT);
        $consulta->bindValue(':cant2', $cantidadDos, PDO::PARAM_INT);
        if ($consulta->execute()) {
            return $consulta->fetchAll(PDO::FETCH_CLASS, "Venta");
        } else {
            echo 'err';
        }
    }

    // Obtener la cantidad total de todos los productos vendidos entre dos fechas.

    public static function TreaerTotalProductosVendidos($fechaUno, $fechaDos)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT SUM(cantidad) AS CantidadVendidos FROM venta WHERE fecha_de_venta BETWEEN :fechaUno AND :fechaDos");
        $consulta->bindValue(':fechaUno', $fechaUno, PDO::PARAM_STR);
        $consulta->bindValue(':fechaDos', $fechaDos, PDO::PARAM_STR);

        if ($consulta->execute()) {
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } else {
            echo 'err';
        }
    }

    // Mostrar los primeros “N” números de productos que se han enviado.

    public static function TreaerProductosLimitados($limite)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM producto WHERE fecha_de_creacion LIMIT :limite");
        $consulta->bindValue(':limite', $limite, PDO::PARAM_INT);
        if ($consulta->execute()) {
            // $json_string = json_encode($consulta->fetchAll(PDO::FETCH_CLASS, "Productos"));
            // $file = './reportes/ProductosLimite.json';
            // file_put_contents($file, $json_string); 
            return $consulta->fetchAll(PDO::FETCH_CLASS, "Productos");
        } else {
            echo 'err';
        }
    }

    // Mostrar los nombres del usuario y los nombres de los productos de cada venta.

    public static function TraerUsuariosYProductos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT v.id_producto , v.id_usuario , p.nombre AS nombreProducto , u.nombre 
        FROM venta v INNER JOIN producto p ON v.id_producto = p.id INNER JOIN usuario u ON u.id_usuario = v.id_usuario ");

        if ($consulta->execute()) {
            // $json_string = json_encode($consulta->fetchAll(PDO::FETCH_CLASS, "Productos"));
            // $file = './reportes/ProductosLimite.json';
            // file_put_contents($file, $json_string); 
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } else {
            echo 'err';
        }
    }

    // Indicar el monto (cantidad * precio) por cada una de las ventas.

    public static function MontoTotalVentas()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT (v.cantidad * p.precio) AS TotalMonto ,p.codigo,p.nombre FROM venta v INNER JOIN 
        producto p ON v.id_producto = p.id");

        if ($consulta->execute()) {
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } else {
            echo 'err';
        }
    }

    // Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario (ejemplo: 104).

    public static function TotalProductoVendido($usuario, $producto)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT SUM(cantidad) AS CantidadVendida , v.id_producto , v.id_usuario
         FROM venta v WHERE v.id_producto = :producto
        AND v.id_usuario = :usuario");

        $consulta->bindValue(':usuario', $usuario, PDO::PARAM_INT);
        $consulta->bindValue(':producto', $producto, PDO::PARAM_INT);

        if ($consulta->execute()) {
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } else {
            echo 'err';
        }
    }


    // Obtener todos los números de los productos vendidos por algún usuario filtrado por localidad (ejemplo: ‘Avellaneda’).

    public static function UsuarioFiltradoLocalidad($localidad)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT SUM(cantidad) AS CantidadVendida , u.localidad 
        FROM venta v INNER JOIN usuario u ON
        v.id_usuario = u.id_usuario AND u.localidad = :localidad");

        $consulta->bindValue(':localidad', $localidad, PDO::PARAM_INT);

        if ($consulta->execute()) {
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } else {
            echo 'err';
        }
    }

    // Obtener los datos completos de los usuarios filtrando por letras en su nombre o apellido.

    public static function FiltradoPorLetras($palabra)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuario u WHERE u.nombre LIKE '%' '$palabra' '%'  OR u.apellido LIKE
         '%' '$palabra' '%'");

        $consulta->bindValue(':palabra', $palabra, PDO::PARAM_STR);

        if ($consulta->execute()) {
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } else {
            echo 'err';
        }
    }

    // Mostrar las ventas entre dos fechas del año.

    public static function FiltradoPorFechas($fecha1 , $fecha2)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT COUNT(v.id_producto)AS cantPorIDs , v.id_producto  
        FROM venta v WHERE v.fecha_de_venta BETWEEN
        :fecha1 AND :fecha2 GROUP BY v.id_producto ");

       $consulta->bindValue(':fecha1', $fecha1, PDO::PARAM_STR);
       $consulta->bindValue(':fecha2', $fecha2, PDO::PARAM_STR);

        if ($consulta->execute()) {
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } else {
            echo 'err';
        }
    }











}
