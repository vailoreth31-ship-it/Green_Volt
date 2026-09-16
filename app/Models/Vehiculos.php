<?php

namespace App\Models;

use PDO;
use Exception;

class Vehiculo {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=green_volt;charset=utf8", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // READ - Obtener todos los vehículos activos
    public function getAll() {
        $sql = "SELECT v.*, m.nombre AS marca_nombre 
                FROM vehiculos v 
                LEFT JOIN marcas m ON v.marca_id = m.id 
                WHERE v.activo = 1 
                ORDER BY v.id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - Obtener un vehículo por ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM vehiculos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE - Insertar nuevo vehículo
    public function create($datos) {
        $sql = "INSERT INTO vehiculos (nombre, marca_id, modelo, anio, precio, autonomia, stock, descripcion, imagen, activo) 
                VALUES (:nombre, :marca_id, :modelo, :anio, :precio, :autonomia, :stock, :descripcion, :imagen, 1)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre'      => $datos['nombre'],
            ':marca_id'    => $datos['marca_id'] ?? 1,
            ':modelo'      => $datos['modelo'],
            ':anio'        => $datos['anio'],
            ':precio'      => $datos['precio'],
            ':autonomia'   => $datos['autonomia'],
            ':stock'       => $datos['stock'] ?? 1,
            ':descripcion' => $datos['descripcion'],
            ':imagen'      => $datos['imagen'] ?? 'https://via.placeholder.com/300x200?text=Vehiculo+Electrico'
        ]);
    }

    // UPDATE - Actualizar vehículo existente
    public function update($id, $datos) {
        $sql = "UPDATE vehiculos SET 
                    nombre = :nombre, 
                    marca_id = :marca_id, 
                    modelo = :modelo, 
                    anio = :anio, 
                    precio = :precio, 
                    autonomia = :autonomia, 
                    stock = :stock, 
                    descripcion = :descripcion 
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'          => $id,
            ':nombre'      => $datos['nombre'],
            ':marca_id'    => $datos['marca_id'] ?? 1,
            ':modelo'      => $datos['modelo'],
            ':anio'        => $datos['anio'],
            ':precio'      => $datos['precio'],
            ':autonomia'   => $datos['autonomia'],
            ':stock'       => $datos['stock'],
            ':descripcion' => $datos['descripcion']
        ]);
    }

    // DELETE - Borrado lógico (Desactivar vehículo para no romper claves foráneas)
    public function delete($id) {
        $stmt = $this->db->prepare("UPDATE vehiculos SET activo = 0 WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}