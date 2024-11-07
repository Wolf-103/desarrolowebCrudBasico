<?php
include "load_user.php";
include 'includes/alertas.php';

if (isset($_GET['error'])) {
    showAlert(htmlspecialchars(urldecode($_GET['error'])), "danger");
}

/**
 * Guardamos en un array con sus valores en caso de que ocurra un error
 * y debamos recargar la pagina
 */
$user['username'] = isset($_GET['username']) ? $_GET['username'] : $user['username'];
$user['email'] = isset($_GET['email']) ? $_GET['email'] : $user['email'];
$user['telephone'] = isset($_GET['telephone']) ? $_GET['telephone'] : $user['telephone'];
$user['firstname'] = isset($_GET['firstname']) ? $_GET['firstname'] : $user['firstname'];
$user['lastname'] = isset($_GET['lastname']) ? $_GET['lastname'] : $user['lastname'];
$user['status'] = isset($_GET['status']) ? $_GET['status'] : $user['status'];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Modificar Usuario</h1>
        <form action="update_user.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">

            <div class="mb-3">
                <label for="username" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>"
                    required minlength="4" maxlength="45">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required
                    maxlength="255">
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($user['telephone']); ?>" required
                    minlength="7" maxlength="12">
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required
                    minlength="4" maxlength="45">
            </div>

            <div class="mb-3">
                <label for="lastname" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required
                    minlength="4" maxlength="45">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Estado</label>
                <select class="form-control" id="status" name="status">
                    <option value="1" <?php echo $user['status'] == 1 ? 'selected' : ''; ?>>ACTIVO</option>
                    <option value="0" <?php echo $user['status'] == 0 ? 'selected' : ''; ?>>INACTIVO</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="view_list_users.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl, {
                    delay: 5000
                });
            });
            toastList.forEach(toast => toast.show());
        });
    </script>
</body>

</html>