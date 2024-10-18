<?php
include_once 'gestion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h1 {
            text-align: center;
        }
        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }
        table {
            width: 45%;
            border-collapse: collapse;
            font-size: 18px;
            text-align: left;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 12px;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            margin: 20px;
        }
        .ttl {
            background-color: beige;
            height: 40px;
            width: 150px;
            align-content: center;
            border-radius: 15px;
            background-color: #f2f2f2;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<h1>Lista de Productos</h1>
<div class="ttl"><?php echo 'TOTAL: $' . number_format(valorTotal()); ?></div>
<div class="container">
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php $productos = productos();
                     foreach ($productos as $producto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto['id']); ?></td>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td><?php echo '$' . number_format($producto['precio'], 2); ?></td>
                        <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div>
        <h2>Informe de Stock Bajo</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php $productosConStockBajo = filtrarStockBajo();
                     if (!empty($productosConStockBajo)): ?>
                    <?php foreach ($productosConStockBajo as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['id']); ?></td>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo '$' . number_format($producto['precio'], 2); ?></td>
                            <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">No hay productos con stock bajo</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>