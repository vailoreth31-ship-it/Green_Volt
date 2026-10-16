<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController {
    private $dashboardModel;

    public function __construct() {
        $this->dashboardModel = new \App\Models\Dashboard();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /green_volt/auth/login');
            exit;
        }

        $metricas = $this->dashboardModel->obtenerMetricasGenerales();
        $ultimasCitas = $this->dashboardModel->obtenerUltimasCitas();
        $ultimosVehiculos = $this->dashboardModel->obtenerUltimosVehiculos();

        $this->render('dashboard/index', [
            'titulo' => 'Panel de Control General - Green Volt',
            'metricas' => $metricas,
            'ultimas_citas' => $ultimasCitas,
            'ultimos_vehiculos' => $ultimosVehiculos
        ]);
    }
}
