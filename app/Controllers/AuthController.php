<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController {

    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // Mostrar Formulario de Login
    public function login() {
        if (isset($_SESSION['user_id'])) {
            header('Location: /green_volt/');
            exit;
        }

        $data = [
            'titulo' => 'Iniciar Sesión | Green Volt',
            'error' => $_SESSION['auth_error'] ?? null
        ];
        unset($_SESSION['auth_error']);

        $this->render('auth/login', $data);
    }

    // Procesar envío de Login
    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $_SESSION['auth_error'] = 'Por favor, completa todos los campos.';
                header('Location: /green_volt/auth/login');
                exit;
            }

            $user = $this->userModel->authenticate($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nombre'] = $user['nombre'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_rol'] = $user['rol'];

                header('Location: /green_volt/');
                exit;
            } else {
                $_SESSION['auth_error'] = 'Correo o contraseña incorrectos.';
                header('Location: /green_volt/auth/login');
                exit;
            }
        }
    }

    // Mostrar Formulario de Registro
    public function register() {
        if (isset($_SESSION['user_id'])) {
            header('Location: /green_volt/');
            exit;
        }

        $data = [
            'titulo' => 'Crear Cuenta | Green Volt',
            'error' => $_SESSION['auth_error'] ?? null,
            'success' => $_SESSION['auth_success'] ?? null
        ];
        unset($_SESSION['auth_error'], $_SESSION['auth_success']);

        $this->render('auth/register', $data);
    }

    // Procesar Registro de Usuario
    public function processRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $confirm_password = trim($_POST['confirm_password'] ?? '');

            // Validaciones básicas
            if (empty($nombre) || empty($email) || empty($password)) {
                $_SESSION['auth_error'] = 'Todos los campos son obligatorios.';
                header('Location: /green_volt/auth/register');
                exit;
            }

            if ($password !== $confirm_password) {
                $_SESSION['auth_error'] = 'Las contraseñas no coinciden.';
                header('Location: /green_volt/auth/register');
                exit;
            }

            if (preg_match('/\A(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}\z/', $password) !== 1) {
                $_SESSION['auth_error'] = 'La contraseña debe tener al menos 8 caracteres e incluir una letra mayúscula, una minúscula y un número.';
                header('Location: /green_volt/auth/register');
                exit;
            }

            try {
                // Validar si el correo ya existe
                if ($this->userModel->findByEmail($email)) {
                    $_SESSION['auth_error'] = 'El correo electrónico ya está registrado.';
                    header('Location: /green_volt/auth/register');
                    exit;
                }

                // Guardar usuario
                if ($this->userModel->create($nombre, $email, $password)) {
                    $_SESSION['auth_success'] = '¡Cuenta creada con éxito! Ahora puedes iniciar sesión.';
                    header('Location: /green_volt/auth/login');
                } else {
                    $_SESSION['auth_error'] = 'Ocurrió un error al registrar la cuenta.';
                    header('Location: /green_volt/auth/register');
                }
            } catch (\PDOException $e) {
                $_SESSION['auth_error'] = 'No se pudo registrar el usuario. Verifica la tabla usuarios y sus columnas.';
                header('Location: /green_volt/auth/register');
            }

            exit;
        }
    }

    // Cierre de Sesión
    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /green_volt/');
        exit;
    }
}