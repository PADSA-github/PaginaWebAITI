<?php
// Endpoint para envío de reporte de resultados por correo electrónico (18 pts opción + 2 pts código = 20 pts)
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
    exit;
}

$destinatario = filter_var($_POST['destinatario_email'] ?? '', FILTER_SANITIZE_EMAIL);
$nombre = filter_var($_POST['nombre_candidato'] ?? 'Aspirante', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lenguaje = filter_var($_POST['lenguaje_nombre'] ?? 'Tecnología', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$porcentaje = filter_var($_POST['porcentaje'] ?? '0', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$puntos_totales = filter_var($_POST['puntos_totales'] ?? '0', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$aciertos_opcion = filter_var($_POST['aciertos_opcion'] ?? '0', FILTER_SANITIZE_NUMBER_INT);
$puntos_reto = filter_var($_POST['puntos_reto'] ?? '0', FILTER_SANITIZE_NUMBER_INT);
$nivel = filter_var($_POST['nivel'] ?? 'Por Definir', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$desglose_jr = filter_var($_POST['desglose_jr'] ?? '0/6', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$desglose_mid = filter_var($_POST['desglose_mid'] ?? '0/6', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$desglose_sr = filter_var($_POST['desglose_sr'] ?? '0/6', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!filter_var($destinatario, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'La dirección de correo ingresada no es válida.']);
    exit;
}

$fecha = date('d/m/Y H:i:s');

// Generar plantilla HTML estilizada y homogénea con AI-TI
$mensaje_html = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f7fb; margin: 0; padding: 20px; color: #2C3E50; }
        .email-container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 1px solid #e2e8f0; }
        .email-header { background-color: #073E63; padding: 25px 20px; text-align: center; color: #ffffff; }
        .email-header h1 { margin: 0; font-size: 22px; font-weight: bold; }
        .email-header p { margin: 5px 0 0; color: #289CC7; font-size: 13px; text-transform: uppercase; letter-spacing: 1.5px; }
        .email-body { padding: 30px 25px; }
        .candidate-title { font-size: 20px; font-weight: bold; margin-bottom: 4px; color: #073E63; }
        .candidate-meta { font-size: 13px; color: #64748b; margin-bottom: 25px; }
        .score-box { background: #f0f7fb; border: 2px solid #289CC7; border-radius: 10px; padding: 20px; text-align: center; margin-bottom: 25px; }
        .score-val { font-size: 38px; font-weight: 800; color: #073E63; line-height: 1; }
        .rank-badge { display: inline-block; background: #073E63; color: #ffffff; font-size: 14px; font-weight: bold; padding: 6px 18px; border-radius: 20px; margin-top: 10px; }
        .table-breakdown { width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 20px; }
        .table-breakdown th { background: #f8fafc; text-align: left; padding: 10px; font-size: 12px; color: #64748b; border-bottom: 2px solid #e2e8f0; }
        .table-breakdown td { padding: 12px 10px; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        .email-footer { background: #073E63; padding: 18px; text-align: center; font-size: 12px; color: #ffffff; }
        .email-footer a { color: #289CC7; text-decoration: none; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>AI-TI &bull; Evaluaciones Técnicas</h1>
            <p>Reporte Oficial de Diagnóstico</p>
        </div>
        <div class="email-body">
            <div class="candidate-title">{$nombre}</div>
            <div class="candidate-meta">Tecnología: <strong>{$lenguaje}</strong> &bull; Fecha: {$fecha}</div>

            <div class="score-box">
                <div class="score-val">{$puntos_totales} / 20 pts</div>
                <div style="font-size:13px; color:#64748b; margin-top:6px;">
                    {$aciertos_opcion}/18 pts en Opción Múltiple + {$puntos_reto}/2 pts en Análisis de Código ({$porcentaje}% efectividad)
                </div>
                <div><span class="rank-badge">Nivel Asignado: {$nivel}</span></div>
            </div>

            <h3 style="font-size:15px; margin-bottom:10px; color:#073E63;">Desglose de Preguntas de Opción Múltiple (18 Puntos):</h3>
            <table class="table-breakdown">
                <thead>
                    <tr>
                        <th>Nivel</th>
                        <th>Aciertos</th>
                        <th>Puntaje</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Junior</strong></td>
                        <td>{$desglose_jr}</td>
                        <td>1 pt c/u (6 pts máx)</td>
                    </tr>
                    <tr>
                        <td><strong>Semi-Senior</strong></td>
                        <td>{$desglose_mid}</td>
                        <td>1 pt c/u (6 pts máx)</td>
                    </tr>
                    <tr>
                        <td><strong>Senior</strong></td>
                        <td>{$desglose_sr}</td>
                        <td>1 pt c/u (6 pts máx)</td>
                    </tr>
                    <tr>
                        <td><strong>Reto Práctico de Código</strong></td>
                        <td>{$puntos_reto} / 2 pts</td>
                        <td>Evaluación semántica</td>
                    </tr>
                </tbody>
            </table>

            <p style="font-size: 13px; line-height: 1.5; color: #475569;">
                Este reporte ha sido generado automáticamente por el portal de evaluación técnica de AI-TI como parte del proceso de reclutamiento y certificación de competencias en desarrollo de software.
            </p>
        </div>
        <div class="email-footer">
            &copy; AI-TI (Aplicaciones Integrales en TI) &bull; <a href="http://ai-ti.com.mx/">www.ai-ti.com.mx</a>
        </div>
    </div>
</body>
</html>
HTML;

$asunto = "Resultados de Evaluación Técnica en {$lenguaje} (20 Pts) - {$nombre}";
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: AI-TI Evaluaciones <no-reply@ai-ti.com.mx>\r\n";
$headers .= "Reply-To: soporte@ai-ti.com.mx\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

$enviado = false;
try {
    $enviado = @mail($destinatario, $asunto, $mensaje_html, $headers);
} catch (\Throwable $t) {
    $enviado = false;
}

$log_dir = __DIR__ . '/logs_correos';
if (!is_dir($log_dir)) {
    @mkdir($log_dir, 0777, true);
}
$log_file = $log_dir . '/envio_' . date('Ymd_His') . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $destinatario) . '.html';
@file_put_contents($log_file, $mensaje_html);

echo json_encode([
    'status' => 'success',
    'message' => 'Reporte oficial generado exitosamente para ' . htmlspecialchars($destinatario) . '.',
    'preview_html' => $mensaje_html
]);
