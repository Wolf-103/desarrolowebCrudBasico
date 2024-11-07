<?php
include 'includes/conexion_mariadb.php';

try {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        /**
         * Query para eliminar por id
         */
        $sql = "DELETE FROM usersdw WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        $conn = null;
        header("Location: view_list_users.php?status=deleted");
        exit;
    } else {
        throw new Exception("ID del usuario no proporcionado.");
    }
} catch (Exception $ex) {
    $error_message = urlencode($ex->getMessage());
    header("Location: view_list_users.php?error={$error_message}");
    exit;
}
