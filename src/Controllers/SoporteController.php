<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Soporte;

class SoporteController extends Controller {

    private $soporteModel;

    public function __construct() {
        // 1. Llama al constructor del padre (Core/Controller)
        // Esto ejecuta automáticamente checkAuth()
        parent::__construct(); 
        
        $this->soporteModel = new Soporte();
    }

    /**
     * Muestra la lista. Todos los logueados pueden ver.
     */
    public function index() {
        // Todos ('admin', 'tecnico', 'consultor') pueden ver la lista
        $soportes = $this->soporteModel->findAllWithDetails();
        $this->render('soportes/lista', [
            'soportes' => $soportes,
            'titulo' => 'Listado de Soportes'
        ]);
    }

    /**
     * Muestra el formulario para crear.
     */
    public function crear() {
        // 2. Restringimos: Solo 'admin' y 'consultor' pueden CREAR tickets
        // (Asumimos que 'tecnico' solo los resuelve)
        $this->restrictTo(['admin', 'consultor']);
        
        $this->render('soportes/formulario', [
            'titulo' => 'Abrir Nuevo Ticket'
        ]);
    }

    /**
     * Procesa el formulario de creación (POST).
     */
    public function guardar() {
        // 3. También restringimos el POST
        $this->restrictTo(['admin', 'consultor']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // (Lógica de guardado...)
            $datos = [ /* ... */ ];
            $this->soporteModel->create($datos);
            header('Location: /sgen-support/public/soportes');
            exit;
        }
    }

    /**
     * Muestra formulario para asignar técnico (Ejemplo)
     */
    public function asignar($id) {
        // 4. Solo 'admin' y 'tecnico' pueden asignar/gestionar
        $this->restrictTo(['admin', 'tecnico']);

        // (Lógica para buscar soporte y técnicos...)
        $this->render('soportes/asignar', [
            'titulo' => 'Asignar Técnico',
            // 'soporte' => $soporte,
            // 'tecnicos' => $tecnicos
        ]);
    }
}