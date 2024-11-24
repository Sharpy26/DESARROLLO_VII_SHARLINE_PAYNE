<?php
require_once "config_pdo.php"; // Asegúrate de tener tu configuración PDO aquí

// Función para verificar cambios en el precio de un producto
function verificarCambiosPrecio($pdo, $producto_id, $nuevo_precio) {
    try {
        // Actualizar precio
        $stmt = $pdo->prepare("UPDATE productos SET precio = ? WHERE id = ?");
        $stmt->execute([$nuevo_precio, $producto_id]);
        
        // Verificar log de cambios
        $stmt = $pdo->prepare("SELECT * FROM historial_precios WHERE producto_id = ? ORDER BY fecha_cambio DESC LIMIT 1");
        $stmt->execute([$producto_id]);
        $log = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "<h3>Cambio de Precio Registrado:</h3>";
        echo "Precio anterior: $" . $log['precio_anterior'] . "<br>";
        echo "Precio nuevo: $" . $log['precio_nuevo'] . "<br>";
        echo "Fecha del cambio: " . $log['fecha_cambio'] . "<br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Función para verificar movimiento de inventario
function verificarMovimientoInventario($pdo, $producto_id, $nueva_cantidad) {
    try {
        // Actualizar stock
        $stmt = $pdo->prepare("UPDATE productos SET stock = ? WHERE id = ?");
        $stmt->execute([$nueva_cantidad, $producto_id]);
        
        // Verificar movimientos de inventario
        $stmt = $pdo->prepare("SELECT * FROM movimientos_inventario WHERE producto_id = ? ORDER BY fecha_movimiento DESC LIMIT 1");
        $stmt->execute([$producto_id]);
        $movimiento = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "<h3>Movimiento de Inventario Registrado:</h3>";
        echo "Tipo de movimiento: " . $movimiento['tipo_movimiento'] . "<br>";
        echo "Cantidad: " . $movimiento['cantidad'] . "<br>";
        echo "Stock anterior: " . $movimiento['stock_anterior'] . "<br>";
        echo "Stock nuevo: " . $movimiento['stock_nuevo'] . "<br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Función para verificar la validación de stock antes de actualizar
function verificarValidacionStock($pdo, $producto_id, $nueva_cantidad) {
    try {
        // Intentar actualizar stock
        $stmt = $pdo->prepare("UPDATE productos SET stock = ? WHERE id = ?");
        $stmt->execute([$nueva_cantidad, $producto_id]);
    } catch (PDOException $e) {
        // Capturar error de validación
        echo "Error: " . $e->getMessage();
    }
}

// Función para verificar la actualización de ventas
function verificarCambiosVenta($pdo, $venta_id, $nuevo_estado) {
    try {
        // Actualizar estado de la venta
        $stmt = $pdo->prepare("UPDATE ventas SET estado = ? WHERE id = ?");
        $stmt->execute([$nuevo_estado, $venta_id]);

        // Verificar log de cambios en la venta
        $stmt = $pdo->prepare("SELECT * FROM log_ventas WHERE venta_id = ? ORDER BY fecha_log DESC LIMIT 1");
        $stmt->execute([$venta_id]);
        $log = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<h3>Cambio en Venta Registrado:</h3>";
        echo "Estado anterior: " . $log['estado_anterior'] . "<br>";
        echo "Estado nuevo: " . $log['estado_nuevo'] . "<br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Probar los triggers
verificarCambiosPrecio($pdo, 1, 999.99); // Cambia el precio del producto con ID 1
verificarMovimientoInventario($pdo, 1, 15); // Cambia el stock del producto con ID 1
verificarValidacionStock($pdo, 1, -5); // Intenta establecer un stock negativo para ver la validación
verificarCambiosVenta($pdo, 1, 'cancelada'); // Cambia el estado de la venta con ID 1

$pdo = null; // Cerrar la conexión PDO
?>