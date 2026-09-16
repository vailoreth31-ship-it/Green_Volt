<?php

namespace App\Controllers;

abstract class BaseController {

    protected function render($view, $data = [], $layout = true) {
        extract($data);

        $viewFile = __DIR__ . '/../Views/' . $view . '.php';

        if ($layout) {
            $headerFile = __DIR__ . '/../Views/layouts/header.php';
            $footerFile = __DIR__ . '/../Views/layouts/footer.php';

            if (file_exists($headerFile)) {
                require_once $headerFile;
            }

            if (file_exists($viewFile)) {
                require_once $viewFile;
            } else {
                echo "<div style='padding:40px; text-align:center;'>
                        <h1 style='color:#0d6efd;'>⚡ Green Volt</h1>
                        <p style='font-size:1.2rem; color:#6c757d;'>Vista no encontrada: {$view}</p>
                    </div>";
            }

            if (file_exists($footerFile)) {
                require_once $footerFile;
            }
        } else {
            if (file_exists($viewFile)) {
                require_once $viewFile;
            }
        }
    }
}