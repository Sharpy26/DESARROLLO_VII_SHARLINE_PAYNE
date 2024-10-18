<?php
include 'config_sesion.php';

// Lista de productos
$productos = [
    ['id' => 1, 'nombre' => 'Producto 1', 'precio' => 10.00],
    ['id' => 2, 'nombre' => 'Producto 2', 'precio' => 20.00],
    ['id' => 3, 'nombre' => 'Producto 3', 'precio' => 30.00],
    ['id' => 4, 'nombre' => 'Producto 4', 'precio' => 40.00],
    ['id' => 5, 'nombre' => 'Producto 5', 'precio' => 50.00],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>
    <ul>
        <?php foreach ($productos as $producto): ?>
            <li>
                <?php echo htmlspecialchars($producto['nombre']); ?> - $<?php echo number_format($producto['precio'], 2); ?>
                <form action="agregar_al_carrito.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                    <input type="submit" value="Añadir al Carrito">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="ver_carrito.php">Ver Carrito</a>
</body>
</html>