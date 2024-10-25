<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
    <h2>Bienvenido a la lista de tareas personales</h2>
    <form action="procesar.php" method="POST">
        <label for="perfil">Perfil:</label>
        <select id="perfil" name="perfil" required>
            <option value="estudiante">Estudiante</option>
            <option value="profesor">Profesor</option>
        </select><br><br>

        <label for="usuario">Nombre:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>