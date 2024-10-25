<?php
function validarNombre($usuario) {
    // Que tenga al menos 5 caracteres solo letras y números
    return preg_match('/^[a-zA-Z0-9]{5,}$/', $usuario);
}

function validarContrasena($password) {
    // Que la contraseña mantenga al menos 8 carecteres 
    return strlen($password) >= 8;
}

function validarPerfil($perfil) {
    return in_array($perfil, ['estudiante', 'profesor']);
}
?>