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

<article>
    <div class="conten-body">
        <div class="col s12">
            <div class="card-panel">
                <!-- Título -->
                <div class="card-title">
                    <div class="row">
                        <div class="header-title-left col s12 m6">
                            <h5><?php echo $titulo; ?></h5>
                        </div>
                    </div>
                </div>

                <!-- Texto informativo -->
                <div class="row">
                    <div class="col s12">
                        <div class="text-info">
                            <div class="text-content">
                                Text content
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulario de asignación -->
                <div class="row row-end">
                    <form action="<?=BASE_URL?>soportes/procesar_asignacion" method="POST">
                        <input type="hidden" name="soporte_id" value="<?php echo $soporte->id; ?>">

                        <div class="col s12">
                            <span id="name_member">
                                Ticket: <b>#<?php echo $soporte->id; ?></b>
                            </span> |
                            Estado:
                            <span class="estado-<?php echo $soporte->estado; ?>">
                                <?php echo $soporte->estado; ?>
                            </span>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <select id="empleado_id" name="empleado_id" required>
                                    <option value="" disabled selected>Seleccione un Técnico</option>
                                    <?php 
                                    if (isset($tecnicos) && is_array($tecnicos)):
                                        foreach ($tecnicos as $tecnico): 
                                            $selected = ($_SESSION['user_id'] == $tecnico->usuario_id) ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $tecnico->empleado_id; ?>" <?php echo $selected; ?>>
                                            <?php echo htmlspecialchars($tecnico->username . " (" . $tecnico->nombre . " " . $tecnico->apellido . ")"); ?>
                                        </option>
                                    <?php 
                                        endforeach;
                                    endif;
                                    ?>
                                </select>

                                <?php if (empty($tecnicos)): ?>
                                    <p style="color: red;">¡Advertencia! No hay empleados con rol 'técnico' para asignar.</p>
                                <?php endif; ?>

                                <label class="required" for="empleado_id">Seleccionar Técnico:</label>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row row-end btn-actions">
                            <div class="col l12">
                                <input id="send_member" class="btn btn-first" type="submit" value=" Confirmar Asignación"/>
                                <a href="<?=BASE_URL?>soportes/" class="btn grey" title="Regresar">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div> <!-- row-end -->
            </div> <!-- card-panel -->
        </div> <!-- col s12 -->
    </div> <!-- conten-body -->
</article>
