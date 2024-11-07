<?php

    /**
     * Alerta tipo TOAST para mensajes temporales en la esquina superior derecha de l pantalla
     * Recibe como parametro un mensaje y in tipo, según el tipo cambiamos el color del alert
     * Tipos de alerta de Bootstrap: primary, secondary, success, danger, warning, info, light, dark
     */
    if(!function_exists('showToast')){
        function showToast($message, $type) {
            echo '<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">';
            echo '<div class="toast align-items-center text-white bg-' . htmlspecialchars($type) . ' border-0" role="alert" aria-live="assertive" aria-atomic="true">';
            echo '<div class="d-flex">';
            echo '<div class="toast-body">' . htmlspecialchars($message) . '</div>';
            echo '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }

    /**
     * Recibe como parametro un mensaje y in tipo, según el tipo cambiamos el color del alert
     * Tipos de alerta de Bootstrap: primary, secondary, success, danger, warning, info, light, dark
     */
    if(!function_exists('showAlert')){
        function showAlert($message, $type) {
            echo '<div class="alert alert-' . htmlspecialchars($type) . ' alert-dismissible fade show" role="alert">';
            echo htmlspecialchars($message);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
    }
?>
