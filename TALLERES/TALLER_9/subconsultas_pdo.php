<?php
require_once "config_pdo.php";

try {
    // 1. Productos que tienen un precio mayor al promedio de su categoría
    $sql = "SELECT p.nombre, p.precio, c.nombre as categoria,
            (SELECT AVG(precio) FROM productos WHERE categoria_id = p.categoria_id) as promedio_categoria
            FROM productos p
            JOIN categorias c ON p.categoria_id = c.id
            WHERE p.precio > (
                SELECT AVG(precio)
                FROM productos p2
                WHERE p2.categoria_id = p.categoria_id
            )";

    $stmt = $pdo->query($sql);

    echo "<h3>Productos con precio mayor al promedio de su categoría:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}, Precio: {$row['precio']}, ";
        echo "Categoría: {$row['categoria']}, Promedio categoría: {$row['promedio_categoria']}<br>";
    }

    // 2. Clientes con compras superiores al promedio
    $sql = "SELECT c.nombre, c.email,
            (SELECT SUM(total) FROM ventas WHERE cliente_id = c.id) as total_compras,
            (SELECT AVG(total) FROM ventas) as promedio_ventas
            FROM clientes c
            WHERE (
                SELECT SUM(total)
                FROM ventas
                WHERE cliente_id = c.id
            ) > (
                SELECT AVG(total)
                FROM ventas
            )";

    $stmt = $pdo->query($sql);

    echo "<h3>Clientes con compras superiores al promedio:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Cliente: {$row['nombre']}, Total compras: {$row['total_compras']}, ";
        echo "Promedio general: {$row['promedio_ventas']}<br>";
    }

    // 3. Productos que no se han comprado
    $sql = "SELECT * 
            FROM productos   
            WHERE NOT EXISTS (
                SELECT 1 
                FROM detalles_venta 
                WHERE detalles_venta.producto_id = productos.id
            )";

    $stmt = $pdo->query($sql);

    echo "<h3>Productos que no se han comprado:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}<br>";
    }


    $sql = "SELECT 
    categorias.nombre    AS CATEGORIA,
    SUM(productos.stock) AS STOCK,
    SUM(productos.precio * productos.stock) AS TOTAL
    FROM 
    categorias,
    productos 
    WHERE categorias.id = productos.categoria_id
    GROUP BY categorias.id, categorias.nombre";

    
    $stmt = $pdo->query($sql);
    
    echo "<h3>Listar las categorías con el número de productos y el valor total del inventario:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "CATEGORIA : {$row['CATEGORIA']}<br>";
        echo "STOCK : {$row['STOCK']}<br>";
        echo "TOTAL: {$row['TOTAL']}<br>";   
    }

    $sql = "SELECT 
        c.id     AS ID,
        c.nombre AS NOMBRE
    FROM clientes c,
       ventas v,
       detalles_venta d,
       productos p
    WHERE c.id           = v.cliente_id
    AND   v.id           = d.venta_id
    AND   d.producto_id  = p.id
    AND   p.categoria_id = 2
    GROUP BY c.id ";
    
    $stmt = $pdo->query($sql);
    
    echo "<h3>clientes que han comprado todos los productos de la categoría especificada:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID : {$row['ID']}  "."NOMBRE :  {$row['NOMBRE']}<br>";
    }


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>