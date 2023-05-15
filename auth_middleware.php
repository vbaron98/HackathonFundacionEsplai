<?php

// Middleware de autenticación
function authMiddleware() {
    // Verificar si el usuario está autenticado
    if (isset($_COOKIE['auth_token'])) {
        return true;
    }else{
        http_response_code(401);
        echo 'Error: Acceso no autorizado. Debes iniciar sesión.';
        return false;
    }
}

?>
