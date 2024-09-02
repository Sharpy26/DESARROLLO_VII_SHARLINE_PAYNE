<?php
// Declara una variable $calificacion y asígnale un valor numérico entre 0 y 100.
$calificacion = 91; 

// Estructura if-elseif-else para determinar la letra correspondiente a la calificación
if ($calificacion >= 91) {
    $letra = 'A';
} elseif ($calificacion >= 81) {
    $letra = 'B';
} elseif ($calificacion >= 71) {
    $letra = 'C';
} elseif ($calificacion >= 61) {
    $letra = 'D';
} else {
    $letra = 'F';
}

// Imprime un mensaje que diga "Tu calificación es [letra]"
echo "Tu calificación es $letra.<br>";

// Usa el operador ternario para añadir "Aprobado" si la calificación es D o superior, o "Reprobado" si es F
$estado = ($letra === 'F') ? 'Reprobado' : 'Aprobado';
echo "Estado: $estado.<br>";

// Usa un switch para imprimir un mensaje adicional basado en la letra de la calificación
switch ($letra) {
    case 'A':
        echo "Excelente trabajo";
        break;
    case 'B':
        echo "Buen trabajo";
        break;
    case 'C':
        echo "Trabajo aceptable";
        break;
    case 'D':
        echo "Necesitas mejorar";
        break;
    case 'F':
        echo "Debes esforzarte más";
        break;
}
?>
