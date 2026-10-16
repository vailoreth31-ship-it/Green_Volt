<?php

namespace App\Models;

use PDO;

class Soporte {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=green_volt;charset=utf8", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            $this->db = null;
        }
    }

    public function obtenerServicios() {
        if (!$this->db) {
            return [
                [
                    'id' => 1,
                    'nombre' => 'Soporte técnico',
                    'descripcion' => 'Asistencia general para tu vehículo eléctrico.',
                    'precio' => 0,
                    'activo' => 1
                ],
                [
                    'id' => 2,
                    'nombre' => 'Mantenimiento eléctrico',
                    'descripcion' => 'Revisión general del sistema eléctrico y batería.',
                    'precio' => 0,
                    'activo' => 1
                ]
            ];
        }

        try {
            $stmt = $this->db->query("SHOW TABLES LIKE 'servicios_soporte'");
            if ($stmt->fetch() === false) {
                return [
                    [
                        'id' => 1,
                        'nombre' => 'Soporte técnico',
                        'descripcion' => 'Asistencia general para tu vehículo eléctrico.',
                        'precio' => 0,
                        'activo' => 1
                    ],
                    [
                        'id' => 2,
                        'nombre' => 'Mantenimiento eléctrico',
                        'descripcion' => 'Revisión general del sistema eléctrico y batería.',
                        'precio' => 0,
                        'activo' => 1
                    ]
                ];
            }

            $stmt = $this->db->query("SELECT * FROM servicios_soporte WHERE activo = 1 ORDER BY orden ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function crearCita($datos) {
        if (!$this->db) {
            return true;
        }

        try {
            $stmt = $this->db->prepare("INSERT INTO citas_soporte (usuario_id, servicio_id, fecha_cita, hora_cita, comentario, creado_en)
                VALUES (:usuario_id, :servicio_id, :fecha_cita, :hora_cita, :comentario, NOW())");

            return $stmt->execute([
                ':usuario_id' => $datos['usuario_id'],
                ':servicio_id' => $datos['servicio_id'],
                ':fecha_cita' => $datos['fecha_cita'],
                ':hora_cita' => $datos['hora_cita'],
                ':comentario' => $datos['comentario']
            ]);
        } catch (\PDOException $e) {
            return false;
        }
    }
}
