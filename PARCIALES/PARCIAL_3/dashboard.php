<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario']) || !isset($_SESSION['perfil'])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión
    exit;
}

// Obtener el perfil y usuario
$usuario = $_SESSION['usuario'];
$perfil = $_SESSION['perfil'];

// Contenido del panel según el perfil
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Bienvenidos Usuarios</title>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($usuario); ?> como <?php echo htmlspecialchars($perfil); ?>!</h2>

    <?php if ($perfil == 'estudiante'): ?>
        <p>calificaciones:</p>
        <?php if (array_key_exists($usuario, $calificaciones)): ?>
            <table border="1">
                <tr>
                    <th>materias</th>
                    <th>Calificación</th>
                </tr>
                <?php foreach ($calificaciones[$usuario] as $asignatura => $calificacion): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($asignatura); ?></td>
                        <td><?php echo htmlspecialchars($calificacion); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No tienes calificaciones disponibles.</p>
        <?php endif; ?>
    <?php elseif ($perfil == 'profesor'): ?>

    <?php endif; ?>

    <a href="logout.php">Cerrar sesión</a>
</body>
</html>