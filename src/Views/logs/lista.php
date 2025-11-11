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
        <div class="col s12 m12 l12">
            <div class="card-panel">
                <!-- Título y botón -->
                <div class="card-title">
                    <div class="row">
                        <div class="header-title-left col s12 m6">
                            <h5><?php echo $titulo; ?></h5>
                        </div>
                        <div class="btn-action-title col s12 m6 align-right">
                            
                        </div>
                    </div>
                </div>

                <!-- Tabla de empleados -->
                <div class="row row-end">
                    <div class="col s12">
                        <p>Mostrando los últimos 200 registros de inicio y cierre de sesión.</p>
                        <table id="empleados" class="datatable bordered highlight table-responsive">
                                <thead>
                                <tr>
                                    <th data-priority="0">Usuario (Username)</th>
                                    <th data-priority="1" class="hide-on-small-only">Fecha Inicio de Sesión</th>
                                    <th data-priority="2" class="hide-on-small-only">Fecha Fin de Sesión</th>
                                    <th data-priority="3" class="no-sort">Duración</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($logs)): ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center;">No hay registros de auditoría.</td>
                                    </tr>
                                    <?php else: ?>
                                        <?php foreach ($logs as $log): ?>
                                            <tr>
                                            <td class="hide-on-small-only nowrap"><?php echo htmlspecialchars($log->username); ?> (ID: <?php echo $log->usuario_id; ?>)</td>
                                            <td class="uppercase"><?php echo $log->fecha_inicio; ?></td>
                                            <td class="hide-on-small-only">                        <?php 
                        if ($log->fecha_fin):
                            echo $log->fecha_fin;
                        else:
                            echo '<strong style="color: green;">Sesión Activa</strong>';
                        endif;
                        ?></td>
                                            <td class="hide-on-small-only">                        <?php
                        // Cálculo de la duración
                        if ($log->fecha_fin) {
                            try {
                                $inicio = new \DateTime($log->fecha_inicio);
                                $fin = new \DateTime($log->fecha_fin);
                                $intervalo = $inicio->diff($fin);
                                echo $intervalo->format('%h h, %i min, %s seg');
                            } catch (Exception $e) {
                                echo 'Error cálculo';
                            }
                        } else {
                            echo 'N/A';
                        }
                        ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
                    </div>
                </div>
            </div> <!-- card-panel -->
        </div> <!-- col -->
    </div> <!-- conten-body -->
</article>