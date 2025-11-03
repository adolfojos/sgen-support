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
                            <a class="btn" href="<?=BASE_URL?>usuarios/crear" title="Registrar nuevo equipo">+ Crear Nuevo Usuario</a>
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
                                    <th data-priority="1" class="hide-on-small-only">Usuario</th>
                                    <th data-priority="2" class="hide-on-small-only">Nivel acceso</th>
                                    <th data-priority="3" class="no-sort">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($usuarios)): ?>
                                    <tr class="odd">
                                        <td colspan="4" class="dataTables_empty">Ningún dato disponible en esta tabla</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($usuarios as $u): ?>
                                        <tr id="<?php echo $u->id; ?>" class="row_table">
                                            <td class="hide-on-small-only nowrap"><?php echo $u->id; ?></td>
                                            <td class="uppercase"><?php echo htmlspecialchars($u->username); ?></td>
                                            <td class="hide-on-small-only"><?php echo htmlspecialchars(ucfirst($u->rol)); ?></td>
                                            <td class="adjusted-size">
                                                <a title="Editar" href="<?=BASE_URL?>usuarios/editar/<?php echo $u->id; ?>"><i class="ico-edit tiny"></i></a>
                                                <a title="Eliminar" href="<?=BASE_URL?>usuarios/eliminar/<?php echo $u->id; ?>" onclick="return confirm('¿Está seguro de eliminar el usuario <?php echo $u->username; ?>?')"><i class="ico-delete tiny"></i></a>
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


