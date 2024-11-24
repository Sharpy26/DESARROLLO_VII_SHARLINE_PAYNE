CREATE VIEW vista_productos_bajo_stock AS
SELECT 
    p.id AS producto_id,
    p.nombre AS producto,
    p.stock,
    SUM(dv.cantidad) AS total_vendido,
    SUM(dv.subtotal) AS ingresos_totales
FROM productos p
LEFT JOIN detalles_venta dv ON p.id = dv.producto_id
WHERE p.stock < 5
GROUP BY p.id, p.nombre, p.stock;

CREATE VIEW vista_historial_clientes AS
SELECT 
    c.id AS cliente_id,
    c.nombre AS cliente,
    c.email,
    p.nombre AS producto,
    dv.cantidad,
    dv.subtotal,
    v.fecha_venta
FROM clientes c
LEFT JOIN ventas v ON c.id = v.cliente_id
LEFT JOIN detalles_venta dv ON v.id = dv.venta_id
LEFT JOIN productos p ON dv.producto_id = p.id;

CREATE VIEW vista_metrica_categorias AS
SELECT 
    cat.nombre AS categoria,
    COUNT(p.id) AS total_productos,
    SUM(dv.cantidad) AS total_ventas,
    MAX(p.nombre) AS producto_mas_vendido
FROM categorias cat
LEFT JOIN productos p ON cat.id = p.categoria_id
LEFT JOIN detalles_venta dv ON p.id = dv.producto_id
GROUP BY cat.id, cat.nombre;

CREATE VIEW vista_tendencias_ventas AS
SELECT 
    DATE_FORMAT(v.fecha_venta, '%Y-%m') AS mes,
    COUNT(v.id) AS total_ventas,
    SUM(v.total) AS ingresos_totales
FROM ventas v
WHERE v.estado = 'completada'
GROUP BY DATE_FORMAT(v.fecha_venta, '%Y-%m')
ORDER BY mes DESC;