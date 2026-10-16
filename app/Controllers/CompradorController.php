<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CompradorController extends BaseController {
    private $comprarModel;

    public function __construct() {
        $this->comprarModel = new \App\Models\Comprar();
    }

    public function index() {
        $vehiculos = $this->comprarModel->obtenerVehiculos();
        $vehiculoSeleccionado = filter_input(INPUT_GET, 'vehiculo', FILTER_VALIDATE_INT);
        $vehiculoSeleccionado = $vehiculoSeleccionado !== false && $vehiculoSeleccionado !== null
            ? $vehiculoSeleccionado
            : 0;

        if ($vehiculoSeleccionado > 0) {
            $vehiculoEncontrado = false;
            foreach ($vehiculos as $vehiculo) {
                if ((int) $vehiculo['id'] === $vehiculoSeleccionado) {
                    $vehiculoEncontrado = true;
                    break;
                }
            }

            if (!$vehiculoEncontrado) {
                $vehiculoSeleccionado = 0;
            }
        }

        $this->render('comprador/index', [
            'titulo' => 'Comprar Vehículos Eléctricos - Green Volt',
            'vehiculos' => $vehiculos,
            'vehiculoSeleccionado' => $vehiculoSeleccionado,
            'mensaje_exito' => ''
        ]);
    }

    public function procesar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /green_volt/comprador');
            exit;
        }

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        $datos = [
            'usuario_id' => $_SESSION['user_id'] ?? null,
            'nombre_cliente' => trim($_POST['nombre_cliente'] ?? ''),
            'correo_cliente' => trim($_POST['correo_cliente'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'vehiculo_id' => trim($_POST['vehiculo_id'] ?? ''),
            'tipo_pago' => trim($_POST['tipo_pago'] ?? ''),
            'comentarios' => trim($_POST['comentarios'] ?? '')
        ];

        if ($this->comprarModel->registrarSolicitudCompra($datos)) {
            $_SESSION['comprar_message'] = '¡Tu solicitud de compra ha sido enviada con éxito! Un asesor de Green Volt te contactará muy pronto.';
            header('Location: /green_volt/comprador');
            exit;
        }

        die('Error al procesar la solicitud de compra.');
    }
}
