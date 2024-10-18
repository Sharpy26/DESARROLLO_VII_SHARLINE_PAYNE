<?php
include 'config_sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Carrito</title>
</head>
<body>
    <h1>Tu Carrito</h1>
    <ul>
        <?php
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            $total = 0;
            foreach ($_SESSION['carrito'] as $id => $item) {
                echo "<li>" . htmlspecialchars($item['nombre']) . " - $" . number_format($item['precio'], 2) . " x " . $item['cantidad'] .
                     " <form action='eliminar_del_carrito.php' method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='submit' value='Eliminar'>
                     </form></li>";
                $total += $item['precio'] * $item['cantidad'];
            }
            echo "<p>Total: $" . number_format($total, 2) . "</p>";
            echo "<a href='checkout.php'>Checkout</a>";
        } else {
            echo "<li>Tu carrito está vacío.</li>";
        }
        ?>
    </ul>
    <a href="productos.php">Seguir Comprando</a>
</body>
</html>