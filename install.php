<?php

try {
    /**
     * Creamos conexión sin nombre de la base de datos
     */
    $database = new Connection();
    $dbValidate = $database->getUrlConnection(false);
    $conn = new PDO($dbValidate, $database->getUser(), $database->getPass(), [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    /**
     * Verificamos si la base de datos existe
     */
    if (!existsDataBase($conn, $database->getDatabaseName())) {
        createDataBase($conn, $database->getDatabaseName(), $database->getCharset());
    }

    /**
     * Creamos conexion nueva con nombre de la base de datos
     */
    $dbValidate = $database->getUrlConnection(true);
    $conn = new PDO($dbValidate, $database->getUser(), $database->getPass(), [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    /**
     * Creamos tabla e insertamos datos de prueba
     */
    if(!tableExists($conn, 'usersdw')){
        createTable($conn);
    }
    if(dataDemoIsEmpty($conn)){
        insert_data_demo($conn);
    }

} catch (Exception $ex) {
    throw new Exception("Error al intentar crear la base de datos/tabla/datos de prueba de usuarios en la base de datos: " . $database->getDatabaseName() . "\n
    Detalle error: " . $ex->getMessage());
}

function createDataBase($conn){
    try{
        $file_create_database = file_get_contents("data/create_database.sql");
        $conn->exec($file_create_database);
    } catch (PDOException $ex) {
        throw new Exception("Error al intentar crear la base de datos: " . $ex->getMessage());
    }
}

function createTable($conn) {
    try {
        $file_create_table = file_get_contents("data/create_table.sql");
        $conn->exec($file_create_table);
    } catch (PDOException $ex) {
        throw new Exception("Error al intentar crear la tabla: " . $ex->getMessage());
    }
}

function insert_data_demo($conn) {
    try{
        $file_insert = file_get_contents("data/insert_data_demo.sql");
        $conn->exec($file_insert);
    } catch (PDOException $ex) {
        throw new Exception("Error al intentar insertar datos en la tabla usersdw: " . $ex->getMessage());
    }
}

function tableExists($conn, $tableName) {
    try {
        $query = "SHOW TABLES LIKE '$tableName'";
        $stmt = $conn->query($query);
        return $stmt->fetch() !== false;
    } catch (PDOException $ex) {
        throw new Exception("Error al verificar si existe la tabla: $tableName. Detalle: " . $ex->getMessage());
    }
}

function existsDataBase($conn, $databasename) {
    try{
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$databasename]);
        return $stmt->fetch() !== false;
    } catch (PDOException $ex) {
        throw new Exception("Error al verificar si existe la base de datos de nombre: $databasename. Detalle:  ". $ex->getMessage());
    }
}

function dataDemoIsEmpty($conn) {
    try{
        $query = "SELECT COUNT(*) FROM usersdw";
        $stmt = $conn->query($query);
        $rows =$stmt->fetchColumn();
        return $rows == 0;
    } catch (PDOException $ex) {
        throw new Exception("Error al verificar si existe datos en la tabla userdw. Detalle:  ". $ex->getMessage());
    }
}

?>