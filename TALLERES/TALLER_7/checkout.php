<?php
include 'config_sesion.php';

if (empty($_SESSION['carrito'])) {
    header("Location: productos.php");
    exit();
}

// Guardar el nombre del usuario en una cookie
setcookie("usuario", "Juan", time() + 86400, "/", "", true, true); // 24 horas

$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// Vaciar el carrito
$_SESSION['carrito'] = [];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>
<body>
    <h1>Gracias por tu compra!</h1>
    <p>Total de la compra: $<?php echo number_format($total, 2); ?></p>
</body>
</html>