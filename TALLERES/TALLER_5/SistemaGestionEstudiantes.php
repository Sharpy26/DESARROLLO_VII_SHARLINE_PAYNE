<?php

require_once 'Estudiante.php';

class SistemaGestionEstudiantes {
    private array $estudiantes = [];
    private array $graduados = [];

    public function agregarEstudiante(Estudiante $estudiante): void {
        $this->estudiantes[$estudiante->obtenerDetalles()['id']] = $estudiante;
    }

    public function obtenerEstudiante(int $id): ?Estudiante {
        return $this->estudiantes[$id] ?? null;
    }

    public function listarEstudiantes(): array {
        return $this->estudiantes;
    }

    public function calcularPromedioGeneral(): float {
        if (count($this->estudiantes) === 0) {
            return 0;
        }

        $promedios = array_map(function(Estudiante $estudiante) {
            return $estudiante->obtenerPromedio();
        }, $this->estudiantes);

        return array_sum($promedios) / count($promedios);
    }

    public function obtenerEstudiantesPorCarrera(string $carrera): array {
        return array_filter($this->estudiantes, function(Estudiante $estudiante) use ($carrera) {
            return strcasecmp($estudiante->obtenerDetalles()['carrera'], $carrera) === 0;
        });
    }

    public function obtenerMejorEstudiante(): ?Estudiante {
        if (count($this->estudiantes) === 0) {
            return null;
        }

        return array_reduce($this->estudiantes, function(?Estudiante $mejor, Estudiante $actual) {
            return $mejor === null || $actual->obtenerPromedio() > $mejor->obtenerPromedio() ? $actual : $mejor;
        });
    }

    public function generarReporteRendimiento(): array {
        $reporte = [];
        foreach ($this->estudiantes as $estudiante) {
            foreach ($estudiante->obtenerDetalles()['materias'] as $materia => $calificacion) {
                if (!isset($reporte[$materia])) {
                    $reporte[$materia] = ['total' => 0, 'cantidad' => 0, 'max' => $calificacion, 'min' => $calificacion];
                }
                $reporte[$materia]['total'] += $calificacion;
                $reporte[$materia]['cantidad']++;
                $reporte[$materia]['max'] = max($reporte[$materia]['max'], $calificacion);
                $reporte[$materia]['min'] = min($reporte[$materia]['min'], $calificacion);
            }
        }

        foreach ($reporte as $materia => &$datos) {
            $datos['promedio'] = $datos['total'] / $datos['cantidad'];
        }

        return $reporte;
    }

    public function graduarEstudiante(int $id): void {
        if (isset($this->estudiantes[$id])) {
            $this->graduados[$id] = $this->estudiantes[$id];
            unset($this->estudiantes[$id]);
        }
    }

    public function generarRanking(): array {
        usort($this->estudiantes, function(Estudiante $a, Estudiante $b) {
            return $b->obtenerPromedio() <=> $a->obtenerPromedio();
        });
        return $this->estudiantes;
    }

    public function buscarEstudiantes(string $termino): array {
        $termino = strtolower($termino);
        return array_filter($this->estudiantes, function(Estudiante $estudiante) use ($termino) {
            return stripos(strtolower($estudiante->obtenerDetalles()['nombre']), $termino) !== false ||
                   stripos(strtolower($estudiante->obtenerDetalles()['carrera']), $termino) !== false;
        });
    }

    public function generarEstadisticasPorCarrera(): array {
        $estadisticas = [];
        
        foreach ($this->estudiantes as $estudiante) {
            $carrera = $estudiante->obtenerDetalles()['carrera'];
            
            // Inicializa la estadística de la carrera si no existe
            if (!isset($estadisticas[$carrera])) {
                $estadisticas[$carrera] = [
                    'cantidad' => 0,
                    'total_promedio' => 0,
                    'mejor_estudiante' => null
                ];
            }
            
            $estadisticas[$carrera]['cantidad']++;
            $promedio = $estudiante->obtenerPromedio();
            
            // Asegúrate de que el promedio no sea nulo
            if ($promedio !== null) {
                $estadisticas[$carrera]['total_promedio'] += $promedio;
                
                // Verifica si hay un mejor estudiante o si el actual es mejor
                if ($estadisticas[$carrera]['mejor_estudiante'] === null ||
                    $promedio > $estadisticas[$carrera]['mejor_estudiante']->obtenerPromedio()) {
                    $estadisticas[$carrera]['mejor_estudiante'] = $estudiante;
                }
            }
        }
    
        // Calcular el promedio general por carrera
        foreach ($estadisticas as &$datos) {
            if ($datos['cantidad'] > 0) {
                $datos['promedio_general'] = $datos['total_promedio'] / $datos['cantidad'];
            } else {
                $datos['promedio_general'] = 0; // O manejar de otra manera si no hay estudiantes
            }
        }
    
        return $estadisticas;
    }
    
}

?>