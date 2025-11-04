<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\SesionLog;

class LogController extends Controller {
    
    private $logModel;

    public function __construct() {
        parent::__construct(); 
        
        // **RESTRICCIÓN CRÍTICA:** Solo los 'admin' pueden ver los logs.
        $this->restrictTo(['admin']); 
        
        $this->logModel = new SesionLog();
    }

    /**
     * Muestra la lista de todos los registros de sesión.
     * Acceso: /log/index  o  /log
     */
    public function index() {
        $logs = $this->logModel->findAllSorted();

        $this->render('logs/lista', [
            'titulo' => 'Auditoría de Sesiones de Usuario',
            'logs' => $logs
        ]);
    }
}