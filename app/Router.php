<?php

namespace App;

class Router {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // 1. Cargar BaseController primero (si existe)
        $basePaths = [
            __DIR__ . '/Controllers/BaseController.php',
            __DIR__ . '/controllers/BaseController.php',
            __DIR__ . '/Core/BaseController.php',
            __DIR__ . '/core/BaseController.php'
        ];
        foreach ($basePaths as $basePath) {
            if (file_exists($basePath)) {
                require_once $basePath;
                break;
            }
        }

        // 2. Determinar el nombre del controlador
        if (isset($url[0]) && !empty($url[0])) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        // 3. Buscar el archivo del controlador en múltiples combinaciones
        $possibleFiles = [
            __DIR__ . '/Controllers/' . $this->controller . '.php',
            __DIR__ . '/controllers/' . $this->controller . '.php',
            __DIR__ . '/Controllers/' . strtolower($this->controller) . '.php',
            __DIR__ . '/controllers/' . strtolower($this->controller) . '.php',
        ];

        $fileFound = false;
        foreach ($possibleFiles as $file) {
            if (file_exists($file)) {
                require_once $file;
                $fileFound = true;
                break;
            }
        }

        if (!$fileFound) {
            http_response_code(404);
            die("<h1>404 - Controlador no encontrado</h1>
            <p>El router no pudo encontrar el archivo del controlador <strong>{$this->controller}.php</strong>.</p>
                <p>Ruta buscada: <code>" . __DIR__ . "/Controllers/{$this->controller}.php</code></p>");
        }

        // 4. Instanciar la clase del controlador
        $fullClass = "App\\Controllers\\" . $this->controller;
        if (class_exists($fullClass)) {
            $this->controller = new $fullClass();
        } else {
            die("Error: La clase {$fullClass} existe en archivo pero no está definida correctamente con namespace App\\Controllers;");
        }

        // 5. Determinar el método/acción
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        if (isset($_GET['action'])) {
            $legacyRoutes = [
                'login' => 'auth/login',
                'processLogin' => 'auth/processLogin',
                'register' => 'auth/register',
                'processRegister' => 'auth/processRegister',
                'catalogo' => 'vehiculos'
            ];
            $route = $legacyRoutes[$_GET['action']] ?? '';

            if ($route !== '') {
                return explode('/', $route);
            }
        }

        return [];
    }
}