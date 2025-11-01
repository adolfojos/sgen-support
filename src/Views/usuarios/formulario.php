<?php 
    $is_editing = isset($usuario) && $usuario !== null; 
    $action_title = $is_editing ? 'Editar' : 'Crear';
?>
<article>
    <div class="conten-body">
        <div class="card-panel">
            <!-- Título -->
            <div class="card-title">
                <div class="row">
                    <div class="header-title-left col s12">
                        <h5><?php echo $action_title; ?> Usuario</h5>
                    </div>
                </div>
            </div>          
            <!-- Formulario -->
            <form action="<?=BASE_URL?>usuarios/guardar" method="POST">
                <?php if ($is_editing): ?>
                    <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                <?php endif; ?>
                <div id="usuario-form">
                    <!-- Nombre de Usuario: -->
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="username" name="username" required value="<?php echo $is_editing ? htmlspecialchars($usuario->username) : ''; ?>" />
                            <label class="required" for="username">Nombre de Usuario:</label>
                        </div>
                    </div>
                    <!-- Contraseña -->
                    <div class="row">
                        <div class="input-field col s12">   
                            <input type="password" id="password" name="password" <?php echo $is_editing ? '' : 'required'; ?> />
                            <label class="required" for="password">Contraseña<?php echo $is_editing ? ' (Dejar vacío para no cambiar)' : ' *'; ?>:</label>
                        </div>
                    </div>
                    <!-- Departamento -->
                    <div class="row">
                        <div class="input-field col s12">
                            <select id="rol" name="rol" required>
                                <option value="" disabled selected>Seleccionar Rol</option>
                                <?php
                                $current_rol = $is_editing ? $usuario->rol : ''; 
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
                            <?php if (empty($allowedRoles)): ?>
                                <p style="color: red;">
                                    ¡Advertencia! No hay Rol de Usuario. 
                                    <a href="<?=BASE_URL?>departamentos/crear">Cree uno primero</a>.
                                </p>
                            <?php endif; ?>
                            <label class="required" for="rol">Rol de Usuario:</label>
                        </div>
                    </div>


                <!-- Botones -->
                <div class="row btn-actions">
                    <div class="col l12">
                        <button type="submit" name="action" class="btn waves-effect waves-light btn-first">
                            <?php echo $is_editing ? 'Actualizar' : 'Crear'; ?> Usuario
                        </button>
                        <a href="<?=BASE_URL?>usuarios" class="btn grey" title="Regresar">Regresar</a>
                    </div>
                </div>
            </form>
        </div> <!-- card-panel -->
    </div> <!-- conten-body -->
</article>
