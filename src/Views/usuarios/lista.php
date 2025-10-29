<h2><?php echo $titulo; ?></h2>

<p>
    <a href="/sgen-support/public/usuarios/crear" style="padding: 10px; background-color: #007bff; color: white; text-decoration: none; display: inline-block; margin-bottom: 20px;">
        + Crear Nuevo Usuario
    </a>
</p>

<table border="1" width="70%" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de Usuario</th>
            <th>Nivel acceso</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($usuarios)): ?>
            <tr>
                <td colspan="4" style="text-align: center;">No hay usuarios registrados.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?php echo $u->id; ?></td>
                    <td><?php echo htmlspecialchars($u->username); ?></td>
                    <td><?php echo htmlspecialchars(ucfirst($u->rol)); ?></td>
                    <td>
                    <a href="/sgen-support/public/usuarios/ver/<?php echo $u->id; ?>">Details</a> |    
                    <a href="/sgen-support/public/usuarios/editar/<?php echo $u->id; ?>">Editar</a> |
                        <a href="/sgen-support/public/usuarios/eliminar/<?php echo $u->id; ?>" 
                           onclick="return confirm('¿Está seguro de eliminar el usuario: <?php echo $u->username; ?>?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>