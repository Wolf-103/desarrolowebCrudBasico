<?php
include 'includes/conexion_mariadb.php';
include 'model/Usuario.php';

/**
 * Si no es un método POST lanzar error
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Método no permitido.'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}
/**
 * Validar que estemos recibiendo desde POST una variable de nombre param de lo contrario
 * devolvemos null como bandera
 */
$id = $_POST['param'] ?? null;

/**
 * Validar si el id es un número y que no sea nulo
 */
if (!$id || !is_numeric($id)) {
    echo json_encode(['error' => 'ID inválido.'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    $query = "SELECT id, username, password, status, email, telephone, firstname, lastname FROM usersdw WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);

    $user = $stmt->fetch();
    if ($user) {
        $userClass = new Usuario(
            $user['id'],
            $user['username'],
            $user['password'],
            $user['status'],
            $user['email'],
            $user['telephone'],
            $user['firstname'],
            $user['lastname']
        );

        echo json_encode($userClass, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['error' => "No se encontró ningún usuario con ID $id."], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
} catch (Exception $ex) {
    echo json_encode(['error' => "Error: " . htmlspecialchars($ex->getMessage())], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
?>
