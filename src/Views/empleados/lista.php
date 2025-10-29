<h2><?php echo $titulo; ?></h2>

<p>
    <a href="/sgen-support/public/empleados/crear" style="padding: 10px; background-color: #007bff; color: white; text-decoration: none; display: inline-block; margin-bottom: 20px;">
        + Registrar Nuevo Empleado
    </a>
</p>

<table border="1" width="80%" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Email</th>
            <th>Usuario de Login</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($empleados)): ?>
            <tr>
                <td colspan="5" style="text-align: center;">No hay empleados registrados.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($empleados as $e): ?>
                <tr>
                    <td><?php echo $e->id; ?></td>
                    <td><?php echo htmlspecialchars("{$e->nombre} {$e->apellido}"); ?></td>
                    <td><?php echo htmlspecialchars($e->email); ?></td>
                    <td>
                        <?php echo htmlspecialchars($e->usuario_username ?? 'NO VINCULADO'); ?>
                    </td>
                    <td>
                        <a href="/sgen-support/public/empleados/editar/<?php echo $e->id; ?>">Editar</a> |
                        <a href="/sgen-support/public/empleados/eliminar/<?php echo $e->id; ?>" 
                           onclick="return confirm('¿Está seguro de eliminar a <?php echo $e->nombre; ?>?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>