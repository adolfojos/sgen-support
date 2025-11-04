<h2><?php echo $titulo; ?></h2>
<p>Mostrando los últimos 200 registros de inicio y cierre de sesión.</p>

<table border="1" width="100%" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Log ID</th>
            <th>Usuario (Username)</th>
            <th>Fecha Inicio de Sesión</th>
            <th>Fecha Fin de Sesión</th>
            <th>Duración</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($logs)): ?>
            <tr>
                <td colspan="5" style="text-align: center;">No hay registros de auditoría.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?php echo $log->id; ?></td>
                    <td><?php echo htmlspecialchars($log->username); ?> (ID: <?php echo $log->usuario_id; ?>)</td>
                    <td><?php echo $log->fecha_inicio; ?></td>
                    <td>
                        <?php 
                        if ($log->fecha_fin):
                            echo $log->fecha_fin;
                        else:
                            echo '<strong style="color: green;">Sesión Activa</strong>';
                        endif;
                        ?>
                    </td>
                    <td>
                        <?php
                        // Cálculo de la duración
                        if ($log->fecha_fin) {
                            try {
                                $inicio = new \DateTime($log->fecha_inicio);
                                $fin = new \DateTime($log->fecha_fin);
                                $intervalo = $inicio->diff($fin);
                                echo $intervalo->format('%h h, %i min, %s seg');
                            } catch (Exception $e) {
                                echo 'Error cálculo';
                            }
                        } else {
                            echo 'N/A';
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>