<?php 
$is_editing = isset($soporte) && $soporte !== null; 
$action_title = $is_editing ? 'Editar' : 'Crear';
?>

<h2><?php echo $titulo; ?></h2>

<form action="/sgen-support/public/soportes/guardar" method="POST">
    
    <?php if ($is_editing): ?>
        <input type="hidden" name="id" value="<?php echo $soporte->id; ?>">
    <?php endif; ?>

    <div style="margin-bottom: 15px;">
        <label for="equipo_id" style="display: block; font-weight: bold;">Equipo Afectado:</label>
        <select id="equipo_id" name="equipo_id" required style="padding: 8px; width: 300px;">
            <option value="">-- Seleccionar Equipo --</option>
            <?php 
            // $equipo_list viene del controlador
            $current_equipo_id = $is_editing ? $soporte->equipo_id : null;
            if (isset($equipo_list) && is_array($equipo_list)):
                foreach ($equipo_list as $e): 
                    $selected = ($current_equipo_id == $e->id) ? 'selected' : '';
            ?>
                    <option value="<?php echo $e->id; ?>" <?php echo $selected; ?>>
                        <?php echo htmlspecialchars("{$e->serial} ({$e->tipo} - {$e->modelo})"); ?>
                    </option>
            <?php 
                endforeach;
            endif;
            ?>
        </select>
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="descripcion" style="display: block; font-weight: bold;">Descripción del Problema:</label>
        <textarea id="descripcion" name="descripcion" rows="5" required 
                  style="padding: 8px; width: 400px;"><?php 
                      echo $is_editing ? htmlspecialchars($soporte->descripcion) : ''; 
                  ?></textarea>
    </div>

    <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer;">
        <?php echo $is_editing ? 'Actualizar Ticket' : 'Crear Ticket'; ?>
    </button>
    <a href="/sgen-support/public/soportes" style="margin-left: 10px; text-decoration: none; color: #6c757d;">Cancelar</a>
</form>