<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Departamento extends Model
{
    protected $table = 'departamentos';

    // ==========================
    // MÉTODOS DE CONSULTA
    // ==========================

    /**
     * Busca un departamento por su nombre.
     * @param string $nombre
     * @return object|false
     */

public function findByNombre(string $nombre) {
    $sql = "SELECT * FROM departamentos WHERE nombre = :nombre LIMIT 1";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['nombre' => $nombre]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    /**
     * Verifica si un departamento tiene equipos asociados.
     * @param int $departamento_id
     * @return bool
     */
    public function hasEquipos(int $departamento_id): bool
    {
        $sql = "SELECT COUNT(*) FROM equipos WHERE departamento_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$departamento_id]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function delete(int $id): bool
    {
        try {
            $sql = "DELETE FROM {$this->table} WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        } catch (\PDOException $e) {
            // Error de integridad referencial
            return false;
        }
    }
}

