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
                            <a class="btn" href="<?=BASE_URL?>departamentos/crear" title="+ Agregar Nuevo Departamento">+ Agregar Nuevo Departamento</a>
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
                                    <th data-priority="1">Nombre</th>
                                    <th data-priority="2" class="no-sort">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($departamentos)): ?>
                                    <tr class="odd">
                                        <td colspan="2" class="dataTables_empty">Ningún dato disponible en esta tabla</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($departamentos as $d): ?>
                                        <tr id="<?php echo $d->id; ?>" class="row_table">
                                            <td class="hide-on-small-only nowrap"><?php echo $d->id; ?></td>
                                            <td class="uppercase"><?php echo htmlspecialchars($d->nombre); ?></td>
                                            <td class="adjusted-size">
                                                <a title="Editar" href="<?=BASE_URL?>departamentos/editar/<?php echo $d->id; ?>"><i class="ico-edit tiny"></i></a>
                                                <a title="Eliminar" href="<?=BASE_URL?>departamentos/eliminar/<?php echo $d->id; ?>" onclick="return confirm('¿Está seguro de eliminar el departamento: <?php echo $d->name; ?>?')"><i class="ico-delete tiny"></i></a>
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