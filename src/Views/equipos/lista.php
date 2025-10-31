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
                            <a class="btn" href="<?=BASE_URL?>equipos/crear" title="Registrar nuevo equipo">+ Registrar Nuevo Equipo</a>
                        </div>
                    </div>
                </div>

                <!-- Tabla de equipos -->
                <div class="row row-end">
                    <div class="col s12">
                        <table id="equipos" class="bordered highlight table-responsive">
                            <thead>
                                <tr>
                                    <th data-priority="0" class="hide-on-small-only">ID</th>
                                    <th data-priority="1">Serial</th>
                                    <th data-priority="2" class="hide-on-small-only">Tipo</th>
                                    <th data-priority="3" class="hide-on-small-only">Departamento</th>
                                    <th data-priority="4" class="hide-on-small-only">Modelo</th>
                                    <th data-priority="5" class="no-sort">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($equipos)): ?>
                                    <tr class="odd">
                                        <td colspan="6" class="dataTables_empty">Ningún dato disponible en esta tabla</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($equipos as $e): ?>
                                        <tr id="<?php echo $e->id; ?>" class="row_table">
                                            <td class="hide-on-small-only nowrap"><?php echo $e->id; ?></td>
                                            <td class="uppercase"><?php echo htmlspecialchars($e->serial); ?></td>
                                            <td class="hide-on-small-only"><?php echo htmlspecialchars($e->tipo); ?></td>
                                            <td class="hide-on-small-only"><?php echo htmlspecialchars($e->departamento_nombre ?? 'N/A'); ?></td>
                                            <td class="hide-on-small-only">
                                                <?php echo htmlspecialchars(substr($e->modelo, 0, 50)) . (strlen($e->modelo) > 50 ? '...' : ''); ?>
                                            </td>
                                            <td class="adjusted-size">
                                                <a title="Editar" href="<?=BASE_URL?>equipos/editar/<?php echo $e->id; ?>"><i class="ico-edit tiny"></i></a>
                                                <a title="Eliminar" href="<?=BASE_URL?>equipos/eliminar/<?php echo $e->id; ?>" onclick="return confirm('¿Está seguro de eliminar el equipo con serial: <?php echo $e->serial; ?>?')"><i class="ico-delete tiny"></i></a>
                                            </td>
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
