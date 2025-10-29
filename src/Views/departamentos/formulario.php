<?php 
$is_editing = isset($departamento) && $departamento !== null; 
$action_title = $is_editing ? 'Editar' : 'Crear';
?>

<h2><?php echo $action_title; ?> Departamento</h2>

<form action="/sgen-support/public/departamentos/guardar" method="POST">
    
    <?php if ($is_editing): ?>
        <input type="hidden" name="id" value="<?php echo $departamento->id; ?>">
    <?php endif; ?>

    <div style="margin-bottom: 15px;">
        <label for="nombre" style="display: block; font-weight: bold;">Nombre del Departamento:</label>
        <input type="text" id="nombre" name="nombre" required 
               value="<?php echo $is_editing ? htmlspecialchars($departamento->nombre) : ''; ?>"
               style="padding: 8px; width: 300px;">
    </div>

    <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer;">
        <?php echo $is_editing ? 'Actualizar' : 'Guardar'; ?>
    </button>
    <a href="/sgen-support/public/departamentos" style="margin-left: 10px; text-decoration: none; color: #6c757d;">Cancelar</a>
</form>