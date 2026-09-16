<?php
// Script de auto-creación de controladores base
$dir = __DIR__ . '/app/Controllers';

if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
    echo "✅ Carpeta app/Controllers creada.<br>";
}

// Código de BaseController
$baseControllerContent = <<<'PHP'
<?php

namespace App\Controllers;

abstract class BaseController {
    protected function render($view, $data = [], $layout = true) {
        extract($data);
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            die("La vista {$view} no existe en la ruta: {$viewFile}");
        }

        if ($layout) {
            require_once __DIR__ . '/../Views/layouts/header.php';
            require_once $viewFile;
            require_once __DIR__ . '/../Views/layouts/footer.php';
        } else {
            require_once $viewFile;
        }
    }
}
PHP;

// Código de HomeController
$homeControllerContent = <<<'PHP'
<?php

namespace App\Controllers;

class HomeController extends BaseController {
    public function index() {
        $data = [
            'titulo' => 'Bienvenido a Green Volt',
            'subtitulo' => 'La plataforma líder en venta y comparación de vehículos eléctricos.'
        ];

        $this->render('home/index', $data);
    }
}
PHP;

file_put_contents($dir . '/BaseController.php', $baseControllerContent);
echo "✅ Archivo BaseController.php creado exitosamente.<br>";

file_put_contents($dir . '/HomeController.php', $homeControllerContent);
echo "✅ Archivo HomeController.php creado exitosamente.<br>";

echo "<br><b>¡Todo listo! Ahora ingresa a <a href='/green_volt/'>http://localhost/green_volt/</a></b>";