<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ticket</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        .section { margin-bottom: 20px; }
        .signature { margin-top: 50px; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #000; padding: 6px; }
    </style>
</head>
<body>
    <h2>Ticket de soporte ID:<?= htmlspecialchars($soporte->id) ?></h2>

    <div class="section">
        <strong>Fecha:</strong> <?= htmlspecialchars($soporte->id) ?><br>
        <strong>Total de bolsas:</strong><br>
    </div>

    <div class="section">
        <strong>Inspector responsable:</strong> <br>
        <strong>Vocero parroquial:</strong> <br>
    </div>

    <div class="section">
        <strong>Observaciones:</strong><br>
        <p></p>
    </div>
</body>
</html>
