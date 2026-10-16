<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController {

    public function index() {
        $this->render('home', [
            'titulo' => 'Bienvenido a Green Volt',
            'subtitulo' => 'La plataforma líder en venta y comparación de vehículos eléctricos.'
        ]);
    }
}