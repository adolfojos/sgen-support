<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuario;
use PDO; // No es estrictamente necesario, pero buena práctica si el modelo lo usa

class UsuariosController extends Controller {

    private $usuarioModel;
    // Definimos los roles permitidos en el sistema
    private $allowedRoles = ['admin', 'tecnico', 'consultor']; 

    public function __construct() {
        parent::__construct(); 
        
        $this->usuarioModel = new Usuario();
        
        // **RESTRICCIÓN GLOBAL:** Solo el administrador puede gestionar usuarios.
        $this->restrictTo(['admin']); 
    }

    /**
     * Muestra la lista de todos los usuarios.
     * Acceso: /usuarios
     */
    public function index() {
        // En el modelo base, findAll() devuelve todos los objetos.
        $usuarios = $this->usuarioModel->findAll(); 

        $this->render('usuarios/lista', [
            'titulo' => 'Gestión de Usuarios y Roles',
            'usuarios' => $usuarios
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo usuario o editar uno existente.
     * Acceso: /usuarios/crear | /usuarios/editar/{id}
     */
    public function crear(int $id = null) {
        $usuario = null;
        if ($id) {
            $usuario = $this->usuarioModel->findById($id);
            if (!$usuario) {
                die("Usuario no encontrado.");
            }
        }
        
        $this->render('usuarios/formulario', [
            'titulo' => ($id ? 'Editar' : 'Crear Nuevo') . ' Usuario',
            'usuario' => $usuario,
            'allowedRoles' => $this->allowedRoles // Pasamos los roles al formulario
        ]);
    }
    
    // Simplificamos la edición llamando a crear con ID
    public function editar(int $id) {
        $this->crear($id);
    }

    /**
     * Procesa el formulario de creación/edición (POST).
     * Acceso: /usuarios/guardar
     */
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT); // Sin sanitizar, se va a hashear.
            $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_SPECIAL_CHARS);

            if (empty($username) || !in_array($rol, $this->allowedRoles)) {
                die("Error: Nombre de usuario o rol inválido.");
            }

            $datos = [
                'username' => $username,
                'rol' => $rol
            ];

            if ($id) {
                // ACTUALIZAR
                if (!empty($password)) {
                    // Solo actualizamos la contraseña si se proporciona una nueva
                    $datos['password'] = password_hash($password, PASSWORD_DEFAULT);
                }
                $this->usuarioModel->update($id, $datos);
                
            } else {
                // CREAR
                if (empty($password)) {
                    die("Error: La contraseña es obligatoria para la creación de un nuevo usuario.");
                }
                // Hashing de la contraseña antes de guardarla
                $datos['password'] = password_hash($password, PASSWORD_DEFAULT); 
                $this->usuarioModel->create($datos);
            }
            
            header('Location: /sgen-support/public/usuarios');
            exit;
        }
        header('Location: /sgen-support/public/usuarios/crear');
        exit;
    }

    /**
     * Elimina un usuario.
     * Acceso: /usuarios/eliminar/{id}
     */
    public function eliminar(int $id) {
        // En un sistema real, se debería validar que el usuario no tenga tickets asignados.
        // Aquí solo evitamos que se elimine el usuario principal (ID 1), por seguridad mínima.
        if ($id == 1) { 
             die("No se puede eliminar el usuario administrador principal (ID 1).");
        }
        
        $this->usuarioModel->delete($id);
        
        header('Location: /sgen-support/public/usuarios');
        exit;
    }
}