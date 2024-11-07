<?php
include 'includes/alertas.php';
include 'includes/formato_error.php';

try {
    /**
     * Incluimos la lógica de conexión, de esta forma evitanmos copiar y pegar la misma
     * y la podemos reutilizar donde realicemos otra operación
     */
    include 'includes/conexion_mariadb.php';
    /**
     * Verificamos si estamos procesando un método "POST"
     */
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        /**
         * Tomamos los valores del formulario post y los cargamos en variables locales
         */
        $username = $_POST['username'];
        $password = $_POST['password'];
        /**
         * Se toma por defecto activo a todo usuario registrado
         */
        $status = 1;
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        /**
         * Creamos la query de inserción:
         */
        $sql = "INSERT INTO usersdw (username, password, status, email, telephone, firstname, lastname) VALUES (?, ?, ?, ?, ?, ?, ?)";
        /**
         * Generamos una consulta utilizando "prepare" que es el equivalente a PreparedStatement de java
         * genera una consulta sensilla que nos permite ingresar parametros de tipo en las consultas
         * y además permite evitar tener ataques de inyección SQL.
         */
        $stmt = $conn->prepare($sql);

        /**
         * Ejecutamos la consulta.
         * Para cargar los parámetros de la consulta, que son nuestras variables delcaradas, en la consulta,
         * utilizamos las variables locales definidas.
         * Colocamos la primera letra de todas las cadenas en mayúscula utilizando ucfirst
         * Si es correo convertimos su cadena entera en minúscula utilizando strtolower
        */
        $stmt->execute([$username, $password, $status, strtolower($email), $telephone, ucfirst($firstname), ucfirst($lastname)]);
        header("Location: view_list_users.php?status=save");
        exit;
    }
} catch (Exception $ex) {
    $error_message = formatErrorMessage($ex->getMessage());
    $query_string = http_build_query(array(
        'error' => $error_message,
        'username' => $username,
        'email' => $email,
        'telephone' => $telephone,
        'firstname' => $firstname,
        'lastname' => $lastname
    ));
    header("Location: view_save_user.php?" . $query_string);
    exit;
    // showToast("Error: " . $ex->getMessage(), "danger");
    // $error_message = "Error: " . $ex->getMessage();
}