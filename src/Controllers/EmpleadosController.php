<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Empleado;
use App\Models\Usuario; // Necesario para la vinculación

class EmpleadosController extends Controller {
    
    private $empleadoModel;
    private $usuarioModel;

    public function __construct() {
        parent::__construct(); 
        
        $this->empleadoModel = new Empleado();
        $this->usuarioModel = new Usuario();
        
        $this->restrictTo(['admin']); 
    }

    /**
     * Muestra la lista de todos los empleados.
     * Acceso: /empleados
     */
    public function index() {
        $empleados = $this->empleadoModel->findAllWithUserDetails();

        $this->render('empleados/lista', [
            'titulo' => 'Gestión de Empleados',
            'empleados' => $empleados
        ]);
    }

    /**
     * Muestra el formulario para crear/editar.
     * Acceso: /empleados/crear | /empleados/editar/{id}
     */
    public function crear(int $id = null) {
        $empleado = null;
        if ($id) {
            $empleado = $this->empleadoModel->findById($id);
            if (!$empleado) {
                // Usamos flash message si es un error no fatal
                $this->setFlashMessage('error', "Empleado ID #{$id} no encontrado.");
                header('Location: /sgen-support/public/empleados');
                exit;
            }
        }
        
        // Obtener la lista de usuarios NO asignados a otro empleado
        // Esto requiere un nuevo método en UsuarioModel (ver abajo)
        $usuarios_disponibles = $this->usuarioModel->findUnassignedUsers();

        $this->render('empleados/formulario', [
            'titulo' => ($id ? 'Editar' : 'Registrar Nuevo') . ' Empleado',
            'empleado' => $empleado,
            'usuarios_disponibles' => $usuarios_disponibles
        ]);
    }

    public function editar(int $id) {
        $this->crear($id);
    }

    /**
     * Procesa el formulario (POST).
     * Acceso: /empleados/guardar
     */
    public function guardar() {
        $this->restrictTo(['admin']);
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /sgen-support/public/empleados');
            exit;
        }
            
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $usuario_id = filter_input(INPUT_POST, 'usuario_id', FILTER_SANITIZE_NUMBER_INT);

        if (empty($nombre) || empty($apellido) || empty($email)) {
            $this->setFlashMessage('error', 'Nombre, Apellido y Email son obligatorios.');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $datos = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'usuario_id' => $usuario_id ?: null // Asigna NULL si no se selecciona usuario
        ];
        if ($id) {
            // Actualizar
            $this->empleadoModel->update($id, $datos);
            $this->setFlashMessage('success', 'Empleado actualizado correctamente.');
            header('Location: /sgen-support/public/empleados');
            exit;
        } else {
            // Crear con manejo de excepción
            try {
                $this->empleadoModel->create($datos);
                $this->setFlashMessage('success', 'Empleado registrado correctamente.');
                header('Location: /sgen-support/public/empleados');
                exit;
            } catch (\PDOException $e) {
                if ($e->getCode() == '23000') {
                    $this->setFlashMessage('error', 'Ya existe un empleado con ese correo electrónico.');
                } else {
                    $this->setFlashMessage('error', 'Error inesperado: ' . $e->getMessage());
                }
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        }
    }
    /**
     * Elimina un empleado.
     * Acceso: /empleados/eliminar/{id}
     */
    public function eliminar(int $id) {
        $this->restrictTo(['admin']);
        
        // NOTA: En un sistema real, verificarías si el empleado tiene tickets o tareas.

        if ($this->empleadoModel->delete($id)) {
            $this->setFlashMessage('success', "Empleado ID #{$id} eliminado.");
        } else {
            $this->setFlashMessage('error', "Error al eliminar el empleado.");
        }
        
        header('Location: /sgen-support/public/empleados');
        exit;
    }
}