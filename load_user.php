<?php
include 'includes/formato_error.php';
session_start();

try{
    include 'includes/conexion_mariadb.php';

    /**
     * Verificamos si nos han pasado un id
     */
    if (!isset($_GET['id']) || empty($_GET['id'])){
        throw new Exception("No se ha proporcionado un ID de usuario.");
    }

    $id = $_GET['id'];

    /**
     * Query buscar todos los datos del usuario por id
     */
    $sql = "SELECT * FROM usersdw WHERE id = ?";
    $stmt = $conn->prepare($sql);
    /**
     * Ejecutamos la consulta ypasamos la variable id
     */
    $stmt->execute([$id]);
    /**
     * Recuperamos los datos de la consulta
     */
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    /**
     * Validamos que encontramos al usaurio
     */
    if (!$user) {
        throw new Exception("Usuario no encontrado.");
    }

    /**
     * Cerramos conexión
     */
    $conn = null;

}catch(Exception $ex){
    $error_message = formatErrorMessage($ex->getMessage());
    $query_string = 'error=' . urlencode($error_message);
    header("Location: view_update_user.php?" . $query_string);
    exit;
}
?>