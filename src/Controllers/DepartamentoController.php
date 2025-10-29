<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    private $departamentoModel;

    public function __construct()
    {
        parent::__construct();

        $this->departamentoModel = new Departamento();

        // Restricción global: solo el administrador puede acceder a este controlador
        $this->restrictTo(['admin']);
    }

    // ==========================
    // LISTADO Y VISTAS
    // ==========================

    public function index()
    {
        $departamentos = $this->departamentoModel->findAll();

        $this->render('departamentos/lista', [
            'titulo'        => 'Gestión de Departamentos',
            'departamentos' => $departamentos
        ]);
    }

    public function crear()
    {
        $this->render('departamentos/formulario', [
            'titulo'       => 'Crear Nuevo Departamento',
            'departamento' => null
        ]);
    }

    public function editar(int $id)
    {
        $departamento = $this->departamentoModel->findById($id);

        if (!$departamento) {
            $this->setFlashMessage('error', 'Departamento no encontrado.');
            header('Location: /sgen-support/public/departamentos');
            exit;
        }

        $this->render('departamentos/formulario', [
            'titulo'       => 'Editar Departamento',
            'departamento' => $departamento
        ]);
    }

    // ==========================
    // PROCESOS (CRUD)
    // ==========================

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id     = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nombre = trim(filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS));

            // Validación: nombre obligatorio
            if (empty($nombre)) {
                $this->setFlashMessage('error', 'El nombre del departamento es obligatorio.');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            // Validación: evitar duplicados
            $existente = $this->departamentoModel->findByName($nombre);

            if ($existente && (int)$existente->id !== (int)$id) {
                $this->setFlashMessage('error', "Ya existe un departamento con el nombre '{$nombre}'.");
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $datos = ['nombre' => $nombre];

            if ($id) {
                // Actualizar
                $this->departamentoModel->update($id, $datos);
                $this->setFlashMessage('success', "Departamento actualizado correctamente.");
            } else {
                // Crear
                $this->departamentoModel->create($datos);
                $this->setFlashMessage('success', "Departamento creado exitosamente.");
            }

            header('Location: /sgen-support/public/departamentos');
            exit;
        }

        header('Location: /sgen-support/public/departamentos/crear');
        exit;
    }

    public function eliminar(int $id)
    {
        // Validar si el departamento tiene equipos asociados
        if ($this->departamentoModel->hasEquipos($id)) {
            $this->setFlashMessage(
                'error',
                "No se puede eliminar el departamento porque tiene equipos asociados."
            );
            header('Location: /sgen-support/public/departamentos');
            exit;
        }

        // Si no tiene equipos, proceder con la eliminación
        if ($this->departamentoModel->delete($id)) {
            $this->setFlashMessage('success', "Departamento eliminado correctamente.");
        } else {
            $this->setFlashMessage('error', "Error al intentar eliminar el departamento.");
        }

        header('Location: /sgen-support/public/departamentos');
        exit;
    }
}
