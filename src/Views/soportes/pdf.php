<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ticket</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 12px; 
            margin: 0; 
            padding: 0;
        }
        /* Tabla de encabezado para alinear Logo y Título */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table td {
            vertical-align: middle;
            padding: 0;
            border: none; /* Crucial: no debe tener bordes */
        }
        
        .logo {
            width: 100px; /* Define el ancho de tu logo */
            max-width: 100px;
            height: auto;
        }
        
        .title-cell {
            text-align: center;
        }
        
        h2 { 
            margin: 0;
            font-size: 18px;
        }

        .container {
            padding: 0 20px;
        }
        /* Estilos generales para las secciones de información */
        .info-table {
            width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
            font-size: 13px;
        }
        .info-table th, .info-table td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .info-table th {
            width: 30%;
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        /* Estilos para el estado del ticket */
        .estado-cerrado { color: green; font-weight: bold; }
        .estado-abierto { color: red; font-weight: bold; }
        .estado-en_progreso { color: orange; font-weight: bold; }

        .signature { 
            margin-top: 50px; 
            text-align: center; 
        }
    </style>
</head>
<body>
    <div class="container">

        <table class="header-table">
            <tr>
                <td style="width: 15%;">
                    <img src="[RUTA_A_TU_LOGO]" class="logo" alt="Logo">
                </td>
                <td class="title-cell">
                    <h2>Ticket de soporte ID: <?= htmlspecialchars($soporte->id) ?></h2>
                </td>
            </tr>
        </table>
        <hr style="border: 0; border-top: 1px solid #aaa; margin-bottom: 25px;">

        <h3>Información General del Ticket</h3>
        <table class="info-table">
            <tr>
                <th>Estado</th>
                <td>
                    <span class="estado-<?php echo $soporte->estado; ?>">
                        <?php echo ucfirst(str_replace('_', ' ', $soporte->estado)); ?>
                    </span>
                </td>
            </tr>
            <tr>
                <th>Fecha Reporte</th>
                <td><?php echo date('d/m/Y H:i', strtotime($soporte->fecha)); ?></td>
            </tr>
            <tr>
                <th>Fecha Cierre</th>
                <td><?php echo $soporte->fecha_cierre ? date('d/m/Y H:i', strtotime($soporte->fecha_cierre)) : 'N/A'; ?></td>
            </tr>
            <tr>
                <th>Técnico Asignado</th>
                <td><?php echo htmlspecialchars($soporte->tecnico_asignado ?? 'Sin asignar'); ?></td>
            </tr>
        </table>

        <h3>Descripción del Problema</h3>
        <table class="info-table">
            <tr>
                <th>Descripción</th>
                <td><?php echo nl2br(htmlspecialchars($soporte->descripcion)); ?></td>
            </tr>
        </table>

        <h3>Información del Equipo</h3>
        <table class="info-table">
            <tr>
                <th>Serial</th>
                <td><?php echo htmlspecialchars($soporte->equipo_serial ?? 'N/A'); ?></td>
            </tr>
            <tr>
                <th>Tipo</th>
                <td><?php echo htmlspecialchars($soporte->equipo_tipo ?? 'N/A'); ?></td>
            </tr>
            <tr>
                <th>Modelo</th>
                <td><?php echo htmlspecialchars($soporte->equipo_modelo ?? 'N/A'); ?></td>
            </tr>
            <tr>
                <th>Departamento</th>
                <td><?php echo htmlspecialchars($soporte->departamento_nombre ?? 'N/A'); ?></td>
            </tr>
        </table>

        <div class="signature">
            <p>___________________________________</p>
            <p>Firma del Cliente/Usuario</p>
        </div>

    </div>
</body>
</html>