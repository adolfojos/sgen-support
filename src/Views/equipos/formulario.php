<!-- Menú lateral izquierdo (plantilla base) -->
<aside id="left-side-menu">
    <ul class="collapsible collapsible-accordion">
        <li class="no-padding">
            <a href="RUTA_1.html" class="waves-effect waves-grey">
                <i class="material-icons">menu</i>Nombre Sección 1
            </a>
        </li>
        <li class="no-padding">
            <a href="RUTA_2.html" class="waves-effect waves-grey">
                <i class="material-icons">menu</i>Nombre Sección 2
            </a>
        </li>
    </ul>
</aside>

<?php 
    $is_editing = isset($equipo) && $equipo !== null; 
    $action_title = $is_editing ? 'Editar' : 'Registrar';
    $current_dept_id = $is_editing ? $equipo->departamento_id : '';
?>

<article>
    <div class="conten-body">
        <div class="card-panel">
            <!-- Título -->
            <div class="card-title">
                <div class="row">
                    <div class="header-title-left col s12">
                        <h5><?php echo $action_title; ?> Equipo</h5>
                    </div>
                </div>
            </div>

            <!-- Formulario -->
            <form action="<?=BASE_URL?>equipos/guardar" method="POST">
                <?php if ($is_editing): ?>
                    <input type="hidden" name="id" value="<?php echo $equipo->id; ?>">
                <?php endif; ?>

                <div id="pp">
                    <!-- Serial -->
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="serial" name="serial" required value="<?php echo $is_editing ? htmlspecialchars($equipo->serial) : ''; ?>" />
                            <label class="required" for="serial">Serial/Inventario:</label>
                        </div>
                    </div>

                    <!-- Tipo -->
                    <div class="row">
                        <div class="input-field col s12">   
                            <input type="text" id="tipo" name="tipo" required value="<?php echo $is_editing ? htmlspecialchars($equipo->tipo) : ''; ?>" />
                            <label class="required" for="tipo">Tipo de Equipo (Ej: Computadoras, Impresora, Escáner, Otro):</label>
                        </div>
                    </div>

                    <!-- Departamento -->
                    <div class="row">
                        <div class="input-field col s12">
                            <select id="departamento_id" name="departamento_id" required>
                                <option value="" disabled selected>Seleccionar Departamento</option>
                                <?php 
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
                                <p style="color: red;">
                                    ¡Advertencia! No hay departamentos. 
                                    <a href="<?=BASE_URL?>departamentos/crear">Cree uno primero</a>.
                                </p>
                            <?php endif; ?>
                            <label class="required" for="departamento_id">Departamento:</label>
                        </div>
                    </div>

                    <!-- Modelo -->
                    <div class="row">
                        <div class="input-field col s12">   
                            <input type="text" id="modelo" name="modelo" required value="<?php echo $is_editing ? htmlspecialchars($equipo->modelo) : ''; ?>" />
                            <label class="required" for="modelo">Modelo:</label>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="row btn-actions">
                    <div class="col l12">
                        <button type="submit" name="action" class="btn waves-effect waves-light btn-first">
                            <?php echo $is_editing ? 'Actualizar' : 'Registrar'; ?> Equipo
                        </button>
                        <a href="<?=BASE_URL?>equipos" class="btn grey" title="Regresar">Regresar</a>
                    </div>
                </div>
            </form>
        </div> <!-- card-panel -->
    </div> <!-- conten-body -->
</article>
