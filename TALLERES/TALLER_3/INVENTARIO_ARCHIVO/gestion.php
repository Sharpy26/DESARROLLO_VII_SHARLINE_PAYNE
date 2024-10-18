<?php

function productos() {
    $json = 'C:/laragon/www/TALLERES/TALLER_3/INVENTARIO_ARCHIVO/almacen/inventario.json';
    $inventario = file_get_contents($json);
    $productos = json_decode($inventario, true);
    usort($productos, function($a, $b) {
        return strcmp($a['nombre'], $b['nombre']);
    });
    return $productos;
}

function valorTotal() {
    $productos = productos();
    $valorTotalInventario = 0;
    foreach ($productos as $producto) {
        $cantidad = $producto['cantidad']; 
        $precio = $producto['precio']; 
        $valorTotalProducto = $cantidad * $precio;
        $valorTotalInventario += $valorTotalProducto;
    }
    return $valorTotalInventario;
}

function filtrarStockBajo() {
    $productos = productos(); 
    return array_filter($productos, function($producto) {
        return $producto['cantidad'] < 5;
    });
}



?>