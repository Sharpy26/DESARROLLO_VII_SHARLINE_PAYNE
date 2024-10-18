<?php
$archivo = 'registros.json';
if (file_exists($archivo)) {
    $registros = json_decode(file_get_contents($archivo), true);
    echo "<h2>Resumen de Registros:</h2>";
    echo "<table border='1'>";
    foreach ($registros as $registro) {
        echo "<tr>";
        foreach ($registro as $campo => $valor) {
            echo "<td>" . htmlspecialchars($valor) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No hay registros disponibles.";
}
?>