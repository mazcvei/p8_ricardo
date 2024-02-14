<?php
require("Libros.php");
// Esta API tiene dos posibilidades; Mostrar una lista de autores o mostrar la información de un autor específico.

$servidor = 'localhost';
$usuario = 'root';
$contrasena = '';
$basedatos = 'foc3';

function get_listado_libros($busqueda) {
    global $servidor, $usuario, $contrasena, $basedatos;
    $libros = new Libros();
    $con = $libros -> conexion($servidor, $usuario, $contrasena, $basedatos);
    return $libros->consultarLibros($con, $busqueda);
}

$posibles_URL = array("get_listado_libros");

$valor = "Ha ocurrido un error";

if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL))
{
  switch ($_GET["action"]) {
    case "get_listado_libros":
        $valor = get_listado_libros($_GET["busqueda"]);  
        break;
    }
}

//devolvemos los datos serializados en JSON
exit(json_encode($valor));
?>
