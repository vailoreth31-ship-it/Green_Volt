<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class VehiculosController extends BaseController {

    private function obtenerModelo() {
        return new \App\Models\Vehiculo();
    }

    public function index() {
        $vehiculos = [];

        try {
            $db = new \PDO("mysql:host=localhost;dbname=green_volt;charset=utf8", "root", "");
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Consulta directa a la BD
            $stmt = $db->query("SELECT * FROM vehiculos WHERE activo = 1");
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

    public function editar($id = null) {
        if (!is_numeric($id)) {
            http_response_code(404);
            exit('Vehículo no encontrado.');
        }

        $vehiculo = $this->obtenerModelo()->getById((int) $id);
        if (!$vehiculo) {
            http_response_code(404);
            exit('Vehículo no encontrado.');
        }

        $this->render('vehiculos/editar', [
            'titulo' => 'Editar vehículo - Green Volt',
            'vehiculo' => $vehiculo
        ]);
    }

    public function actualizar($id = null) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Método no permitido.');
        }

        if (!is_numeric($id)) {
            http_response_code(404);
            exit('Vehículo no encontrado.');
        }

        $datos = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'marca_id' => (int) ($_POST['marca_id'] ?? 0),
            'modelo' => trim($_POST['modelo'] ?? ''),
            'anio' => (int) ($_POST['anio'] ?? 0),
            'precio' => (float) ($_POST['precio'] ?? 0),
            'autonomia' => (int) ($_POST['autonomia'] ?? 0),
            'stock' => (int) ($_POST['stock'] ?? 0),
            'descripcion' => trim($_POST['descripcion'] ?? '')
        ];

        if (
            $datos['nombre'] === '' ||
            $datos['modelo'] === '' ||
            $datos['marca_id'] < 1 ||
            $datos['anio'] < 1 ||
            $datos['precio'] < 0 ||
            $datos['autonomia'] < 0 ||
            $datos['stock'] < 0 ||
            $datos['descripcion'] === ''
        ) {
            http_response_code(400);
            exit('Revisa los datos ingresados e inténtalo de nuevo.');
        }

        if (!$this->obtenerModelo()->update((int) $id, $datos)) {
            http_response_code(500);
            exit('No se pudo actualizar el vehículo.');
        }

        header('Location: /green_volt/vehiculos');
        exit;
    }

    public function eliminar($id = null) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Método no permitido.');
        }

        if (!is_numeric($id)) {
            http_response_code(404);
            exit('Vehículo no encontrado.');
        }

        $modelo = $this->obtenerModelo();
        if (!$modelo->getById((int) $id)) {
            http_response_code(404);
            exit('Vehículo no encontrado.');
        }

        if (!$modelo->delete((int) $id)) {
            http_response_code(500);
            exit('No se pudo eliminar el vehículo.');
        }

        header('Location: /green_volt/vehiculos');
        exit;
    }
}