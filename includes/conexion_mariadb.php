<?php
include "model/config.php";
// $host = "localhost";
// $usuario = "root";
// $pass = "Donna*103";
// $base_datos = "dwdemo";

try {
    include "install.php";
    $database = new Connection();

    /**
     * Creamos la cadena de conexión para la base de datos
     */
    // $url = "mysql:host=$host;dbname=$base_datos;charset=utf8mb4"; 
    $options = [ 
        /**
         * Configuramos PDO para que lance errores en caso de algun problema
         */
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        /**
         * Configuramos PDO, para que las respuestas tengan formato de array
         */
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
        /**
         * Deshabilitamos perparacion de consultas, para usar la prepración que nos brinda
         * mysql de manera nativa
         */
        PDO::ATTR_EMULATE_PREPARES => false, 
    ]; 
    $conn = new PDO($database->getUrlConnection(), $database->getUser(), $database->getPass(), $options);

}catch (PDOException $ex) {
    /**
     * Propagación de excepcones: Si capturamos una excepción, de tipo Exception
     * lanzamos la propiedad getMessage() que nos devuelve el mensaje de error
     * de la excepción capturada.
     */
    throw new Exception($ex->getMessage());
}

?>