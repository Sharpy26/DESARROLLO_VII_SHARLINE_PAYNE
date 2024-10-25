<?php
require_once 'sanitizacion.php';
require_once 'validacion_user.php';
require_once 'BD.php';


// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = sanitizarUsuario($_POST['usuario']);
    $password = sanitizarContraseña($_POST['password']);
    $perfil = $_POST['perfil'];

    // Validar el nombre de usuario, la contraseña y el perfil
    if (validarNombre($usuario) && validarContrasena($password) && validarPerfil($perfil)) {
        // Validar si el usuario existe y la contraseña es correcta
        if (array_key_exists($usuario, $usuarios[$perfil]) && $usuarios[$perfil][$usuario] === $password) {
            echo "¡Bienvenido, " . htmlspecialchars($usuario) . " como " . htmlspecialchars($perfil) . "!";
            $_SESSION['usuario']= $usuario ;
            $_SESSION['perfil']= $perfil;
            
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Nombre de usuario, contraseña o perfil no válidos.";
    }
}
?>