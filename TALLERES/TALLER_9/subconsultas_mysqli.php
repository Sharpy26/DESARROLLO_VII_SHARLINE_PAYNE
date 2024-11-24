
<?php
require_once "config_mysql.php";

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

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Productos con precio mayor al promedio de su categoría:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Producto: {$row['nombre']}, Precio: {$row['precio']}, ";
        echo "Categoría: {$row['categoria']}, Promedio categoría: {$row['promedio_categoria']}<br>";
    }
    mysqli_free_result($result);
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

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Clientes con compras superiores al promedio:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Cliente: {$row['nombre']}, Total compras: {$row['total_compras']}, ";
        echo "Promedio general: {$row['promedio_ventas']}<br>";
    }
    mysqli_free_result($result);
}

mysqli_close($conn);



//3. Productos que nunca antes se compraron
$sql = "SELECT * 
FROM productos 
WHERE NOT EXISTS (
    SELECT 1 
    FROM detalles_venta 
    WHERE detalles_venta.producto_id = productos.id
)";


$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>productos que se compraron:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Producto: {$row['nombre']}";
      
    }
    mysqli_free_result($result);
}


$sql = "SELECT 
    categorias.nombre    AS categoria,
    SUM(productos.stock) AS numero_de_productos,
    SUM(productos.precio * productos.stock) AS total_inventario
FROM 
    categorias,
    productos 
WHERE categorias.id = productos.categoria_id
GROUP BY categorias.id, categorias.nombre";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>productos que se compraron:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "CATEGORIA : {$row['CATEGORIA']}";
        echo "STOCK : {$row['STOCK']}";
        echo "TOTAL: {$row['TOTAL']}";
      
    }
    mysqli_free_result($result);
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

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>clientes que han comprado todos los productos de la categoría especificada:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID : {$row['ID']}"."NOMBRE :  {$row['NOMBRE']}";
    }
    mysqli_free_result($result);
}



mysqli_close($conn);








?>