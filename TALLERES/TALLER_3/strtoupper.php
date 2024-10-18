
<?php
// Ejemplo básico de strtoupper()
$textoMixto = "HoLa MuNdO";
$textoMayusculas = strtoupper($textoMixto);
echo "Texto original: $textoMixto
";
echo "Texto en mayúsculas: $textoMayusculas
";

// Ejemplo con una frase
$frase = "php es un lenguaje de programación";
$fraseMayusculas = strtoupper($frase);
echo "
Frase original: $frase
";
echo "Frase en mayúsculas: $fraseMayusculas
";

// Ejercicio: Convierte el nombre de tu ciudad y país a mayúsculas
$ciudad = "Arraijan";
$pais = "Panamá";
$ciudadMayusculas = strtoupper($ciudad);
$paisMayusculas = strtoupper($pais);
echo "
Tu ciudad en mayúsculas: $ciudadMayusculas
";
echo "Tu país en mayúsculas: $paisMayusculas
";

// Bonus: Crear un encabezado para un documento
function crearEncabezado($texto) {
    return str_pad(strtoupper($texto), strlen($texto) + 4, "*", STR_PAD_BOTH);
}

$tituloDocumento = "Informe importante";
echo "
" . crearEncabezado($tituloDocumento) . "
";

// Extra: Convertir un array de strings a mayúsculas
$frutas = ["manzana", "banana", "cereza", "dátil"];
$frutasMayusculas = array_map('strtoupper', $frutas);
echo "
Frutas originales:
";
print_r($frutas);
echo "Frutas en mayúsculas:
";
print_r($frutasMayusculas);

// Desafío: Crea una función que convierta a mayúsculas solo la primera letra de cada palabra
function primerLetraMayuscula($frase) {
    $palabras = explode(" ", strtolower($frase));
    $palabrasModificadas = array_map(function($palabra) {
        return strtoupper(substr($palabra, 0, 1)) . substr($palabra, 1);
    }, $palabras);
    return implode(" ", $palabrasModificadas);
}

$fraseOriginal = "esta es una frase de prueba";
$fraseModificada = primerLetraMayuscula($fraseOriginal);
echo "
Frase original: $fraseOriginal
";
echo "Frase modificada: $fraseModificada
";
?>
      