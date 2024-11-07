<?php
include 'includes/formato_error.php';

try {
    include 'includes/conexion_mariadb.php';

    /**
     * Generamos la consulta
     */
    $sql = "SELECT id, username, status, email, telephone, firstname, lastname FROM usersdw";
    /**
     * Ejecutamos laconsulta
     */
    $stmt = $conn->query($sql);
    /**
     * Obtenemos todos los resultados
     */
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /**
     * Validamos que tengamos contenido
     */
    if (count($result) > 0) {
        echo "<div class='container mt-5'>";
        echo "<h1>Lista de Usuarios</h1>";
        echo "<table class='table table-bordered'>";
        echo "<thead><tr><th>ID</th><th>Usuario</th><th>Correo ELectrónico</th><th>Teléfono</th><th>Nombre</th><th>Apellido</th><th>Estado</th><th>Opeciones</th></tr></thead>";
        echo "<tbody>";

        /**
         * Itereamos sobre cada resultado como una fila
         */
        foreach($result as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['telephone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
            echo "<td>" . (htmlspecialchars($row['status']) == 1 ? "ACTIVO" : "INACTIVO") . "</td>";
            echo "<td>";
            echo "<a href='view_update_user.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning m-2'>Modificar</a>";
            echo "<a href='delete_user.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger m-2' data-user='".htmlspecialchars($row['username'])."'>Eliminar</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
        echo "</div>";
    } else {
        echo "<p>No se encontraron usuarios</p>";
    }

    /**
     * cerramos conexión
     */
    $conn = null;
    
} catch (Exception $ex) {
    if (!isset($_GET['error'])) {
        $error_message = formatErrorMessage($ex->getMessage());
        $query_string = 'error=' . urlencode($error_message);
        header("Location: view_list_users.php?" . $query_string);
        exit;
    }
}
?>

<script>
    function confirmDelete(user) {
        if (confirm("¿Desea eliminar al usuario: " + user + "?")) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Capturamos los eventos delete con la clase btn-danger del botón
     * 
     */
    document.addEventListener("DOMContentLoaded", function() {
        var deleteLinks = document.querySelectorAll('.btn-danger');
        /**
        * recorremos los links que capturamos con el dom 
        */
        deleteLinks.forEach(function(link) {
            /**
             * Capturamos el evento click
             */
            link.addEventListener('click', function(event) {
                /**
                 * Entonces lanzamos la dunción de solicitud de confirmación de eliminación
                 * pasamos como parámetro el valor del atributo data-user del enlace.
                 * si la respuesta es false, evitamos la redirección utilizando el método
                 * event.preventDefault()
                 */
                if (!confirmDelete(link.getAttribute('data-user'))) {
                    event.preventDefault();
                }
            });
        });
    });
</script>
