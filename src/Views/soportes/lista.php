<div class="card-panel">
    <div class="card-title row">
        <div class="col s12 m6">
            <h5><?php echo $titulo; ?></h5>
        </div>
        <div class="col s12 m6 right-align">
        <!-- Botón Abrir Ticket -->
            <a class="btn waves-effect btn-first" title="Abrir Ticket" href="<?=BASE_URL?>soportes/crear">Abrir Ticket</a>
        </div>
    </div>
    <!-- Tabla de tickets -->
    <div class="row">
        <div class="col s12">
        <table id="tickets" class="bordered highlight responsive-table">
            <thead>
                <tr>
                    <th data-priority="0" class="hide-on-small-only">ID</th>
                    <th data-priority="1" class="hide-on-small-only">Fecha</th>
                    <th data-priority="6">Estado</th>
                    <th data-priority="2">Departamento</th>
                    <th data-priority="5">Técnico Asignado</th>
                    <th data-priority="3">Equipo (Serial)</th>
                    <th data-priority="4">Descripción</th>
                    <th data-priority="7" class="no-Acciones"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($soportes as $soporte): ?>
                    <tr>
                        <td class="hide-on-small-only nowrap"><?php echo $soporte->id; ?></td>
                        <td class="hide-on-small-only"><?php echo $soporte->fecha; ?></td>
                        <td><span class="estado-<?php echo $soporte->estado; ?>"><?php echo ucfirst(str_replace('_', ' ', $soporte->estado)); ?></span></td>
                        <td class="uppercase"><?php echo htmlspecialchars($soporte->departamento_nombre); ?></td>
                        <td><?php if (empty($soporte->tecnico_asignado) || $soporte->tecnico_asignado === 'Sin asignar'): ?>
                            <a href="<?=BASE_URL?>soportes/asignar/<?php echo urlencode($soporte->id); ?>">Asignar técnico</a>
                            <?php else: ?>
                                <?php echo htmlspecialchars($soporte->tecnico_asignado); ?>
                            <?php endif; ?>
                        </td>
                        <td class="hide-on-small-only"><?php echo htmlspecialchars($soporte->equipo_serial); ?> (<?php echo $soporte->equipo_tipo; ?>)</td>
                        <td><?php echo htmlspecialchars($soporte->descripcion); ?></td>
                        <td class="adjusted-size">
                            <a title="Show" href="<?=BASE_URL?>soportes/ver/<?php echo $soporte->id; ?>"><i class="ico-visibility tyni"></i></a>
                            <a title="Edit" href="<?=BASE_URL?>soportes/editar/<?php echo $soporte->id; ?>"><i class="ico-edit tyni"></i></a>
                            <a title="Delete" href="<?=BASE_URL?>soportes/eliminar/<?php echo $soporte->id; ?>" onclick="return confirm('¿Está seguro de eliminar el Ticket: <?php echo $soporte->id; ?>?')"><i class="ico-delete tyni"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>