<div class="inner-main">

    <!-- Menú lateral izquierdo -->
    <aside id="left-side-menu">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a href="admin/managers" class="waves-effect waves-grey">
                    <i class="people"></i> Menu principal
                </a>
            </li>
            <li>
                <a href="People/" class="waves-effect waves-grey">
                    <i class="ico-proteccion_social1"></i> Menu
                </a>
            </li>
        </ul>
    </aside>

    <!-- Contenido principal -->
    <article>
        <div class="conten-body">

            <!-- Panel de KPIs -->
            <div class="col s12 m12 l12">
                <div class="card-panel">
                    <div class="card-title">
                        <div class="row">
                            <div class="header-title-left col s12 m6">
                                <h5><?= htmlspecialchars($titulo) ?></h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-content bodytext">
                        <div class="row">
                            <?php
                            $kpis = [
                                ['color' => 'red lighten-1', 'icon' => 'ico-por_pagar', 'value' => $stats->total_pendientes, 'label' => 'Tickets Pendientes'],
                                ['color' => 'orange lighten-1', 'icon' => 'ico-por_pagar_2', 'value' => $stats->total_en_proceso, 'label' => 'Tickets En Proceso'],
                                ['color' => 'green lighten-1', 'icon' => 'ico-pago_facturas', 'value' => $stats->resueltos_hoy, 'label' => 'Resueltos Hoy'],
                                ['color' => 'blue darken-1', 'icon' => 'ico-nomina', 'value' => $stats->total_tickets, 'label' => 'Total Tickets en sistema'],
                            ];
                            foreach ($kpis as $kpi): ?>
                                <div class="col s12 m6 l3">
                                    <div class="card-panel <?= $kpi['color'] ?> white-text center-align kpi-card-main">
                                        <i class="<?= $kpi['icon'] ?>"></i>
                                        <h5><?= $kpi['value'] ?></h5>
                                        <p><?= $kpi['label'] ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Botón de acción -->
                        <div class="row btn-actions">
                            <div class="col s12">
                                <a class="btn btn-large green darken-1">
                                    <i class="material-icons left">add</i> Abrir Ticket
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de últimos tickets pendientes -->
            <div class="col s12 m12 l12">
                <div class="card-panel">
                    <div class="card-title">
                        <div class="row">
                            <div class="header-title-left col s12 m6">
                                <h5>Últimos Tickets Pendientes</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row row-end">
                        <div class="col s12">
                            <div class="text-info">
                                <div class="text-content">
                                    Estos son los últimos tickets pendientes registrados en el sistema.
                                </div>
                            </div>

                            <?php if (!empty($ultimos_tickets)): ?>
                                <table id="table" class="bordered highlight table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="hide-on-small-only">ID</th>
                                            <th>Equipo</th>
                                            <th>Departamento</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ultimos_tickets as $ticket): ?>
                                            <tr class="row_table">
                                                <td class="hide-on-small-only"><?= $ticket->id ?></td>
                                                <td><?= htmlspecialchars($ticket->equipo_tipo . ' - ' . $ticket->equipo_serial) ?></td>
                                                <td><?= htmlspecialchars($ticket->departamento_nombre) ?></td>
                                                <td><?= date('d/m/Y H:i', strtotime($ticket->fecha)) ?></td>
                                                <td class="adjusted-size">
                                                    <a href="/sgen-support/public/soportes/ver/<?= $ticket->id ?>" class="btn btn-sm btn-primary">Ver</a>
                                                    <?php if ($ticket->estado === 'pendiente'): ?>
                                                        <a href="/sgen-support/public/soportes/asignar/<?= $ticket->id ?>" class="btn btn-sm btn-warning">Asignar</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-muted">No hay tickets pendientes recientes.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Últimos Tickets En Proceso -->
            <div class="col s12 m12 l12">
                <div class="card-panel">
                    <div class="card-title">
                        <div class="row">
                            <div class="header-title-left col s12 m6">
                                <h5>Últimos Tickets En Proceso</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row row-end">
                        <div class="col s12">
                            <div class="text-info">
                    <div class="text-content">
                        Estos son los tickets actualmente en proceso registrados en el sistema.
                    </div>
                </div>

                <?php if (!empty($ultimos_tickets_proceso)): ?>
                    <table class="bordered highlight table-responsive">
                        <thead>
                            <tr>
                                <th class="hide-on-small-only">ID</th>
                                <th>Equipo</th>
                                <th>Departamento</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php foreach ($ultimos_tickets_proceso as $ticket): ?>
                                <tr class="row_table">
                                    <td class="hide-on-small-only"><?= $ticket->id ?></td>
                                    <td><?= htmlspecialchars($ticket->equipo_tipo . ' - ' . $ticket->equipo_serial) ?></td>
                                    <td><?= htmlspecialchars($ticket->departamento_nombre) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($ticket->fecha)) ?></td>
                                    <td class="adjusted-size">
                                        <a href="/sgen-support/public/soportes/ver/<?= $ticket->id ?>" class="btn btn-sm btn-primary">Ver</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted">No hay tickets en proceso.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

            
        </div>
    </article>

    <!-- Menú lateral derecho -->
    <aside id="right-side-menu">
        <ul class="links"></ul>
        <div id="main-notifications">
            <div class="card-content">
                <?php
                $notificaciones = ['orange', 'green', 'blue'];
                foreach ($notificaciones as $color): ?>
                    <div class="notification <?= $color ?>-notification card-panel">
                        <div class="notification-title">Notification Title</div>
                        <div class="notification-content">Notification Content</div>
                        <div class="notification-actions">
                            <a class="btn btn-first" href="#">Notification Actions</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </aside>

</div>
<div class="clearfix"></div>
