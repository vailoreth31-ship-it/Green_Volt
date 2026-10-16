<?php

namespace App\Controllers;

class InformacionController extends BaseController {

    public function quienesSomos() {
        $this->render('informacion/quienes-somos', [
            'titulo' => 'Quiénes somos - Green Volt'
        ]);
    }

    public function tratamientoDatos() {
        $this->render('informacion/tratamiento-datos', [
            'titulo' => 'Tratamiento de datos - Green Volt'
        ]);
    }
}