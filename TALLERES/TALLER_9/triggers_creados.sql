DELIMITER //

-- Trigger para auditar cambios en productos
CREATE TRIGGER tr_productos_update
AFTER UPDATE ON productos
FOR EACH ROW
BEGIN
    -- Auditar cambios en el precio
    IF OLD.precio != NEW.precio THEN
        INSERT INTO log_productos (producto_id, accion, campo_modificado, valor_anterior, valor_nuevo, usuario)
        VALUES (NEW.id, 'UPDATE', 'precio', OLD.precio, NEW.precio, CURRENT_USER());

        INSERT INTO historial_precios (producto_id, precio_anterior, precio_nuevo, usuario)
        VALUES (NEW.id, OLD.precio, NEW.precio, CURRENT_USER());
    END IF;

    -- Auditar cambios en el stock
    IF OLD.stock != NEW.stock THEN
        INSERT INTO log_productos (producto_id, accion, campo_modificado, valor_anterior, valor_nuevo, usuario)
        VALUES (NEW.id, 'UPDATE', 'stock', OLD.stock, NEW.stock, CURRENT_USER());

        INSERT INTO movimientos_inventario (
            producto_id,
            tipo_movimiento,
            cantidad,
            motivo,
            stock_anterior,
            stock_nuevo
        )
        VALUES (
            NEW.id,
            CASE 
                WHEN NEW.stock > OLD.stock THEN 'ENTRADA'
                ELSE 'SALIDA'
            END,
            ABS(NEW.stock - OLD.stock),
            'Actualización de stock',
            OLD.stock,
            NEW.stock
        );
    END IF;
END //

-- Trigger para validar stock antes de actualizar
CREATE TRIGGER tr_validar_stock
BEFORE UPDATE ON productos
FOR EACH ROW
BEGIN
    IF NEW.stock < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El stock no puede ser negativo';
    END IF;
END //

-- Trigger para auditar ventas
CREATE TRIGGER tr_ventas_update
AFTER UPDATE ON ventas
FOR EACH ROW
BEGIN
    INSERT INTO log_ventas (venta_id, accion, estado_anterior, estado_nuevo, usuario)
    VALUES (NEW.id, 'UPDATE', OLD.estado, NEW.estado, CURRENT_USER());
    
    -- Si la venta se cancela, restaurar el stock
    IF NEW.estado = 'cancelada' AND OLD.estado != 'cancelada' THEN
        UPDATE productos p
        JOIN detalles_venta dv ON p.id = dv.producto_id
        SET p.stock = p.stock + dv.cantidad
        WHERE dv.venta_id = NEW.id;
    END IF;
END //

-- Trigger para nuevos productos
CREATE TRIGGER tr_nuevos_productos
AFTER INSERT ON productos
FOR EACH ROW
BEGIN
    INSERT INTO log_productos (producto_id, accion, campo_modificado, valor_nuevo, usuario)
    VALUES (NEW.id, 'INSERT', 'nuevo_producto', NEW.nombre, CURRENT_USER());

    -- Si el stock inicial es mayor que 0, registrar como entrada de inventario
    IF NEW.stock > 0 THEN
        INSERT INTO movimientos_inventario (
            producto_id,
            tipo_movimiento,
            cantidad,
            motivo,
            stock_anterior,
            stock_nuevo
        )
        VALUES (
            NEW.id,
            'ENTRADA',
            NEW.stock,
            'Stock inicial',
            0,
            NEW.stock
        );
    END IF;
END //

DELIMITER ;