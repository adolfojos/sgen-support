<?php 
$is_editing = isset($equipo) && $equipo !== null; 
$action_title = $is_editing ? 'Editar' : 'Registrar';
$current_dept_id = $is_editing ? $equipo->departamento_id : '';
?>
<article>
<div class="conten-body">
<div class="card-panel">
<div class="card-title">
<div class="row">
<div class="header-title-left col s12">
<h5><?php echo $action_title; ?> Equipo</h5>
</div>
</div>
</div>
<form action="<?=BASE_URL?>equipos/guardar" method="POST">
<?php if ($is_editing): ?>
<input type="hidden" name="id" value="<?php echo $equipo->id; ?>">
<?php endif; ?>
<div id="pp">
<div class="row">
<div class="input-field col s12">
<input type="text" id="_pp_firstName" name="_pp[firstName]" required="required" class="" value="Adolfo José" />
<label class="required" for="_pp_firstName">Nombre</label>
</div>
</div>
<div class="row">
<div class="input-field col s12">   
<input type="text" id="_pp_lastName" name="_pp[lastName]" required="required" class="" value="Suárez Rondón" />
<label class="required" for="_pp_lastName">Apellidos</label>
</div>
</div><div class="row">
<div class="input-field col s12">
<select id="_pp_sex" name="_pp[sex]" required="required">
<option value="" disabled="disabled" >Selecciona</option>
<option value="F">Femenino</option>
<option value="M" selected="selected">Masculino</option>
</select>
<label class="required" for="_pp_sex">Sexo</label>
</div>
</div>
<div class="row">
<div class="input-field col s12">   
<input type="text" id="_pp_birthdate" name="_pp[birthdate]" required="required" class="datepicker" value="20/10/1987" />
<label class="required" for="_pp_birthdate">Fecha de nacimiento:</label>
</div>
</div>
<input type="hidden" id="_pp__token" name="_pp[_token]" value="" />
</div>
<div class="row btn-actions">
<div class="col l12">
<button type="submit" name="action" class="btn waves-effect waves-light btn-first">Guardar</button>
<a href="/perfil/personal/" class="btn grey" title="Regresar">Regresar</a>
</div>
</div>
</form>
</div>
</div>
</article>




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
<option value="<?php echo $d->id; ?>"<?php echo $selected; ?>>
<?php echo htmlspecialchars($d->nombre); ?>
</option>
<?php 
endforeach;
endif;
?>
</select>
<?php if (empty($departamentos)): ?>
<p style="color: red;">¡Advertencia! No hay departamentos.<a href="<?=BASE_URL?>departamentos/crear">Cree uno primero</a>.</p>
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
<a href="<?=BASE_URL?>equipos" style="margin-left: 10px; text-decoration: none; color: #6c757d;">Cancelar</a>
</form>