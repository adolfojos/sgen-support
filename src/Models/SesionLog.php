<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class SesionLog extends Model {
    protected $table = 'sesiones_log';

    /**
     * Registra el inicio de sesión y devuelve el ID del nuevo registro.
     */
    public function createLog(int $usuario_id, string $username): int {
        $sql = "INSERT INTO {$this->table} (usuario_id, username, fecha_inicio) VALUES (?, ?, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usuario_id, $username]);
        
        // Devuelve el ID recién insertado para usarlo en el logout
        return (int)$this->pdo->lastInsertId(); 
    }

    /**
     * Actualiza el registro con la fecha y hora de finalización de la sesión.
     */
    public function updateLogoutTime(int $log_id): bool {
        $sql = "UPDATE {$this->table} SET fecha_fin = NOW() WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([$log_id]);
    }

    /**
     * Busca todos los registros de log, ordenados por fecha de inicio (más recientes primero).
     * Limitamos a 200 para evitar sobrecargar la página.
     */
    public function findAllSorted() {
        $sql = "SELECT * FROM {$this->table} ORDER BY fecha_inicio DESC LIMIT 200";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}