<?php

namespace App\Models;

use Config\Database;
use PDO;

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Buscar usuario por correo electrónico
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar usuario por ID
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT id, nombre, email, rol, fecha_registro FROM usuarios WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Registrar nuevo usuario con hash de contraseña seguro
    public function create($nombre, $email, $password, $rol = 'cliente') {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("
            INSERT INTO usuarios (nombre, email, password, rol) 
            VALUES (:nombre, :email, :password, :rol)
        ");

        return $stmt->execute([
            ':nombre'   => $nombre,
            ':email'    => $email,
            ':password' => $passwordHash,
            ':rol'      => $rol
        ]);
    }

    // Verificar credenciales para Login
    public function authenticate($email, $password) {
        $user = $this->findByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']); // No guardar el hash en la sesión
            return $user;
        }

        return false;
    }
}
