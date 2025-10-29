<?php 
$is_editing = isset($equipo) && $equipo !== null; 
$action_title = $is_editing ? 'Editar' : 'Registrar';
$current_dept_id = $is_editing ? $equipo->departamento_id : '';
?>

<h2><?php echo $action_title; ?> Equipo</h2>

<form action="/sgen-support/public/equipos/guardar" method="POST">
    
    <?php if ($is_editing): ?>
        <input type="hidden" name="id" value="<?php echo $equipo->id; ?>">
    <?php endif; ?>

    <div style="margin-bottom: 15px;">
        <label for="serial" style="display: block; font-weight: bold;">Serial/Inventario:</label>
        <input type="text" id="serial" name="serial" required 
               value="<?php echo $is_editing ? htmlspecialchars($equipo->serial) : ''; ?>"
               style="padding: 8px; width: 300px;">
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="tipo" style="display: block; font-weight: bold;">Tipo de Equipo (Ej: Computadoras,Impresora, escaner, otro):</label>
        <input type="text" id="tipo" name="tipo" required 
               value="<?php echo $is_editing ? htmlspecialchars($equipo->tipo) : ''; ?>"
               style="padding: 8px; width: 300px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="departamento_id" style="display: block; font-weight: bold;">Departamento:</label>
        <select id="departamento_id" name="departamento_id" required style="padding: 8px; width: 300px;">
            <option value="">-- Seleccionar Departamento --</option>
            <?php 
            // $departamentos viene del controlador
            if (isset($departamentos) && is_array($departamentos)):
                foreach ($departamentos as $d): 
                    $selected = ($current_dept_id == $d->id) ? 'selected' : '';
            ?>
                    <option value="<?php echo $d->id; ?>" <?php echo $selected; ?>>
                        <?php echo htmlspecialchars($d->nombre); ?>
                    </option>
            <?php 
                endforeach;
            endif;
            ?>
        </select>
        <?php if (empty($departamentos)): ?>
            <p style="color: red;">¡Advertencia! No hay departamentos. <a href="/sgen-support/public/departamentos/crear">Cree uno primero</a>.</p>
        <?php endif; ?>
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="modelo" style="display: block; font-weight: bold;">Modelo:</label>
        <textarea id="modelo" name="modelo" rows="4" 
                  style="padding: 8px; width: 300px;"><?php echo $is_editing ? htmlspecialchars($equipo->modelo) : ''; ?></textarea>
    </div>


    <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer;">
        <?php echo $is_editing ? 'Actualizar' : 'Registrar'; ?> Equipo
    </button>
    <a href="/sgen-support/public/equipos" style="margin-left: 10px; text-decoration: none; color: #6c757d;">Cancelar</a>
</form>