<?php
// Incluir la configuración de la base de datos
include 'config_mysql.php';

// Manejo de la paginación
$perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

// Consulta de productos
$sql = "SELECT p.*, c.nombre AS categoria_nombre FROM productos p 
        LEFT JOIN categorias c ON p.categoria_id = c.id 
        LIMIT $offset, $perPage";
$result = mysqli_query($conn, $sql);
$productos = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Contar total de productos
$totalResult = mysqli_query($conn, "SELECT COUNT(*) FROM productos");
$total = mysqli_fetch_row($totalResult)[0];
$totalPages = ceil($total / $perPage);

// Exportar a CSV
if (isset($_GET['export'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="productos.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Nombre', 'Descripción', 'Precio', 'Categoría', 'Stock', 'Fecha de Creación']);
    foreach ($productos as $producto) {
        fputcsv($output, $producto);
    }
    fclose($output);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Paginación de Productos</title>
</head>
<body>
    <h1>Productos</h1>

    <form method="GET">
        <label for="perPage">Elementos por página:</label>
        <select name="perPage" id="perPage" onchange="this.form.submit()">
            <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
            <option value="20" <?= ($perPage == 20) ? 'selected' : '' ?>>20</option>
            <option value="50" <?= ($perPage == 50) ? 'selected' : '' ?>>50</option>
        </select>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto['id']) ?></td>
                    <td><?= htmlspecialchars($producto['nombre']) ?></td>
                    <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                    <td>$<?= number_format($producto['precio'], 2) ?></td>
                    <td><?= htmlspecialchars($producto['categoria_nombre']) ?></td>
                    <td><?= htmlspecialchars($producto['stock']) ?></td>
                    <td><?= htmlspecialchars($producto['fecha_creacion']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div>
        <p>Página <?= $page ?> de <?= $totalPages ?></p>
        <a href="?page=1&perPage=<?= $perPage ?>">Primera</a>
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>&perPage=<?= $perPage ?>">Anterior</a>
        <?php endif; ?>
        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>&perPage=<?= $perPage ?>">Siguiente</a>
        <?php endif; ?>
        <a href="?export=1&perPage=<?= $perPage ?>">Exportar a CSV</a>
    </div>

    <script>
        let loading = false;

        window.addEventListener('scroll', () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100 && !loading) {
                loading = true;
                const nextPage = <?= json_encode($page + 1) ?>;
                if (nextPage <= <?= $totalPages ?>) {
                    fetch(`?page=${nextPage}&perPage=<?= $perPage ?>`)
                        .then(response => response.text())
                        .then(data => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(data, 'text/html');
                            const tbody = document.querySelector('tbody');
                            tbody.innerHTML += doc.querySelector('tbody').innerHTML;
                            loading = false;
                        });
                }
            }
        });
    </script>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>