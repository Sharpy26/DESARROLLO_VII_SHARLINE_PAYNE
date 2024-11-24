DELIMITER //

CREATE PROCEDURE sp_procesar_devolucion(
    IN p_venta_id INT,
    IN p_producto_id INT,
    IN p_cantidad INT
)
BEGIN
    DECLARE v_stock INT;

    START TRANSACTION;

    -- Actualizar stock
    UPDATE productos
    SET stock = stock + p_cantidad
    WHERE id = p_producto_id;

    -- Cambiar el estado de la venta
    UPDATE ventas
    SET estado = 'devuelto'
    WHERE id = p_venta_id;

    COMMIT;
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE sp_aplicar_descuento(
    IN p_cliente_id INT
)
BEGIN
    DECLARE v_total_gastado DECIMAL(10,2);
    DECLARE v_descuento DECIMAL(10,2);

    -- Calcular el total gastado por el cliente
    SELECT SUM(total) INTO v_total_gastado
    FROM ventas
    WHERE cliente_id = p_cliente_id;

    -- Aplicar descuento según el total gastado
    IF v_total_gastado > 1000 THEN
        SET v_descuento = 0.10;
    ELSEIF v_total_gastado > 500 THEN
        SET v_descuento = 0.05;
    ELSE
        SET v_descuento = 0;
    END IF;

    -- Actualizar el nivel de membresía del cliente
    UPDATE clientes
    SET nivel_membresia = nivel_membresia + v_descuento
    WHERE id = p_cliente_id;
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE sp_reporte_bajo_stock()
BEGIN
    SELECT 
        nombre,
        stock,
        (10 - stock) AS cantidad_reposicion
    FROM productos
    WHERE stock < 10;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE sp_calcular_comision(
    IN p_vendedor_id INT
)
BEGIN
    DECLARE v_comision DECIMAL(10,2);

    -- Calcular comision basada en el monto total de ventas del vendedor
    SELECT SUM(total) * 0.05 INTO v_comision
    FROM ventas
    WHERE vendedor_id = p_vendedor_id;

    -- Actualizar la tabla de vendedores
    UPDATE vendedores
    SET comision = v_comision
    WHERE id = p_vendedor_id;
END //

DELIMITER ;