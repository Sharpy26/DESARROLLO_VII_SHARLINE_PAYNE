<?php
// 1. Crear un patrón de triángulo rectángulo usando asteriscos (*) con un bucle for.

echo "<h2>Patrón de Triángulo Rectángulo:</h2>";
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}

// 2. Utilizando un bucle while, genera una secuencia de números del 1 al 20, pero solo muestra los números impares.

echo "<h2>Números Impares del 1 al 20:</h2>";
$numero = 1;
while ($numero <= 20) {
    if ($numero % 2 != 0) { // Verifica si el número es impar
        echo $numero . "<br>";
    }
    $numero++;
}

// 3. Con un bucle do-while, crea un contador regresivo desde 10 hasta 1, pero salta el número 5.

echo "<h2>Contador Regresivo (Saltando el número 5):</h2>";
$contador = 10;
do {
    if ($contador != 5) { // Verifica si el número no es 5
        echo $contador . "<br>";
    }
    $contador--;
} while ($contador >= 1);
?>
