<?php
require_once 'Estudiante.php';
require_once 'SistemaGestionEstudiantes.php';

// Instanciar el sistema de gestión
$sistema = new SistemaGestionEstudiantes();

// Crear algunos estudiantes de prueba
$estudiante1 = new Estudiante(1, "Juan Pérez", 20, "Ingeniería");
$estudiante1->agregarMateria("Matemáticas", 85);
$estudiante1->agregarMateria("Física", 90);

$estudiante2 = new Estudiante(2, "Ana Gómez", 22, "Medicina");
$estudiante2->agregarMateria("Biología", 88);
$estudiante2->agregarMateria("Química", 92);

$estudiante3 = new Estudiante(3, "Carlos Ramírez", 21, "Derecho");
$estudiante3->agregarMateria("Derecho Civil", 75);
$estudiante3->agregarMateria("Derecho Penal", 80);

$estudiante4 = new Estudiante(4, "María Fernández", 23, "Arquitectura");
$estudiante4->agregarMateria("Diseño Arquitectónico", 95);
$estudiante4->agregarMateria("Historia de la Arquitectura", 90);

$estudiante5 = new Estudiante(5, "Luis Rodríguez", 19, "Ingeniería");
$estudiante5->agregarMateria("Cálculo", 88);
$estudiante5->agregarMateria("Electrónica", 84);

$estudiante6 = new Estudiante(6, "Elena Martínez", 24, "Psicología");
$estudiante6->agregarMateria("Psicología Clínica", 92);
$estudiante6->agregarMateria("Neurociencia", 89);

$estudiante7 = new Estudiante(7, "Fernando García", 21, "Administración de Empresas");
$estudiante7->agregarMateria("Contabilidad", 85);
$estudiante7->agregarMateria("Economía", 87);

// Agregar estudiantes al sistema
$sistema->agregarEstudiante($estudiante1);
$sistema->agregarEstudiante($estudiante2);
$sistema->agregarEstudiante($estudiante3);
$sistema->agregarEstudiante($estudiante4);
$sistema->agregarEstudiante($estudiante5);
$sistema->agregarEstudiante($estudiante6);
$sistema->agregarEstudiante($estudiante7);


// Mostrar todos los estudiantes
$estudiantes = $sistema->listarEstudiantes();

?>

<h1>Sistema de Gestión de Estudiantes</h1>

<h2>Lista de Estudiantes</h2>
<ul>
    <?php foreach ($estudiantes as $estudiante): ?>
        <li><?php echo $estudiante; ?></li>
    <?php endforeach; ?>
</ul>

<h2>Mejor Estudiante</h2>
<p><?php echo $sistema->obtenerMejorEstudiante(); ?></p>

<h2>Reporte de Rendimiento</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Materia</th>
            <th>Promedio</th>
            <th>Calificación más alta</th>
            <th>Calificación más baja</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $reporte = $sistema->generarReporteRendimiento();
        foreach ($reporte as $materia => $detalles): ?>
            <tr>
                <td><?php echo $materia; ?></td>
                <td><?php echo $detalles['promedio']; ?></td>
                <td><?php echo $detalles['max']; ?></td>
                <td><?php echo $detalles['min']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>