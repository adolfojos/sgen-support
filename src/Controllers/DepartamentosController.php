<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Departamento;

class DepartamentosController extends Controller {
    
    private $departamentoModel;

    public function __construct() {
        // Llama al constructor del padre (Auth/Controller)
        parent::__construct(); 
        
        $this->departamentoModel = new Departamento();
        
        // **RESTRICCIÓN GLOBAL:** Solo el administrador puede acceder a este controlador.
        $this->restrictTo(['admin']); 
    }

    /**
     * Muestra la lista de todos los departamentos.
     * Acceso: /departamentos
     */
    public function index() {
        $departamentos = $this->departamentoModel->findAll();

        $this->render('departamentos/lista', [
            'titulo' => 'Gestión de Departamentos',
            'departamentos' => $departamentos
        ]);
    }
    
    /**
     * Muestra el formulario para crear un nuevo departamento.
     * Acceso: /departamentos/crear
     */
    public function crear() {
        $this->render('departamentos/formulario', [
            'titulo' => 'Crear Nuevo Departamento',
            'departamento' => null // Para usar la misma vista en crear y editar
        ]);
    }

    /**
     * Procesa el formulario de creación/edición (POST).
     * Acceso: /departamentos/guardar
     */
    public function guardar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);

        if (empty($nombre)) {
            $this->setFlashMessage('error', 'El nombre del departamento es obligatorio.');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $datos = ['nombre' => $nombre];

        if ($id) {
            // Actualizar
            $this->departamentoModel->update($id, $datos);
            $this->setFlashMessage('success', 'Departamento actualizado correctamente.');
        } else {
            // Verificar si ya existe
            $existente = $this->departamentoModel->findByNombre($nombre);
            if ($existente) {
                $this->setFlashMessage('error', 'Ya existe un departamento con ese nombre.');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            // Crear con manejo de excepción
            try {
                $this->departamentoModel->create($datos);
                $this->setFlashMessage('success', 'Departamento creado correctamente.');
            } catch (\PDOException $e) {
                if ($e->getCode() == '23000') {
                    $this->setFlashMessage('error', 'El nombre del departamento ya está registrado.');
                } else {
                    $this->setFlashMessage('error', 'Error inesperado: ' . $e->getMessage());
                }
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        header('Location: /sgen-support/public/departamentos');
        exit;
    }

    header('Location: /sgen-support/public/departamentos/crear');
    exit;
}

    /**
     * Muestra el formulario para editar un departamento existente.
     * Acceso: /departamentos/editar/{id}
     */
    public function editar(int $id) {
        $departamento = $this->departamentoModel->findById($id);

        if (!$departamento) {
            die("Departamento no encontrado.");
        }

        $this->render('departamentos/formulario', [
            'titulo' => 'Editar Departamento',
            'departamento' => $departamento // Pasamos el objeto a la vista
        ]);
    }

    /**
     * Elimina un departamento.
     * Acceso: /departamentos/eliminar/{id}
     */
    public function eliminar(int $id) {
        if ($this->departamentoModel->delete($id)) {
            $this->setFlashMessage('success', "Departamento ID #{$id} eliminado.");
        } else {
            $this->setFlashMessage('error', "No se pudo eliminar el departamento ID #{$id} (puede tener equipos asociados).");
        }
        header('Location: /sgen-support/public/departamentos');
        exit;
    }
}