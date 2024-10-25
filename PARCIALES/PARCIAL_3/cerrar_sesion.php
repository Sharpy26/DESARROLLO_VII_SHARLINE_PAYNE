
<?php
session_start();

// Cerra todas las variables de sesión
$_SESSION = array();

// Cerrar la sesión
session_destroy();

echo "Sesión finalizada.";
?>