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
                            <a class="btn" href="<?=BASE_URL?>empleados/crear" title="Registrar Nuevo Empleado">+ Registrar Nuevo Empleado</a>
                        </div>
                    </div>
                </div>

                <!-- Tabla de empleados -->
                <div class="row row-end">
                    <div class="col s12">
                        <table id="empleados" class="datatable bordered highlight table-responsive">
                            <thead>
                                <tr>
                                    <th data-priority="0" class="hide-on-small-only">ID</th>
                                    <th data-priority="1">Nombre Completo</th>
                                    <th data-priority="3" class="hide-on-small-only">Email</th>
                                    <th data-priority="4" class="hide-on-small-only">Usuario</th>
                                    <th data-priority="5" class="no-sort">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($empleados)): ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center;">No hay empleados registrados.</td>
                                    </tr>
                                    <?php else: ?>
                                        <?php foreach ($empleados as $e): ?>
                                        <tr id="<?php echo $e->id; ?>" class="row_table">
                                            <td class="hide-on-small-only nowrap"><?php echo $e->id; ?></td>
                                            <td class="uppercase"><?php echo htmlspecialchars("{$e->nombre} {$e->apellido}"); ?></td>
                                            <td class="hide-on-small-only"><?php echo htmlspecialchars($e->email); ?></td>
                                            <td class="hide-on-small-only"><?php echo htmlspecialchars($e->usuario_username ?? 'NO VINCULADO'); ?></td>
                                            <td class="adjusted-size">
                                                <a title="Editar" href="<?=BASE_URL?>empleados/editar/<?php echo $e->id; ?>"><i class="ico-edit tiny"></i></a>
                                                <a title="Eliminar" href="<?=BASE_URL?>empleados/eliminar/<?php echo $e->id; ?>" onclick="return confirm('¿Está seguro de eliminar a: <?php echo $e->nombre; ?>?')"><i class="ico-delete tiny"></i></a>
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