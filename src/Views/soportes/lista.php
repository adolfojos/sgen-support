<h2><?php echo $titulo; ?></h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Departamento</th>
            <th>Equipo (Serial)</th>
            <th>Descripción</th>
            <th>Técnico Asignado</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($soportes as $soporte): ?>
            <tr>
                <td><?php echo $soporte->id; ?></td>
                <td><?php echo $soporte->fecha; ?></td>
                
                <td><?php echo htmlspecialchars($soporte->departamento_nombre); ?></td>
                <td><?php echo htmlspecialchars($soporte->equipo_serial); ?> (<?php echo $soporte->equipo_tipo; ?>)</td>
                <td><?php echo htmlspecialchars($soporte->descripcion); ?></td>
                <td><?php if (empty($soporte->tecnico_asignado) || $soporte->tecnico_asignado === 'Sin asignar'): ?>
                    <a href="/sgen-support/public/soportes/asignar/<?php echo urlencode($soporte->id); ?>">Asignar técnico</a>
                    <?php else: ?>
                        <?php echo htmlspecialchars($soporte->tecnico_asignado); ?>
                        <?php endif; ?>
                </td>                
                <td class="estado-<?php echo $soporte->estado; ?>"><?php echo ucfirst(str_replace('_', ' ', $soporte->estado)); ?>
                </td>                
                <td>
                    <a href="/sgen-support/public/soportes/ver/<?php echo $soporte->id; ?>">Ver</a>|
                    <a href="/sgen-support/public/soportes/editar/<?php echo $soporte->id; ?>">Editar</a>|
                    <a href="/sgen-support/public/soportes/eliminar/<?php echo $soporte->id; ?>" onclick="return confirm('¿Está seguro de eliminar el Ticket: <?php echo $soporte->id; ?>?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>