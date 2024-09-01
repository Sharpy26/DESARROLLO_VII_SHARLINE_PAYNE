<?php
// Define las variables
$nombre_completo = "Sharline Payne"; // Reemplaza con tu nombre completo
$edad = 21; // Reemplaza con tu edad
$correo = "sharline.payne@utp.ac.pa"; // Reemplaza con tu correo electrónico
$telefono = "6865-8651"; // Reemplaza con tu número de teléfono

// Define una constante
define("OCUPACION", "Estudiante de Desarrolladora Web"); // Reemplaza con tu ocupación actual

// Muestra la información utilizando diferentes métodos
echo "<p><strong>Nombre Completo:</strong> " . $nombre_completo . "</p>";
echo "<p><strong>Edad:</strong> " . $edad . "</p>";
echo "<p><strong>Correo Electrónico:</strong> " . $correo . "</p>";
echo "<p><strong>Teléfono:</strong> " . $telefono . "</p>";
echo "<p><strong>Ocupación:</strong> " . OCUPACION . "</p>";

// También puedes usar print para imprimir la información
print "<p><strong>Nombre Completo:</strong> " . $nombre_completo . "</p>";
print "<p><strong>Edad:</strong> " . $edad . "</p>";
print "<p><strong>Correo Electrónico:</strong> " . $correo . "</p>";
print "<p><strong>Teléfono:</strong> " . $telefono . "</p>";
print "<p><strong>Ocupación:</strong> " . OCUPACION . "</p>";

// Usar printf para formatear la salida
printf("<p><strong>Nombre Completo:</strong> %s</p>", $nombre_completo);
printf("<p><strong>Edad:</strong> %d</p>", $edad);
printf("<p><strong>Correo Electrónico:</strong> %s</p>", $correo);
printf("<p><strong>Teléfono:</strong> %s</p>", $telefono);
printf("<p><strong>Ocupación:</strong> %s</p>", OCUPACION);

// Usar var_dump para mostrar tipo y valor de cada variable y constante
echo "<p><strong>Información Detallada:</strong></p>";
var_dump($nombre_completo);
var_dump($edad);
var_dump($correo);
var_dump($telefono);
var_dump(OCUPACION);
?>
