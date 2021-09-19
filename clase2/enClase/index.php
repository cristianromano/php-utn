<?php

require "funciones.php";
// require "usuario.php";
require_once "inicio.php";

saludar();

echo "</br>";

$usuario = new Usuario();

$usuario->nombre = "Cristian";

echo $usuario->nombre;
echo "</br>";

mostrarUsuario($usuario);
echo "</br>";


