<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Soporte extends Model
{
    // Tabla asociada al modelo
    protected $table = 'soportes';

    // Propiedades (opcional, pero buena práctica)
    public $id;
    public $fecha;
    public $descripcion;
    public $estado;
    public $equipo_id;
    public $empleado_id; // Técnico asignado

    // ==========================
    // MÉTODOS DE CONSULTA
    // ==========================

    /**
     * Obtiene todos los tickets con detalles de equipo, departamento y técnico.
     */
    public function findAllWithDetails()
    {
        $sql = "
            SELECT 
                s.*, 
                e.serial AS equipo_serial, 
                e.tipo AS equipo_tipo,
                d.nombre AS departamento_nombre,
                u.username AS tecnico_asignado
            FROM {$this->table} s
            JOIN equipos e ON s.equipo_id = e.id
            JOIN departamentos d ON e.departamento_id = d.id
            LEFT JOIN empleados emp ON s.empleado_id = emp.id
            LEFT JOIN usuarios u ON emp.usuario_id = u.id
            ORDER BY s.fecha DESC
        ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Busca un ticket por ID con todos sus detalles.
     */
    public function findByIdWithDetails(int $id)
    {
        $sql = "
            SELECT 
                s.*, 
                eq.serial AS equipo_serial, 
                eq.tipo AS equipo_tipo,
                eq.modelo AS equipo_modelo,
                d.nombre AS departamento_nombre,
                CONCAT(emp.nombre, ' ', emp.apellido) AS nombre_tecnico,
                u.username AS tecnico_asignado
            FROM {$this->table} s
            JOIN equipos eq ON s.equipo_id = eq.id
            JOIN departamentos d ON eq.departamento_id = d.id
            LEFT JOIN empleados emp ON s.empleado_id = emp.id
            LEFT JOIN usuarios u ON emp.usuario_id = u.id
            WHERE s.id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // ==========================
    // MÉTODOS DE ESCRITURA
    // ==========================

    /**
     * Crea un nuevo ticket de soporte.
     * @param array $data ['descripcion' => '...', 'equipo_id' => 5]
     * @return int|false Devuelve el ID insertado o false en caso de error
     */
    public function create(array $data)
    {
        if (empty($data['descripcion']) || empty($data['equipo_id'])) {
            return false;
        }

        $sql = "INSERT INTO {$this->table} (descripcion, equipo_id, estado, fecha) 
                VALUES (?, ?, 'pendiente', NOW())";

        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute([
            $data['descripcion'],
            $data['equipo_id']
        ])) {
            return (int) $this->pdo->lastInsertId();
        }

        return false;
    }

    /**
     * Asigna un técnico y cambia el estado a 'en_proceso'.
     */
    public function assign(int $soporte_id, int $tecnico_id)
    {
        $sql = "UPDATE {$this->table} 
                SET empleado_id = ?, estado = 'en_proceso' 
                WHERE id = ?";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$tecnico_id, $soporte_id]);
    }

    // ==========================
    // MÉTODOS DE ESTADÍSTICAS
    // ==========================

    /**
     * Obtiene estadísticas clave para el Dashboard.
     */
    public function getDashboardStats()
    {
        $sql = "
            SELECT 
                COUNT(id) AS total_tickets,
                SUM(CASE WHEN estado = 'pendiente' THEN 1 ELSE 0 END) AS total_pendientes,
                SUM(CASE WHEN estado = 'en_proceso' THEN 1 ELSE 0 END) AS total_en_proceso,
                SUM(CASE WHEN estado = 'resuelto' AND DATE(fecha_cierre) = CURDATE() THEN 1 ELSE 0 END) AS resueltos_hoy
            FROM {$this->table}
        ";
        
        $stmt = $this->pdo->query($sql);
        $stats = $stmt->fetch(PDO::FETCH_OBJ);

        // Normalizamos valores nulos a 0
        $stats->total_tickets   = $stats->total_tickets ?? 0;
        $stats->total_pendientes= $stats->total_pendientes ?? 0;
        $stats->total_en_proceso= $stats->total_en_proceso ?? 0;
        $stats->resueltos_hoy   = $stats->resueltos_hoy ?? 0;
        
        return $stats;
    }
    /**
 * Obtiene los últimos tickets pendientes.
 * @param int $limit Número de tickets a devolver (por defecto 5)
 * @return array Lista de tickets pendientes
 */
    public function findLatestPending(int $limit = 5): array
    {
        $sql = "
            SELECT 
                s.*, 
                e.serial AS equipo_serial, 
                e.tipo AS equipo_tipo,
                d.nombre AS departamento_nombre,
                u.username AS tecnico_asignado
            FROM {$this->table} s
            JOIN equipos e ON s.equipo_id = e.id
            JOIN departamentos d ON e.departamento_id = d.id
            LEFT JOIN empleados emp ON s.empleado_id = emp.id
            LEFT JOIN usuarios u ON emp.usuario_id = u.id
            WHERE s.estado = 'pendiente'
            ORDER BY s.fecha DESC
            LIMIT ?
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}
