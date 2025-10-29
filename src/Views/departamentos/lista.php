<h2><?php echo $titulo; ?></h2>

<p>
    <a href="/sgen-support/public/departamentos/crear" style="padding: 10px; background-color: #007bff; color: white; text-decoration: none; display: inline-block; margin-bottom: 20px;">
        + Agregar Nuevo Departamento
    </a>
</p>

<table border="1" width="50%" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($departamentos)): ?>
            <tr>
                <td colspan="3" style="text-align: center;">No hay departamentos registrados.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($departamentos as $d): ?>
                <tr>
                    <td><?php echo $d->id; ?></td>
                    <td><?php echo htmlspecialchars($d->nombre); ?></td>
                    <td>
                        <a href="/sgen-support/public/departamentos/editar/<?php echo $d->id; ?>">Editar</a> |
                        <a href="/sgen-support/public/departamentos/eliminar/<?php echo $d->id; ?>" 
                           onclick="return confirm('¿Está seguro de eliminar este departamento?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>