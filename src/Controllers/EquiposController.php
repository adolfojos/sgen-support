<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Equipo;
use App\Models\Departamento; // Necesario para el dropdown

class EquiposController extends Controller {
    
    private $equipoModel;
    private $departamentoModel;

    public function __construct() {
        parent::__construct(); 
        
        $this->equipoModel = new Equipo();
        $this->departamentoModel = new Departamento();
        
        // **RESTRICCIÓN GLOBAL:** Solo el administrador puede acceder.
        $this->restrictTo(['admin']); 
    }

    /**
     * Muestra la lista de todos los equipos.
     * Acceso: /equipos
     */
    public function index() {
        $equipos = $this->equipoModel->findAllWithDepartmentName();

        $this->render('equipos/lista', [
            'titulo' => 'Gestión de Equipos',
            'equipos' => $equipos
        ]);
    }

    /**
     * Muestra el formulario para crear/editar.
     * Acceso: /equipos/crear | /equipos/editar/{id}
     */
    public function crear(int $id = null) {
        $equipo = null;
        if ($id) {
            $equipo = $this->equipoModel->findById($id);
            if (!$equipo) {
                die("Equipo no encontrado.");
            }
        }
        
        // Obtener departamentos para el <select>
        $departamentos = $this->departamentoModel->findAll();

        $this->render('equipos/formulario', [
            'titulo' => ($id ? 'Editar' : 'Registrar Nuevo') . ' Equipo',
            'equipo' => $equipo,
            'departamentos' => $departamentos
        ]);
    }
    
    // Simplificamos 'editar' llamando a 'crear'
    public function editar(int $id) {
        $this->crear($id);
    }


    /**
     * Procesa el formulario (POST).
     * Acceso: /equipos/guardar
     */
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $serial = filter_input(INPUT_POST, 'serial', FILTER_SANITIZE_SPECIAL_CHARS);
            $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
            $departamento_id = filter_input(INPUT_POST, 'departamento_id', FILTER_SANITIZE_NUMBER_INT);
            // Usamos FILTER_DEFAULT ya que no hay FILTER_SANITIZE_STRING
            $modelo = filter_input(INPUT_POST, 'modelo', FILTER_SANITIZE_SPECIAL_CHARS); 

            if (empty($serial) || empty($tipo) || empty($departamento_id)) {
                die("Error: Los campos Serial, Tipo y Departamento son obligatorios.");
            }

            $datos = [
                'serial' => $serial,
                'tipo' => $tipo,
                'departamento_id' => $departamento_id,
                'modelo' => $modelo
            ];

            if ($id) {
                // Actualizar
                $this->equipoModel->update($id, $datos);
            } else {
                // Crear
                $this->equipoModel->create($datos);
            }
            
            header('Location: /sgen-support/public/equipos');
            exit;
        }
        header('Location: /sgen-support/public/equipos/crear');
        exit;
    }

    /**
     * Elimina un equipo.
     * Acceso: /equipos/eliminar/{id}
     */
    public function eliminar(int $id) {
        $this->equipoModel->delete($id);
        
        header('Location: /sgen-support/public/equipos');
        exit;
    }
}