<?php 
$is_editing = isset($usuario) && $usuario !== null; 
$action_title = $is_editing ? 'Editar' : 'Crear';
?>

<h2><?php echo $action_title; ?> Usuario</h2>

<form action="/sgen-support/public/usuarios/guardar" method="POST">
    
    <?php if ($is_editing): ?>
        <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
    <?php endif; ?>

    <div style="margin-bottom: 15px;">
        <label for="username" style="display: block; font-weight: bold;">Nombre de Usuario:</label>
        <input type="text" id="username" name="username" required 
               value="<?php echo $is_editing ? htmlspecialchars($usuario->username) : ''; ?>"
               style="padding: 8px; width: 300px;"
               >
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="password" style="display: block; font-weight: bold;">Contraseña<?php echo $is_editing ? ' (Dejar vacío para no cambiar)' : ' *'; ?>:</label>
        <input type="password" id="password" name="password" 
               <?php echo $is_editing ? '' : 'required'; ?>
               style="padding: 8px; width: 300px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="rol" style="display: block; font-weight: bold;">Rol de Usuario:</label>
        <select id="rol" name="rol" required style="padding: 8px; width: 300px;">
            <option value="">-- Seleccionar Rol --</option>
            <?php 
            $current_rol = $is_editing ? $usuario->rol : '';
            // $allowedRoles viene del controlador
            if (isset($allowedRoles) && is_array($allowedRoles)):
                foreach ($allowedRoles as $rol): 
                    $selected = ($current_rol === $rol) ? 'selected' : '';
            ?>
                    <option value="<?php echo $rol; ?>" <?php echo $selected; ?>>
                        <?php echo ucfirst($rol); ?>
                    </option>
            <?php 
                endforeach;
            endif;
            ?>
        </select>
    </div>

    <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer;">
        <?php echo $is_editing ? 'Actualizar' : 'Crear'; ?> Usuario
    </button>
    <a href="/sgen-support/public/usuarios" style="margin-left: 10px; text-decoration: none; color: #6c757d;">Cancelar</a>
</form>