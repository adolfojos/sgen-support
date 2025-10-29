<h2><?php echo $titulo; ?></h2>

<p>
    <a href="/sgen-support/public/equipos/crear" style="padding: 10px; background-color: #007bff; color: white; text-decoration: none; display: inline-block; margin-bottom: 20px;">
        + Registrar Nuevo Equipo
    </a>
</p>

<table border="1" width="100%" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Serial</th>
            <th>Tipo</th>
            <th>Departamento</th>
            <th>Modelo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($equipos)): ?>
            <tr>
                <td colspan="6" style="text-align: center;">No hay equipos registrados.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($equipos as $e): ?>
                <tr>
                    <td><?php echo $e->id; ?></td>
                    <td><?php echo htmlspecialchars($e->serial); ?></td>
                    <td><?php echo htmlspecialchars($e->tipo); ?></td>
                    <td><?php echo htmlspecialchars($e->departamento_nombre ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars(substr($e->modelo, 0, 50)) . (strlen($e->modelo) > 50 ? '...' : ''); ?></td>
                    <td>
                        <a href="/sgen-support/public/equipos/editar/<?php echo $e->id; ?>">Editar</a> |
                        <a href="/sgen-support/public/equipos/eliminar/<?php echo $e->id; ?>" 
                           onclick="return confirm('¿Está seguro de eliminar el equipo con serial: <?php echo $e->serial; ?>?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>