<?php
if(!function_exists('formatErrorMessage')){
    function formatErrorMessage($errorMessage){
        /**
         * Pasamos a minúscula
         */
        $errorLower = strtolower($errorMessage);
        $errorPatterns = [
            'duplicate entry' => [
                'email_usuario_unique' => "El correo electrónico ya está registrado en el sistema. Por favor, utiliza otro.",
                'username_unique' => "El nombre de usuario ya está en uso. Por favor, elige otro.",
                'default' => "Ya existe un registro con estos datos en el sistema."
            ],
            'foreign key constraint fails' => "Error en la relación con otros datos del sistema.",
            'data too long' => "Uno de los campos excede la longitud máxima permitida.",
            'cannot be null' => "Todos los campos marcados con * son obligatorios.",
        ];

        /**
         * recorremos los patrones en búsqueda de coincidencia con el mensaje de error
         */
        foreach ($errorPatterns as $pattern => $messages) {
            /**
             * Utilizamos strops para buscar patrones en un mensaje
             * pasamos como parámetro el mensaje a analizar y el patron
             * devuelve un boolean
             */
            if (strpos($errorLower, $pattern) !== false) {
                /**
                 * Si es un error de elemento duplicado, iteramos dentro del patron 
                 * de duplicate entry
                 */
                if ($pattern === 'duplicate entry') {
                    if (strpos($errorLower, 'email_usuario_unique') !== false) {
                        return $messages['email_usuario_unique'];
                    } elseif (strpos($errorLower, 'username_unique') !== false) {
                        return $messages['username_unique'];
                    }
                    return $messages['default'];
                }
                return $messages;
            }
        }
        /**
         * Si no esta en la lista devolvemos un mensaje genérico
         */
        return "Error al insertar el registro. Detalle del error: " . $errorMessage . ")";
    }
}
?>