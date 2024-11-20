<?php
include 'includes/alertas.php';

if (isset($_GET['status']) && $_GET['status'] === 'save') {
    showToast("Usuario registrado con éxito!", "success");
} elseif(isset($_GET['status']) && $_GET['status'] === 'update') {
    showToast("Datos de usuario actualziados con éxito", "success");
} elseif(isset($_GET['status']) && $_GET['status'] === 'deleted') {
    showToast("Usuario eliminado con éxito", "success");
} elseif (isset($_GET['error'])) {
    showAlert(htmlspecialchars(urldecode($_GET['error'])), "danger");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="mb-3">
            <a class="btn btn-primary" href="view_save_user.php">Nuevo</a>
            <a class="btn btn-primary m-3" href="view_findUser.html" >Buscar Usuario en Json</a>
        </div>
        <div>
            <?php include 'getAll_users.php'; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        /**
         * Necesario para mostrar el TOAST y que este desaparezca automaticamente
         * 
         */
        document.addEventListener("DOMContentLoaded", function() {
            /**
             * Capta todos los elementos de la clase "toast"
             */
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            /**
             * Itera entre los elementos encontrados, usamos el map para transformar la lista en instancias de toast de bustrap
             *  con el elemento actual de la lista y le pasa como parametro el tiempo de vida en milisegundos
             */
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl, {
                    delay: 5000
                }); // 5 segundos de duración
            });
            /**
             * Por iteramosen nuestra nueva lista con las instancias de toast
             *  y mostramos el toast con el método la funcion show.
             */
            toastList.forEach(toast => toast.show());
        });
    </script>

</body>

</html>