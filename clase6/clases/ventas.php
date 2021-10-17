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

    public $id_venta;
    public $codigo_producto;
    public $id_usuario;
    public $cantidad_items;

    public function __construct(string $codigo_producto = null , int $cantidad_items = 0 , int $id_usuarios = 0 ) {
        $this->codigo_producto = $codigo_producto;
        $this->cantidad_items = $cantidad_items;
        $this->id_venta = rand(1,10000);
        $this->id_usuario = $id_usuarios;
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

    // public $id_venta;
    // public $codigo_producto;
    // public $id_usuario;
    // public $cantidad_items;

    public static function MostrarDatos($arrVenta){
        $cadena = "<ul>";
        foreach ($arrVenta as $x) {
           $cadena.= "<li>". 
           "ID Venta:".$x->id_venta . " " .
           "Codigo Producto:".$x->codigo_producto . " " .
           "ID Usuario:".$x->id_usuario . " " .
           "Cantidad de Items:".$x->cantidad_items . " " 
            ."</li>";
        }
        $cadena.= "</ul>";
        echo $cadena;
    }
    
    
}
