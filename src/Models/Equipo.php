<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Equipo extends Model {
    protected $table = 'equipos';

    /**
     * Obtiene todos los equipos con el nombre del departamento asociado.
     */
    public function findAllWithDetails() {
        $sql = "SELECT 
                    e.*, 
                    d.nombre AS departamento_nombre
                FROM equipos AS e
                LEFT JOIN departamentos AS d ON e.departamento_id = d.id
                ORDER BY e.serial ASC";
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Busca todos los equipos con el nombre del departamento asociado.
     */
    public function findAllWithDepartmentName() {
        $sql = "
            SELECT 
                e.*, 
                d.nombre AS departamento_nombre
            FROM {$this->table} e
            JOIN departamentos d ON e.departamento_id = d.id
            ORDER BY e.serial ASC
        ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    // Model hereda: findAll() y findById($id)
}