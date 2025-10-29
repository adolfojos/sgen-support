<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Empleado extends Model {
    protected $table = 'empleados';

    /**
     * Busca todos los empleados con el username del usuario asociado.
     */
    public function findAllWithUserDetails() {
        $sql = "
            SELECT 
                e.*, 
                u.username AS usuario_username
            FROM {$this->table} e
            LEFT JOIN usuarios u ON e.usuario_id = u.id
            ORDER BY e.apellido ASC, e.nombre ASC
        ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
}