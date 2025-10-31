<?php 
    $is_editing = isset($soporte) && $soporte !== null; 
    $action_title = $is_editing ? 'Editar' : 'Crear';
?>
<div class="conten-body">
    <div class="col s12 m12 l12">
        <div class="card-panel">
            <div class="card-title">
                <div class="row">
                    <div class="header-title-left col s12">
                        <h5><?php echo $titulo; ?></h5>
                    </div>
                </div>
            </div>
            <form action="/sgen-support/public/soportes/guardar" method="POST">
            <?php if ($is_editing): ?>
                <input type="hidden" name="id" value="<?php echo $soporte->id; ?>">
            <?php endif; ?>
                <div class="row">
                    <div class="input-field col s12 ">
                        <select id="equipo_id" name="equipo_id" required>
                            <option value="" disabled selected>Seleccionar Equipo</option>
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
                        <label class="required" for="equipo_id">Equipo Afectado:</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" id="descripcion" name="descripcion" required value="<?php echo $is_editing ? htmlspecialchars($soporte->descripcion) : '';?>">
                        <label class="required" for="descripcion">Descripción del Problema:</label>
                    </div>
                </div>
                <div class="row btn-actions">
                    <div class="col l12">
                        <button type="submit" class="btn waves-effect waves-light btn-first">
                            Guardar
                        </button>
                        <a href="/sgen-support/public/soportes" class="btn grey">Regresar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>