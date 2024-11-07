<?php
session_start();
include 'includes/formato_error.php';
try {
    include 'includes/conexion_mariadb.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $status = $_POST['status'];

        /**
         * Query para actualizar
         */
        $sql = "UPDATE usersdw SET username=?, email=?, telephone=?, firstname=?, lastname=?, status=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, strtolower($email), $telephone, ucfirst($firstname), ucfirst($lastname), $status, $id]);

        $conn = null;
        header("Location: view_list_users.php?status=update");
        exit;
    }
} catch (Exception $ex) {
    $error_message = formatErrorMessage($ex->getMessage());
    $query_string = http_build_query(array(
        'id' => $id, 
        'error' => $error_message, 
        'username' => $username, 
        'email' => $email, 
        'telephone' => $telephone, 
        'firstname' => $firstname, 
        'lastname' => $lastname, 
        'status' => $status));
    header("Location: view_update_user.php?" . $query_string);
    exit;
}
