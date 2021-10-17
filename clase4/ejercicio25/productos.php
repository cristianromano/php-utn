<?php

// Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
// ,
// crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).

// crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
// si ya existe el producto se le suma el stock , de lo contrario se agrega al documento en un
// nuevo renglón
// Retorna un :
// “Ingresado” si es un producto nuevo
// “Actualizado” si ya existía y se actualiza el stock.
// “no se pudo hacer“si no se pudo hacer
// Hacer los métodos necesarios en la clase

class Productos
{
    public string $codigo;
    public string $nombre;
    public string $tipo;
    public int $stock;
    public float $precio;
    public int $id;

    public function __construct(
        string $codigo = null,
        string $nombre = null,
        string $tipo = null,
        int $stock = null,
        float $precio = null
    ) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
        $this->id = rand(1, 10000);
    }


    public static function guardarJSON($objeto)
    {
        $json_string = json_encode($objeto);
        $file = './archivos/productos.json';
        file_put_contents($file, $json_string);

        // $archivoJSON = fopen('./archivos/productos.json', 'w');
        // $objetoJSON = json_encode($objeto);
        // fwrite($archivoJSON, $objetoJSON);
        // fclose($archivoJSON);        
    }

    public static function leerJSON()
    {
        $datos_productos = file_get_contents('./archivos/productos.json');
        $arrayProductos = json_decode($datos_productos, true);
        echo '<ul>';
        foreach ($arrayProductos as $producto) {
            echo "<li>nombre:" . $producto['nombre'] . " codigo: " . $producto['codigo'] . " ID:" . $producto['id'] .
                " Tipo:" . $producto['tipo'] . " Stock:" . $producto['stock'] . " Precio:" . $producto['precio'] . "</li>";
        }
        echo '<ul>';
    }


    public static function ObtenerProductosJson()
    {
        // $nombreArchivo = './archivos/productos.json';
        // $arrayUsuarios = array();
        // $archivo = fopen($nombreArchivo, 'r');
        // while (!feof($archivo)) {
        //     $linea = fgets($archivo);
        //     $usuario = json_decode($linea, true);
        //     array_push($arrayUsuarios, $usuario);
        // }
        // fclose($archivo);
        $datos_productos = file_get_contents('./archivos/productos.json');
        $arrayProductos = json_decode($datos_productos, true);
         return $arrayProductos;
    }


    public static function verificarJSON($producto)
    {
        $retorno = false;
        $arrAux = array();
        $datos_productos = file_get_contents('./archivos/productos.json');
        $arrayProductos = json_decode($datos_productos, true);
        foreach ($arrayProductos as $prod) {
            if (strcmp($prod['codigo'], $producto->codigo) == 0) {
                echo 'ya existe , se agrega stock';
                $prod['stock'] += $producto->stock;
                array_push($arrAux,$prod);
                $retorno = true;
            }else{
                array_push($arrAux,$prod);
            }
        }

        $json_string = json_encode($arrAux);
        $file = './archivos/productos.json';
        file_put_contents($file, $json_string);
        
        return $retorno;
    }

    public static function EliminarStock($producto)
    {
        $retorno = false;
        $arrAux = array();
        $datos_productos = file_get_contents('./archivos/productos.json');
        $arrayProductos = json_decode($datos_productos, true);
        foreach ($arrayProductos as $prod) {
            if (strcmp($prod['codigo'], $producto->codigo) == 0) {
                echo 'se quita stock';
                $prod['stock'] -= $producto->stock;
                array_push($arrAux,$prod);
                $retorno = true;
            }else{
                array_push($arrAux,$prod);
            }
        }

        $json_string = json_encode($arrAux);
        $file = './archivos/productos.json';
        file_put_contents($file, $json_string);
        
        return $retorno;
    }

    public function setStock($producto)
    {
        $this->stock = $producto->stock;
    }
}


?>