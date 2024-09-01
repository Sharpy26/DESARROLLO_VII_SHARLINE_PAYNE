
<?php
$a = 10;
$b = 3;

echo "<h2>Operadores Aritméticos</h2>";
echo "Variables: a = $a, b = $b<br><br>";

echo "Suma (+): " . ($a + $b) . "<br>";
echo "Resta (-): " . ($a - $b) . "<br>";
echo "Multiplicación (*): " . ($a * $b) . "<br>";
echo "División (/): " . ($a / $b) . "<br>";
echo "Módulo (resto) (%): " . ($a % $b) . "<br>";
echo "Exponenciación (**): " . ($a ** $b) . "<br>";

// Demostración de la precedencia de operadores
echo "Precedencia de operadores: " . (5 + 3 * 2) . "<br>";
echo "Uso de paréntesis para cambiar la precedencia: " . ((5 + 3) * 2) . "<br>";

// División entera
echo "División entera (intdiv): " . intdiv($a, $b) . "<br>";

// Incremento y decremento
$c = 5;
echo "Valor original de c: $c<br>";
echo "Post-incremento (c++): " . $c++ . "<br>";
echo "Valor de c después del post-incremento: $c<br>";
echo "Pre-incremento (++c): " . ++$c . "<br>";
echo "Valor final de c: $c<br>";
?>
    
