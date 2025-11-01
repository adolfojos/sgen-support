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
                            <a class="btn" href="<?=BASE_URL?>soportes/crear" title="Crear nuevo ticket de soporte">+ Crear Nuevo Ticket de Soporte</a>
                        </div>
                    </div>
                </div>

                <!-- Tabla de tickets -->
                <div class="row row-end">
                    <div class="col s12">
                        <table id="tickets" class="bordered highlight responsive-table">
                            <thead>
                                <tr>
                                    <th data-priority="0" class="hide-on-small-only">ID</th>
                                    <th data-priority="1" class="hide-on-small-only">Fecha</th>
                                    <th data-priority="2">Estado</th>
                                    <th data-priority="3">Departamento</th>
                                    <th data-priority="4">Técnico</th>
                                    <th data-priority="5">Equipo (Serial)</th>
                                    <th data-priority="7" class="no-Acciones"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($soportes as $soporte): ?>
                                    <tr>
                                        <td class="hide-on-small-only nowrap"><?php echo $soporte->id; ?></td>
                                        <td class="hide-on-small-only"><?php echo date('d/m/y', strtotime($soporte->fecha)); ?></td>
                                        <td>
                                            <span class="estado-<?php echo $soporte->estado; ?>">
                                                <?php echo ucfirst(str_replace('_', ' ', $soporte->estado)); ?>
                                            </span>
                                        </td>
                                        <td class="uppercase"><?php echo htmlspecialchars($soporte->departamento_nombre); ?></td>
                                        <td>
                                            <?php if (empty($soporte->tecnico_asignado) || $soporte->tecnico_asignado === 'Sin asignar'): ?>
                                                <a href="<?=BASE_URL?>soportes/asignar/<?php echo urlencode($soporte->id); ?>">Asignar</a>
                                            <?php else: ?>
                                                <?php echo htmlspecialchars($soporte->tecnico_asignado); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="hide-on-small-only">
                                            <?php echo htmlspecialchars($soporte->equipo_serial); ?> (<?php echo $soporte->equipo_tipo; ?>)
                                        </td>
                                        <td class="adjusted-size">
                                            <a title="Ver" href="<?=BASE_URL?>soportes/ver/<?php echo $soporte->id; ?>"><i class="ico-visibility tiny"></i></a>
                                            <a title="Editar" href="<?=BASE_URL?>soportes/editar/<?php echo $soporte->id; ?>"><i class="ico-edit tiny"></i></a>
                                            <a title="Eliminar" href="<?=BASE_URL?>soportes/eliminar/<?php echo $soporte->id; ?>" onclick="return confirm('¿Está seguro de eliminar el Ticket: <?php echo $soporte->id; ?>?')"><i class="ico-delete tiny"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- card-panel -->
        </div> <!-- col -->
    </div> <!-- conten-body -->
</article>
