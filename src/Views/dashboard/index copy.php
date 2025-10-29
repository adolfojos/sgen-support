<h2><?= htmlspecialchars($titulo) ?></h2>
<p>
    Bienvenido, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>.  
    Este es el resumen del sistema.
</p>

<style>
    .stat-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }
    .stat-card {
        flex-basis: 200px;
        flex-grow: 1;
        padding: 25px;
        border-radius: 8px;
        color: white;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s ease-in-out;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .stat-card .number {
        font-size: 2.5em;
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }
    .stat-card .label {
        font-size: 1.1em;
    }
    /* Colores */
    .card-red    { background-color: #dc3545; } /* Pendientes */
    .card-orange { background-color: #fd7e14; } /* En Proceso */
    .card-green  { background-color: #28a745; } /* Resueltos Hoy */
    .card-blue   { background-color: #007bff; } /* Totales */
</style>

<!-- Tarjetas de estadísticas -->
<div class="stat-container">
    <a href="/sgen-support/public/soportes" class="stat-card card-red" style="text-decoration:none;">
        <span class="number"><?= $stats->total_pendientes ?></span>
        <span class="label">Tickets Pendientes</span>
    </a>

    <a href="/sgen-support/public/soportes" class="stat-card card-orange" style="text-decoration:none;">
        <span class="number"><?= $stats->total_en_proceso ?></span>
        <span class="label">Tickets En Proceso</span>
    </a>

    <div class="stat-card card-green">
        <span class="number"><?= $stats->resueltos_hoy ?></span>
        <span class="label">Resueltos Hoy</span>
    </div>

    <div class="stat-card card-blue">
        <span class="number"><?= $stats->total_tickets ?></span>
        <span class="label">Tickets Totales en sistema</span>
    </div>
</div>

<!-- Últimos tickets pendientes -->
<div class="mt-5">
    <h3>Últimos Tickets Pendientes</h3>
    <?php if (!empty($ultimos_tickets)): ?>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Equipo</th>
                    <th>Departamento</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ultimos_tickets as $ticket): ?>
                    <tr>
                        <td><?= $ticket->id ?></td>
                        <td><?= htmlspecialchars($ticket->descripcion) ?></td>
                        <td><?= htmlspecialchars($ticket->equipo_tipo . ' - ' . $ticket->equipo_serial) ?></td>
                        <td><?= htmlspecialchars($ticket->departamento_nombre) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($ticket->fecha)) ?></td>
                        <td>
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
