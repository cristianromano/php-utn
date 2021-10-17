<?php

require_once "./clases/usuarios.php";
require_once "productos.php";


// Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
// POST .

// Verificar que el usuario y el producto exista y tenga stock.
// crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
// carga los datos necesarios para guardar la venta en un nuevo renglón.
// Retorna un :

// “venta realizada”Se hizo una venta
// “no se pudo hacer“si no se pudo hacer
// Hacer los métodos necesarios en las clases

class Venta{


    public $id_producto;
    public $id_usuario;
    public $cantidad;
    public $fecha_de_venta;


    public static function crearVenta(int $id_producto , int $cantidad , int $id_usuario){
        $venta = new Venta();
        $venta->id_producto = $id_producto;
        $venta->id_usuario = $id_usuario;
        $venta->cantidad = $cantidad;
        $venta->fecha_de_venta = date("Y-m-d");

        return $venta;
    }

    public function __construct() {
       
    }


    public static function verificarVenta($venta){
        $arrVenta = json_decode(file_get_contents('./archivos/ventas.json',true));
        $productos = Productos::ObtenerProductosJson();
        $usuarios = Usuario::ObtenerUsuariosJson();
        $flag = 0;
        // var_dump($usuarios);
        $cadena = '';
        foreach ($usuarios as $usuario) {
            if ($usuario['_id'] == $venta->id_usuario) {
               $cadena .= 'el usuario existe ';
               $flag = 1;
               break;
            }
        }

        if ($flag == 1) {
            foreach ($productos as $producto) {
                if( strcmp($producto['codigo'] , $venta->codigo_producto) == 0){
                    $cadena .= ',el producto existe';
                    if ( ($producto['stock'] - $venta->cantidad_items) > 0 ) {
                       $cadena .= ' y tiene stock';
                       array_push($arrVenta,$venta);
                       $producto['stock'] = $venta->cantidad_items;
                       Productos::EliminarStockArr($producto);                   
                       Venta::guardarJSON($arrVenta);
                       break;
                    }else{
                        $cadena .= ',no tiene stock';
                    }
                }
            }
        }else{
            echo 'el usuario no existe';
        }

        echo $cadena;

    }

    public static function guardarJSON($objeto)
    {
        // MODIFICADO PARA GUARDARLO EN REPORTES , ARCHIVOS CARPETA ORIGINAL
        $json_string = json_encode($objeto);
        $file = './archivos/ventas.json';
        file_put_contents($file, $json_string);       
    }

    public static function leerJSON()
    {
        $datos_ventas = file_get_contents('./archivos/ventas.json');
        $arrayVentas = json_decode($datos_ventas, true);
        echo '<ul>';
        foreach ($arrayVentas as $ventas) {
            echo '1';
            // echo "<li>nombre:" . $producto['nombre'] . " codigo: " . $producto['codigo'] . " ID:" . $producto['id'] .
            //     " Tipo:" . $producto['tipo'] . " Stock:" . $producto['stock'] . " Precio:" . $producto['precio'] . "</li>";
        }
        echo '<ul>';
    }

    public static function TraerTodasLasVentas()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM venta");
			if ($consulta->execute()){
                 return $consulta->fetchAll(PDO::FETCH_CLASS, "Venta");
            }else{
                echo 'err';
            }						
	}

    public static function MostrarDatos($arrVenta){
        $cadena = "<ul>";
        // Venta::guardarJSON($arrVenta);
        foreach ($arrVenta as $x) {
           $cadena.= "<li>". 
           "ID Producto:".$x->id_producto . " " .
           "Fecha de Venta:".$x->fecha_de_venta . " " .
           "ID Usuario:".$x->id_usuario . " " .
           "Cantidad de Items:".$x->cantidad . " " 
            ."</li>";
        }
        $cadena.= "</ul>";
        echo $cadena;
    }

    public function InsertarVenta()
    {           //`venta`(`id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`)
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO venta(id_producto,id_usuario,cantidad,fecha_de_venta) 
               VALUES (:id_producto,:id_usuario,:cantidad,:fecha_de_venta)");
        $consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_INT);
        $consulta->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
        $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
        $consulta->bindValue(':fecha_de_venta', $this->fecha_de_venta, PDO::PARAM_STR);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function RealizarVenta(){
        $arrUsuarios = Usuario::TraerTodosLosUsuarios();
        $arrProductos = Productos::TraerTodosLosProductos();
        $cadena = '';
        $flag = 0;

        foreach ($arrUsuarios as $usuario) {
            if ($usuario->id_usuario == $this->id_usuario) {
               $cadena .= 'el usuario existe ';
               $flag = 1;
               break;
            }
        }

        if ($flag == 1) {
            foreach ($arrProductos as $producto) {
                if( strcmp($producto->id , $this->id_producto) == 0){
                    $cadena .= ',el producto existe';
                    if ( ($producto->stock - $this->cantidad) > 0 ) {
                       $cadena .= ' y tiene stock';
                       $producto->stock -= $this->cantidad;
                       $producto->ModificarStock(); 
                       $this->InsertarVenta();
                       break;
                    }else{
                        $cadena .= ',no tiene stock';
                    }
                }
            }
        }else{
            echo 'el usuario no existe';
        }

        echo $cadena;

    }
    
    
}
