
<h2><?php echo $titulo; ?></h2>

<?php if (isset($soporte)): ?>

    <style>
        .detalle-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; }
        .info-box { border: 1px solid #ccc; padding: 15px; }
        .info-box h3 { margin-top: 0; }
        .info-box p { margin: 5px 0; }
        .info-box strong { min-width: 120px; display: inline-block; }
        .descripcion { white-space: pre-wrap; background-color: #f9f9f9; padding: 15px; border: 1px solid #eee; }
        .acciones-box { background-color: #f4f4f4; padding: 15px; border: 1px solid #ccc; }
        .btn-accion { display: block; padding: 10px 15px; text-decoration: none; color: white; text-align: center; margin-bottom: 10px; font-weight: bold; }
        .btn-asignar { background-color: #ffc107; color: black; }
        .btn-resolver { background-color: #28a745; }
    </style>

    <div class="detalle-grid">
        <div class="ticket-info">
            <div class="info-box">
                <h3>Detalle del Problema</h3>
                <p><strong>Estado:</strong> <span class="estado-<?php echo $soporte->estado; ?>"><?php echo ucfirst(str_replace('_', ' ', $soporte->estado)); ?></span></p>
                <p><strong>Fecha Reporte:</strong> <?php echo date('d/m/Y H:i', strtotime($soporte->fecha)); ?></p>
                <p><strong>Fecha Cierre:</strong> <?php echo $soporte->fecha_cierre ? date('d/m/Y H:i', strtotime($soporte->fecha_cierre)) : 'N/A'; ?></p>
                <p><strong>Descripción del Problema:</strong></p>
                <div class="descripcion">
                    <?php echo htmlspecialchars($soporte->descripcion); ?>
                </div>
            </div>
            
            <div class="info-box" style="margin-top: 20px;">
                <h3>Información del Equipo</h3>
                <p><strong>Serial:</strong> <?php echo htmlspecialchars($soporte->equipo_serial ?? 'N/A'); ?></p>
                <p><strong>Tipo:</strong> <?php echo htmlspecialchars($soporte->equipo_tipo ?? 'N/A'); ?></p>
                <p><strong>Modelo:</strong> <?php echo htmlspecialchars($soporte->equipo_modelo ?? 'N/A'); ?></p>
                <p><strong>Departamento:</strong> <?php echo htmlspecialchars($soporte->departamento_nombre ?? 'N/A'); ?></p>
            </div>
        </div>
        
        <div class="ticket-acciones">
            <div class="acciones-box">
                <h3>Acciones del Ticket</h3>
                
                <p><strong>Técnico Asignado:</strong><br> <?php echo htmlspecialchars($soporte->tecnico_asignado ?? 'Sin asignar'); ?></p>
                <hr>
<pre>
</pre>
                <?php 
                // Lógica de botones condicionales
                $nivel = $_SESSION['rol'] ?? '';
                $puede_gestionar = in_array($nivel, ['admin', 'tecnico']);
                
                // 1. Botón para Asignar
                if ($soporte->estado == 'pendiente' && $puede_gestionar): ?>
                    <a href="/sgen-support/public/soportes/asignar/<?php echo $soporte->id; ?>" class="btn-accion btn-asignar">
                        Asignar / Tomar Ticket
                    </a>
                <?php endif; ?>

                <?php if ($soporte->estado == 'en_proceso' && $puede_gestionar): ?>
                    <a href="/sgen-support/public/soportes/resolver/<?php echo $soporte->id; ?>"  class="btn-accion btn-resolver" onclick="return confirm('¿Confirma que el ticket #<?php echo $soporte->id; ?> ha sido RESUELTO?')">
                        Marcar como Resuelto
                    </a>
                <?php endif; ?>

                <?php if ($soporte->estado == 'resuelto'): ?>
                    <p style="text-align: center; font-weight: bold; color: green;">Este ticket ya fue resuelto.</p>
                <?php endif; ?>

                <a href="/sgen-support/public/soportes" style="display: block; text-align: center; margin-top: 20px;">Volver al Listado</a>
            </div>
        </div>
    </div>

<?php else: ?>
    <p>El ticket de soporte solicitado no existe.</p>
<?php endif; ?>
