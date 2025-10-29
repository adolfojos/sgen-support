<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Soporte;

class HomeController extends Controller
{
    private $soporteModel;

    public function __construct()
    {
        parent::__construct(); // Ejecuta el checkAuth() (requiere login)
        $this->soporteModel = new Soporte();
    }

    /**
     * Muestra la página principal (Dashboard).
     * Acceso: /
     */
    public function index()
    {
    // 1. Obtener estadísticas
    $stats = $this->soporteModel->getDashboardStats();

    // 2. Obtener últimos 5 tickets pendientes
    $ultimos_tickets = $this->soporteModel->findLatestPending(5);

    // 3. Renderizar la vista
    $this->render('dashboard/index', [
        'titulo'          => 'Dashboard - Resumen General',
        'stats'           => $stats,
        'ultimos_tickets' => $ultimos_tickets
    ]);
    }
}
