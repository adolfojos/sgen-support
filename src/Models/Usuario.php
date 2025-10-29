<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Usuario extends Model {
    protected $table = 'usuarios';

    /**
     * Crea un nuevo usuario con la contraseña hasheada.
     */
    public function crearUsuario(string $username, string $password, string $rol) {
        // 1. Hashear la contraseña
        // PASSWORD_DEFAULT es el algoritmo más fuerte que tu PHP soporta (actualmente bcrypt)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO {$this->table} (username, password, rol) 
                    VALUES (?, ?, ?)";
            
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$username, $hashedPassword, $rol]);

        } catch (\PDOException $e) {
            // Manejar error de 'username' duplicado (SQLSTATE[23000])
            if ($e->getCode() == 23000) {
                return false; // Indica que el usuario ya existe
            }
            throw $e; // Lanza otras excepciones
        }
    }

    /**
     * Busca un usuario por su nombre de usuario.
     */
    public function findByUsername(string $username) {
        $sql = "SELECT * FROM {$this->table} WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Busca todos los usuarios con rol 'tecnico'.
     */
public function findAllTechnicians() {
    $sql = "SELECT 
                u.id AS usuario_id,
                u.username,
                e.id AS empleado_id,
                e.nombre,
                e.apellido
            FROM usuarios u
            INNER JOIN empleados e ON e.usuario_id = u.id
            WHERE u.rol = 'tecnico'
            ORDER BY u.username ASC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


    /**
     * Busca usuarios que NO tienen un empleado asignado (usuario_id IS NULL en la tabla empleados).
     * Incluye el usuario_id del empleado que se está editando (si aplica).
     */
    public function findUnassignedUsers(int $current_user_id = null) {
        // Selecciona todos los usuarios
        $sql = "
            SELECT 
                u.id, 
                u.username, 
                u.rol
            FROM usuarios u
            LEFT JOIN empleados e ON u.id = e.usuario_id
            WHERE e.usuario_id IS NULL 
            OR u.id = ? 
            ORDER BY u.username ASC
        ";
        
        $stmt = $this->pdo->prepare($sql);
        // Usamos $current_user_id para asegurarnos de que el usuario actualmente vinculado al empleado
        // (si estamos editando) aparezca como opción. Si no estamos editando, se usa NULL o 0.
        $stmt->execute([$current_user_id ?: 0]); 
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}