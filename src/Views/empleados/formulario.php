<?php 
$is_editing = isset($empleado) && $empleado !== null; 
$action_title = $is_editing ? 'Editar' : 'Registrar';
$current_user_id = $is_editing ? $empleado->usuario_id : '';
?>

<h2><?php echo $action_title; ?> Empleado</h2>

<form action="/sgen-support/public/empleados/guardar" method="POST">
    
    <?php if ($is_editing): ?>
        <input type="hidden" name="id" value="<?php echo $empleado->id; ?>">
    <?php endif; ?>

    <div style="margin-bottom: 15px;">
        <label for="nombre" style="display: block; font-weight: bold;">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required 
               value="<?php echo $is_editing ? htmlspecialchars($empleado->nombre) : ''; ?>"
               style="padding: 8px; width: 300px;">
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="apellido" style="display: block; font-weight: bold;">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required 
               value="<?php echo $is_editing ? htmlspecialchars($empleado->apellido) : ''; ?>"
               style="padding: 8px; width: 300px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="email" style="display: block; font-weight: bold;">Email:</label>
        <input type="email" id="email" name="email" required 
               value="<?php echo $is_editing ? htmlspecialchars($empleado->email) : ''; ?>"
               style="padding: 8px; width: 300px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="usuario_id" style="display: block; font-weight: bold;">Cuenta de Usuario (Login):</label>
        <select id="usuario_id" name="usuario_id" style="padding: 8px; width: 300px;">
            <option value="">-- NO VINCULAR --</option>
            <?php 
            // $usuarios_disponibles viene del controlador
            if (isset($usuarios_disponibles) && is_array($usuarios_disponibles)):
                foreach ($usuarios_disponibles as $u): 
                    $selected = ($current_user_id == $u->id) ? 'selected' : '';
            ?>
                    <option value="<?php echo $u->id; ?>" <?php echo $selected; ?>>
                        <?php echo htmlspecialchars($u->username); ?> (<?php echo ucfirst($u->rol); ?>)
                    </option>
            <?php 
                endforeach;
            endif;
            ?>
        </select>
        <small style="display: block; color: #6c757d;">Solo aparecen usuarios no vinculados, o el usuario vinculado actualmente.</small>
    </div>

    <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer;">
        <?php echo $is_editing ? 'Actualizar' : 'Registrar'; ?> Empleado
    </button>
    <a href="/sgen-support/public/empleados" style="margin-left: 10px; text-decoration: none; color: #6c757d;">Cancelar</a>
</form>