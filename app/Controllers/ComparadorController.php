<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Vehiculo;

class ComparadorController extends BaseController {

    public function index() {
        $vehiculos = (new Vehiculo())->getAll();

        $this->render('comparador/index', [
            'titulo' => 'Comparador de Vehículos Eléctricos',
            'vehiculos' => $vehiculos
        ]);
    }
}