<?php

try {
    $database = new Connection();
    $dbValidate = "{$database->getType_database()}:host={$database->getHost()};charset={$database->getCharset()}";
    $conn = new PDO($dsn, $database->getUser(), $database->getPass(), [ 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => 
        PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false, 
    ]);
    if(existsDataBase($conn, $database->getDatabaseName())){
        $dsn = "{$database->getType_database()}:host={$database->getHost()};dbname={$database->getDatabaseName()};charset={$database->getCharset()}"; 
        $conn = new PDO($dsn, $database->getUser(), $database->getPass(), [ 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
            PDO::ATTR_EMULATE_PREPARES => false, 
        ]);
    }
} catch (Exception $ex) {
    throw new Exception("Error al intentar crear la tabla usuarios en la base de datos: " . $database->getDatabaseName() . "\n
    Detalle error: " . $ex->getMessage());
}

function createTableAndInsert($conn){
    $file_create_table = file_get_contents("data/create_table.sql");
        // $file_insert = file_get_contents("data/insert_data_demo.sql");
        $conn->exec($file_create_table);
        // $conn->exec($file_insert);
}

function existsDataBase($conn, $databasename){
    $query = "SHOW DATABASES LIKE ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$databasename]);
    return $stmt->fetch() !== false;
}

?>