<?php

namespace App\Controllers;

use App\Models\Vehiculo;

class CompradorController extends BaseController {

    public function index() {
        $vehiculos = (new Vehiculo())->getAll();
        $seleccionado = isset($_GET['vehiculo']) ? (int) $_GET['vehiculo'] : 0;

        $this->render('comprador/index', [
            'titulo' => 'Comprar un Vehículo',
            'vehiculos' => $vehiculos,
            'vehiculoSeleccionado' => $seleccionado,
            'formulario' => []
        ]);
    }

    public function solicitar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /green_volt/comprador');
            exit;
        }

        $vehiculoId = filter_input(INPUT_POST, 'vehiculo_id', FILTER_VALIDATE_INT);
        $nombre = trim($_POST['nombre'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $formulario = [
            'nombre' => $nombre,
            'correo' => $correo,
            'telefono' => $telefono
        ];
        $errores = [];
        $vehiculo = null;

        if ($vehiculoId) {
            $vehiculo = (new Vehiculo())->getById($vehiculoId);
        }

        if (!$vehiculo || (isset($vehiculo['activo']) && (int) $vehiculo['activo'] !== 1)) {
            $errores[] = 'Selecciona un vehículo disponible.';
        }
        if ($nombre === '') {
            $errores[] = 'Indica tu nombre completo.';
        }
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'Indica un correo electrónico válido.';
        }
        if ($telefono === '') {
            $errores[] = 'Indica un teléfono de contacto.';
        }

        $vehiculos = (new Vehiculo())->getAll();
        if ($errores) {
            $this->render('comprador/index', [
                'titulo' => 'Comprar un Vehículo',
                'vehiculos' => $vehiculos,
                'vehiculoSeleccionado' => (int) $vehiculoId,
                'formulario' => $formulario,
                'errores' => $errores
            ]);
            return;
        }

        $_SESSION['solicitud_compra'] = [
            'nombre' => $nombre,
            'correo' => $correo,
            'telefono' => $telefono,
            'vehiculo' => $vehiculo['nombre'] ?? $vehiculo['modelo'] ?? 'Vehículo eléctrico'
        ];

        $this->render('comprador/index', [
            'titulo' => 'Comprar un Vehículo',
            'vehiculos' => $vehiculos,
            'vehiculoSeleccionado' => (int) $vehiculoId,
            'formulario' => [],
            'confirmacion' => $_SESSION['solicitud_compra']
        ]);
    }
}
