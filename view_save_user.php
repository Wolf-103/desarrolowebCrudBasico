<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-3">Agregar Usuario</h1>
        <form method="POST" action="insert_user.php">
            <input type="text" name="username" placeholder="Username" class="form-control mb-2" required
                value="<?php echo isset($_GET['username']) ? htmlspecialchars($_GET['username']) : ''; ?>"
                minlength="4" maxlength="45">
            <input type="password" name="password" placeholder="Password" class="form-control mb-2" required minlength="16" maxlength="60">
            <input type="email" name="email" placeholder="Email" class="form-control mb-2"
                value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>"
                maxlength="255">
            <input type="text" name="telephone" placeholder="Telephone" class="form-control mb-2" required
                value="<?php echo isset($_GET['telephone']) ? htmlspecialchars($_GET['telephone']) : ''; ?>"
                minlength="7" maxlength="12">
            <input type="text" name="firstname" placeholder="First Name" class="form-control mb-2" required
                value="<?php echo isset($_GET['firstname']) ? htmlspecialchars($_GET['firstname']) : ''; ?>"
                minlength="4" maxlength="45">
            <input type="text" name="lastname" placeholder="Last Name" class="form-control mb-2" required
                value="<?php echo isset($_GET['lastname']) ? htmlspecialchars($_GET['lastname']) : ''; ?>"
                minlength="4" maxlength="45">
            <div>
                <button type="submit" class="btn btn-primary">Agregar</button>
                <a class="btn btn-secondary" href="view_list_users.php">Cancelar</a>
            </div>
        </form>
        <?php
        include 'includes/alertas.php';

        if (isset($_GET['status']) && $_GET['status'] === 'success') {
            showToast(htmlspecialchars(urldecode($_GET['status'])), "success");
        } elseif (isset($_GET['error'])) {
            showToast(htmlspecialchars(urldecode($_GET['error'])), "danger");
        }
        ?>
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