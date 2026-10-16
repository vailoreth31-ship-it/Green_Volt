<?php

namespace App\Models;

use PDO;

class Dashboard {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=green_volt;charset=utf8", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            $this->db = null;
        }
    }

    private function tableExists($tableName) {
        if (!$this->db) {
            return false;
        }

        try {
            $stmt = $this->db->query("SHOW TABLES LIKE '" . str_replace("'", "''", $tableName) . "'");
            return $stmt && $stmt->fetch() !== false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function obtenerMetricasGenerales() {
        if (!$this->db) {
            return [
                'total_vehiculos' => 6,
                'citas_pendientes' => 0,
                'total_servicios' => 0,
                'total_usuarios' => 0,
                'solicitudes_compra' => 0,
                'stock_total' => 0,
                'valor_inventario' => 0,
                'autonomia_promedio' => 0
            ];
        }

        try {
            $totalVehiculos = $this->db->query("SELECT COUNT(*) as total FROM vehiculos WHERE activo = 1")->fetchColumn();
            $totalUsuarios = $this->db->query("SELECT COUNT(*) as total FROM usuarios")->fetchColumn();
            $stockTotal = $this->db->query("SELECT COALESCE(SUM(stock), 0) as total FROM vehiculos WHERE activo = 1")->fetchColumn();
            $valorInventario = $this->db->query("SELECT COALESCE(SUM(precio * stock), 0) as total FROM vehiculos WHERE activo = 1")->fetchColumn();
            $autonomiaPromedio = $this->db->query("SELECT COALESCE(AVG(autonomia), 0) as total FROM vehiculos WHERE activo = 1")->fetchColumn();

            $citasPendientes = 0;
            if ($this->tableExists('citas_soporte')) {
                $citasPendientes = $this->db->query("SELECT COUNT(*) as total FROM citas_soporte WHERE estado = 'pendiente'")->fetchColumn();
            }

            $totalServicios = 0;
            if ($this->tableExists('servicios_soporte')) {
                $totalServicios = $this->db->query("SELECT COUNT(*) as total FROM servicios_soporte WHERE activo = 1")->fetchColumn();
            }

            $solicitudesCompra = 0;
            if ($this->tableExists('solicitudes_compra')) {
                $solicitudesCompra = $this->db->query("SELECT COUNT(*) as total FROM solicitudes_compra")->fetchColumn();
            }

            return [
                'total_vehiculos' => (int) $totalVehiculos,
                'citas_pendientes' => (int) $citasPendientes,
                'total_servicios' => (int) $totalServicios,
                'total_usuarios' => (int) $totalUsuarios,
                'solicitudes_compra' => (int) $solicitudesCompra,
                'stock_total' => (int) $stockTotal,
                'valor_inventario' => (float) $valorInventario,
                'autonomia_promedio' => (float) $autonomiaPromedio
            ];
        } catch (\PDOException $e) {
            return [
                'total_vehiculos' => 6,
                'citas_pendientes' => 0,
                'total_servicios' => 0,
                'total_usuarios' => 0,
                'solicitudes_compra' => 0,
                'stock_total' => 0,
                'valor_inventario' => 0,
                'autonomia_promedio' => 0
            ];
        }
    }

    public function obtenerUltimasCitas() {
        if (!$this->db || !$this->tableExists('citas_soporte')) {
            return [];
        }

        try {
            $sql = "SELECT c.*, s.nombre as servicio_nombre, u.nombre as usuario_nombre
                    FROM citas_soporte c
                    LEFT JOIN servicios_soporte s ON c.servicio_id = s.id
                    LEFT JOIN usuarios u ON c.usuario_id = u.id
                    ORDER BY c.creado_en DESC LIMIT 5";

            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function obtenerUltimosVehiculos() {
        if (!$this->db) {
            return [];
        }

        try {
            $sql = "SELECT * FROM vehiculos WHERE activo = 1 ORDER BY id DESC LIMIT 5";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }
}
