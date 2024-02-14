<?php

class Libros {

    /**
     * Establece la conexion con la base de datos
     * @param mixed $servidor
     * @param mixed $usuario
     * @param mixed $contrasena
     * @param mixed $base_de_datos
     * @return mysqli|null
     */
    public function conexion($servidor, $usuario, $contrasena, $base_de_datos) {

        try {
                $mysqli = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);
        } catch (mysqli_sql_exception $e) {
                return null;
        }

        return $mysqli;

    }

    /**
     * Obtiene los libros filtrados segun el titulo
     * @param mixed $con
     * @param mixed $busqueda
     * @return array|null
     */
    public function consultarLibros($con, $busqueda) {
        try {
            $query = "SELECT titulo FROM libro WHERE titulo LIKE '%$busqueda%'";
            $resultado = $con->query($query);
            $libros = [];
            while ($libro = $resultado->fetch_object()) {
                $libros[] = $libro;
            }
            return $libros;
        } catch (mysqli_sql_exception $e) {
            return null;
        }
    }
}

?>
