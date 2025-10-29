<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuario;

class AuthController extends Controller
{
    private $usuarioModel;

    public function __construct()
    {
        // Nota: No llamamos a parent::__construct() si este tiene checkAuth()
        // Este controlador debe ser la excepción para permitir acceso sin login.
        $this->usuarioModel = new Usuario();
    }

    // ==========================
    // VISTAS
    // ==========================

    /**
     * Muestra la vista de login.
     * Acceso: /auth/login
     */
    public function login()
    {
        // Render simple: no incluye header/footer del layout principal
        $this->renderSimple('auth/login');
    }

    // ==========================
    // PROCESOS DE AUTENTICACIÓN
    // ==========================

    /**
     * Procesa el intento de login (POST).
     * Acceso: /auth/procesar
     */
    public function procesar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /sgen-support/public/auth/login');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // 1. Buscar al usuario por username
        $usuario = $this->usuarioModel->findByUsername($username);

        // 2. Verificar si el usuario existe y la contraseña coincide
        if ($usuario && password_verify($password, $usuario->password)) {
            
            // Éxito: iniciar sesión
            session_regenerate_id(true); // Previene fijación de sesión

            // Guardar datos clave en la sesión
            $_SESSION['user_id']  = $usuario->id;
            $_SESSION['username'] = $usuario->username;
            $_SESSION['rol']      = $usuario->rol;
            
            // Redirigir al dashboard (o lista de soportes)
            header('Location: /sgen-support/public/');
            exit;

        } else {
            // Falla: usuario o contraseña incorrectos
            $this->setFlashMessage('error', 'Credenciales incorrectas. Intente de nuevo.');
            header('Location: /sgen-support/public/auth/login');
            exit;
        }
    }

    /**
     * Cierra la sesión del usuario.
     * Acceso: /auth/logout
     */
    public function logout()
    {
        session_unset();   // Libera todas las variables de sesión
        session_destroy(); // Destruye la sesión
        
        // Redirige al login
        header('Location: /sgen-support/public/auth/login');
        exit;
    }
}
