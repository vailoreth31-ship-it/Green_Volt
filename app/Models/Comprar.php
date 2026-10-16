<?php

namespace App\Models;

use PDO;

class Comprar {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=green_volt;charset=utf8", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            $this->db = null;
        }
    }

    public function obtenerVehiculos() {
        if (!$this->db) {
            return [];
        }

        $sql = "SELECT * FROM vehiculos WHERE activo = 1 ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrarSolicitudCompra($datos) {
        if (!$this->db) {
            return true;
        }

        $sql = "INSERT INTO solicitudes_compra (usuario_id, vehiculo_id, estado_id, fecha_solicitud)
                VALUES (:usuario_id, :vehiculo_id, 1, NOW())";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':usuario_id' => $datos['usuario_id'] ?? null,
            ':vehiculo_id' => $datos['vehiculo_id'] ?? 0
        ]);
    }
}
