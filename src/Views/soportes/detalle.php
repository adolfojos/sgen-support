
<?php if (isset($soporte)): ?>

    
<!-- Hoja de estilos -->
    <style>
.group-title {
    margin-bottom: 5px;
}

.group-info {
    margin-bottom: 20px;
}

.break-word {
    word-break: break-all;
}

.description p {
    margin-top: 0 !important;
    margin-bottom: 0 !important;
}

    </style>

<article>
    <div class="conten-body">
        <div class="row">
            <div id="info_personal">
                <div class="card-panel">
                    <!-- Título -->
                    <div class="card-title">
                        <div class="row">
                            <div class="header-title-left col s12 m6">
                                <h5><?php echo $titulo; ?></h5>
                            </div>
                        </div>
                    </div>

                    <!-- Contenido principal -->
                    <div class="row">
                        <div class="col s12">
                            <div class="card-content">
                                <div class="bodytext">
                                    <!-- Información general -->
                                    <ul class="group-info">
                                        <li><b>Estado: </b><span class="estado-<?php echo $soporte->estado; ?>"><?php echo ucfirst(str_replace('_', ' ', $soporte->estado)); ?></span></li>
                                        <li><b>Fecha Reporte: </b><?php echo date('d/m/Y H:i', strtotime($soporte->fecha)); ?></li>
                                        <li><b>Fecha Cierre: </b><?php echo $soporte->fecha_cierre ? date('d/m/Y H:i', strtotime($soporte->fecha_cierre)) : 'N/A'; ?></li>
                                        <li><b>Descripción del Problema: </b><?php echo htmlspecialchars($soporte->descripcion); ?></li>
                                    </ul>

                                    <!-- Información del Equipo -->
                                    <ul class="group-info">
                                        <li class="group-title">Información del Equipo</li>
                                        <li><b>Serial: </b><?php echo htmlspecialchars($soporte->equipo_serial ?? 'N/A'); ?></li>
                                        <li><b>Tipo: </b><?php echo htmlspecialchars($soporte->equipo_tipo ?? 'N/A'); ?></li>
                                        <li><b>Modelo: </b><?php echo htmlspecialchars($soporte->equipo_modelo ?? 'N/A'); ?></li>
                                        <li><b>Departamento: </b><?php echo htmlspecialchars($soporte->departamento_nombre ?? 'N/A'); ?></li>
                                    </ul>
                                    
                                    <!-- Acciones del Ticket-->
                                    <ul class="group-info">
                                        <li class="group-title">Acciones del Ticket</li>
                                        <li><b>Técnico Asignado: </b><?php echo htmlspecialchars($soporte->tecnico_asignado ?? 'Sin asignar'); ?>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="row row-end btn-actions">
                        <div class="col s12 m6">
                                            <?php 
                // Lógica de botones condicionales
                $nivel = $_SESSION['rol'] ?? '';
                $puede_gestionar = in_array($nivel, ['admin', 'tecnico']);
                
                // 1. Botón para Asignar
                if ($soporte->estado == 'pendiente' && $puede_gestionar): ?>
                    <a title="Asignar / Tomar Ticket" href="<?=BASE_URL?>soportes/asignar/<?php echo $soporte->id; ?>" class="btn orange ">Asignar / Tomar Ticket</a>
                <?php endif; ?>

                <?php if ($soporte->estado == 'en_proceso' && $puede_gestionar): ?>
                    <a title="Resuelto" href="<?=BASE_URL?>soportes/resolver/<?php echo $soporte->id; ?>" class="btn green"onclick="return confirm('¿Confirma que el ticket #<?php echo $soporte->id; ?> ha sido RESUELTO?')">Marcar como Resuelto</a>
                <?php endif; ?>

                <?php if ($soporte->estado == 'resuelto'): ?>
                    <p style="text-align: center; font-weight: bold; color: green;">Este ticket ya fue resuelto.</p>
                <?php endif; ?>

                        </div>
                        <div class="col s12 m6 link-options">
                            <ul>
                                <li>
                                    <a href="<?=BASE_URL?>soportes" title="Descargar">Volver al Listado</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- card-panel -->
            </div> <!-- info_personal -->
        </div> <!-- row -->
    </div> <!-- conten-body -->
</article>
<?php else: ?>
    <p>El ticket de soporte solicitado no existe.</p>
<?php endif; ?>
