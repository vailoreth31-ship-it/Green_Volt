<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class VehiculosController extends BaseController {

    public function index() {
        $vehiculos = [];

        try {
            $db = new \PDO("mysql:host=localhost;dbname=green_volt;charset=utf8", "root", "");
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Consulta directa a la BD
            $stmt = $db->query("SELECT * FROM vehiculos");
            $vehiculos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            die("Error en la consulta PDO: " . $e->getMessage());
        }

        // Carga directa de la vista enviando $vehiculos y $titulo de forma explicita
        $this->render('vehiculos/index', [
            'titulo' => 'Catálogo de Vehículos Eléctricos',
            'vehiculos' => $vehiculos
        ]);
    }
}