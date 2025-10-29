<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Soporte;
use App\Models\Equipo;
use App\Models\Departamento;
use App\Models\Usuario;

class SoportesController extends Controller
{
    private $soporteModel;
    private $equipoModel;
    private $departamentoModel;
    private $usuarioModel;

    public function __construct()
    {
        parent::__construct();

        $this->soporteModel      = new Soporte();
        $this->equipoModel       = new Equipo();
        $this->departamentoModel = new Departamento();
        $this->usuarioModel      = new Usuario();
    }

    /**
     * Lista de soportes (visible para todos los roles).
     */
    public function index()
    {
        $soportes = $this->soporteModel->findAllWithDetails();
        $this->render('soportes/lista', [
            'soportes' => $soportes,
            'titulo'   => 'Listado de Soportes'
        ]);
    }

    /**
     * Vista detallada de un ticket.
     */
    public function ver(int $id)
    {
        $soporte = $this->soporteModel->findByIdWithDetails($id);

        if (!$soporte) {
            http_response_code(404);
            die("Error 404: Ticket no encontrado.");
        }

        $this->render('soportes/detalle', [
            'titulo'  => "Detalle de Soporte #{$soporte->id}",
            'soporte' => $soporte
        ]);
    }

    /**
     * Formulario de creación de soporte.
     */
    public function crear()
    {
        $equipos       = $this->equipoModel->findAll();
        $departamentos = $this->departamentoModel->findAll();

        $this->render('soportes/formulario', [
            'titulo'           => 'Crear Nuevo Ticket de Soporte',
            'equipo_list'      => $equipos,
            'departamento_list'=> $departamentos,
            'soporte'          => null
        ]);
    }

    /**
     * Formulario de edición de soporte.
     */
    public function editar(int $id)
    {
        $this->restrictTo(['admin']);

        $soporte = $this->soporteModel->findById($id);
        if (!$soporte) {
            die("Ticket de soporte no encontrado.");
        }

        $equipos       = $this->equipoModel->findAll();
        $departamentos = $this->departamentoModel->findAll();

        $this->render('soportes/formulario', [
            'titulo'           => "Editar Ticket #{$id}",
            'equipo_list'      => $equipos,
            'departamento_list'=> $departamentos,
            'soporte'          => $soporte
        ]);
    }

    /**
     * Procesa creación/edición de soporte.
     */
    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /sgen-support/public/soportes/crear');
            exit;
        }

        $id          = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $equipo_id   = filter_input(INPUT_POST, 'equipo_id', FILTER_SANITIZE_NUMBER_INT);
        $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($descripcion) || empty($equipo_id)) {
            $this->setFlashMessage('error', 'Error: Faltan datos obligatorios (Descripción y Equipo).');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $datos = [
            'equipo_id'   => $equipo_id,
            'descripcion' => $descripcion,
        ];

        if ($id) {
            $this->restrictTo(['admin']);
            if ($this->soporteModel->update($id, $datos)) {
                $this->setFlashMessage('success', "Ticket #{$id} actualizado correctamente.");
            }
            $redirect_id = $id;
        } else {
            $datos['fecha']               = date('Y-m-d H:i:s');
            $datos['estado']              = 'pendiente';
            $datos['usuario_creacion_id'] = $_SESSION['user_id'] ?? null;

            if ($redirect_id = $this->soporteModel->create($datos)) {
                $this->setFlashMessage('success', 'Nuevo ticket de soporte creado exitosamente.');
            }
        }

        header("Location: /sgen-support/public/soportes/ver/{$redirect_id}");
        exit;
    }

    /**
     * Elimina un soporte.
     */
    public function eliminar(int $id)
    {
        $this->restrictTo(['admin']);

        $soporte = $this->soporteModel->findById($id);
        if (!$soporte) {
            die("Error: Ticket de soporte no encontrado.");
        }

        if ($this->soporteModel->delete($id)) {
            $this->setFlashMessage('success', "Ticket #{$id} eliminado correctamente.");
        } else {
            $this->setFlashMessage('error', "Error: No se pudo eliminar el ticket #{$id}.");
        }

        header('Location: /sgen-support/public/soportes');
        exit;
    }

    /**
     * Formulario para asignar técnico.
     */
    public function asignar(int $id)
    {
        $this->restrictTo(['admin', 'tecnico']);

        $soporte = $this->soporteModel->findById($id);
        if (!$soporte || $soporte->estado !== 'pendiente') {
            die("Error: Ticket no encontrado o ya no está pendiente.");
        }

        $tecnicos = $this->usuarioModel->findAllTechnicians();

        $this->render('soportes/asignar_form', [
            'titulo'  => "Asignar Técnico a Soporte #{$id}",
            'soporte' => $soporte,
            'tecnicos'=> $tecnicos
        ]);
    }

    /**
     * Procesa asignación de técnico.
     */
    public function procesar_asignacion()
    {
        $this->restrictTo(['admin', 'tecnico']);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /sgen-support/public/soportes');
            exit;
        }

        $soporte_id  = filter_input(INPUT_POST, 'soporte_id', FILTER_SANITIZE_NUMBER_INT);
        $empleado_id = filter_input(INPUT_POST, 'empleado_id', FILTER_SANITIZE_NUMBER_INT);

        if (empty($soporte_id) || empty($empleado_id)) {
            die("Error: Faltan IDs para la asignación.");
        }

        $updateData = [
            'empleado_id' => $empleado_id,
            'estado'      => 'en_proceso'
        ];

        if ($this->soporteModel->update($soporte_id, $updateData)) {
            header("Location: /sgen-support/public/soportes/ver/{$soporte_id}");
            exit;
        } else {
            die("Error: No se pudo asignar el técnico.");
        }
    }

    /**
     * Marca un ticket como resuelto.
     */
    public function resolver(int $id)
    {
        $this->restrictTo(['admin', 'tecnico']);

        $soporte = $this->soporteModel->findById($id);
        if (!$soporte) {
            $this->setFlashMessage('error', "Error: Ticket #{$id} no encontrado.");
            header("Location: /sgen-support/public/soportes");
            exit;
        }

        if ($soporte->estado !== 'en_proceso') {
            $this->setFlashMessage('error', "Error: El ticket debe estar 'en proceso' para resolverse (Estado actual: {$soporte->estado}).");
            header("Location: /sgen-support/public/soportes/ver/{$id}");
            exit;
        }

        $updateData = [
            'estado'       => 'resuelto',
            'fecha_cierre' => date('Y-m-d H:i:s')
        ];

        if ($this->soporteModel->update($id, $updateData)) {
            $this->setFlashMessage('success', "¡Ticket #{$id} marcado como RESUELTO!");
        } else {
            $this->setFlashMessage('error', "Error fatal al actualizar el ticket en la base de datos.");
        }

        header("Location: /sgen-support/public/soportes/ver/{$id}");
        exit;
    }
}
