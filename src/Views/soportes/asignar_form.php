<h2><?php echo $titulo; ?></h2>

<p>Ticket: <strong>#<?php echo $soporte->id; ?></strong> | Estado: <span class="estado-<?php echo $soporte->estado; ?>"><?php echo $soporte->estado; ?></span></p>

<form action="/sgen-support/public/soportes/procesar_asignacion" method="POST">
    
    <input type="hidden" name="soporte_id" value="<?php echo $soporte->id; ?>">

<div style="margin-bottom: 20px;">
    <label for="empleado_id" style="display: block; font-weight: bold; margin-bottom: 5px;">Seleccionar Técnico:</label>
    <select id="empleado_id" name="empleado_id" required style="padding: 10px; width: 300px;">
        <option value="">-- Seleccione un Técnico --</option>
        <?php 
        // $tecnicos viene del controlador (filtrados por rol = 'tecnico')
        if (isset($tecnicos) && is_array($tecnicos)):
            foreach ($tecnicos as $tecnico): 
                $selected = ($_SESSION['user_id'] == $tecnico->id) ? 'selected' : '';
        ?>
<option value="<?php echo $tecnico->empleado_id; ?>" 
        <?php echo ($_SESSION['user_id'] == $tecnico->usuario_id) ? 'selected' : ''; ?>>
    <?php echo htmlspecialchars($tecnico->username . " (" . $tecnico->nombre . " " . $tecnico->apellido . ")"); ?>
</option>

        <?php 
            endforeach;
        endif;
        ?>
    </select>
    <?php if (empty($tecnicos)): ?>
        <p style="color: red;">¡Advertencia! No hay empleados con rol 'tecnico' para asignar.</p>
    <?php endif; ?>
</div>


    <button type"submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer;">
        Confirmar Asignación
    </button>
    <a href="/sgen-support/public/soportes/ver/<?php echo $soporte->id; ?>" style="margin-left: 10px; text-decoration: none; color: #6c757d;">Cancelar</a>
</form>