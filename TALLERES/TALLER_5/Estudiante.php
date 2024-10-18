<?php

class Estudiante {
    private int $id;
    private string $nombre;
    private int $edad;
    private string $carrera;
    private array $materias = [];

    public function __construct(int $id, string $nombre, int $edad, string $carrera) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->carrera = $carrera;
    }

    public function agregarMateria(string $materia, float $calificacion): void {
        $this->materias[$materia] = $calificacion;
    }

    public function obtenerPromedio(): float {
        if (count($this->materias) === 0) {
            return 0;
        }
        return array_sum($this->materias) / count($this->materias);
    }

    public function obtenerDetalles(): array {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'edad' => $this->edad,
            'carrera' => $this->carrera,
            'materias' => $this->materias,
            'promedio' => $this->obtenerPromedio()
        ];
    }

    public function __toString(): string {
        return "Estudiante: {$this->nombre}, ID: {$this->id}, Carrera: {$this->carrera}, Promedio: {$this->obtenerPromedio()}";
    }
}

?>