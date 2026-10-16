<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SoporteController extends BaseController {
    private $soporteModel;

    public function __construct() {
        $this->soporteModel = new \App\Models\Soporte();
    }

    public function index() {
        $servicios = $this->soporteModel->obtenerServicios();

        $this->render('soporte/index', [
            'titulo' => 'Servicios y Soporte Técnico - Green Volt',
            'servicios' => $servicios,
            'mensaje_exito' => ''
        ]);
    }

    public function agendar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /green_volt/soporte');
            exit;
        }

        if (!isset($_SESSION['user_id'])) {
            $_SESSION['auth_error'] = 'Debes iniciar sesión para agendar un servicio.';
            header('Location: /green_volt/auth/login');
            exit;
        }

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        $datos = [
            'usuario_id' => $_SESSION['user_id'],
            'servicio_id' => trim($_POST['servicio_id'] ?? ''),
            'fecha_cita' => trim($_POST['fecha_cita'] ?? ''),
            'hora_cita' => trim($_POST['hora_cita'] ?? ''),
            'comentario' => trim($_POST['comentario'] ?? '')
        ];

        if ($this->soporteModel->crearCita($datos)) {
            $_SESSION['soporte_message'] = 'Tu solicitud de servicio ha sido agendada con éxito.';
            header('Location: /green_volt/soporte');
            exit;
        }

        die('Error al agendar la cita.');
    }
}
