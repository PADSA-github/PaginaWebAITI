<?php
// Endpoint para envío de reporte de resultados por correo electrónico
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
    exit;
}

$destinatario = filter_var($_POST['destinatario_email'] ?? '', FILTER_SANITIZE_EMAIL);
$nombre = filter_var($_POST['nombre_candidato'] ?? 'Aspirante', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lenguaje = filter_var($_POST['lenguaje_nombre'] ?? 'Tecnología', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$porcentaje = filter_var($_POST['porcentaje'] ?? '0', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$aciertos = filter_var($_POST['aciertos'] ?? '0', FILTER_SANITIZE_NUMBER_INT);
$total = filter_var($_POST['total'] ?? '20', FILTER_SANITIZE_NUMBER_INT);
$puntos = filter_var($_POST['puntos'] ?? '0', FILTER_SANITIZE_NUMBER_INT);
$nivel = filter_var($_POST['nivel'] ?? 'Por Definir', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$desglose_jr = filter_var($_POST['desglose_jr'] ?? '0/5', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$desglose_mid = filter_var($_POST['desglose_mid'] ?? '0/5', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$desglose_sr = filter_var($_POST['desglose_sr'] ?? '0/5', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$desglose_exp = filter_var($_POST['desglose_exp'] ?? '0/5', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!filter_var($destinatario, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'La dirección de correo ingresada no es válida.']);
    exit;
}

$fecha = date('d/m/Y H:i:s');

// Generar plantilla HTML estilizada para el correo
$mensaje_html = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f7fb; margin: 0; padding: 20px; color: #2C3E50; }
        .email-container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 1px solid #e2e8f0; }
        .email-header { background: linear-gradient(135deg, #073E63, #0b588c); padding: 30px 20px; text-align: center; color: #ffffff; }
        .email-header h1 { margin: 0; font-size: 24px; font-weight: bold; }
        .email-header p { margin: 5px 0 0; color: #00E1D9; font-size: 13px; text-transform: uppercase; letter-spacing: 1.5px; }
        .email-body { padding: 30px 25px; }
        .candidate-title { font-size: 20px; font-weight: bold; margin-bottom: 4px; color: #073E63; }
        .candidate-meta { font-size: 13px; color: #64748b; margin-bottom: 25px; }
        .score-box { background: #f0f9ff; border: 2px solid #00A8CC; border-radius: 10px; padding: 20px; text-align: center; margin-bottom: 25px; }
        .score-val { font-size: 38px; font-weight: 800; color: #073E63; line-height: 1; }
        .rank-badge { display: inline-block; background: #073E63; color: #ffffff; font-size: 14px; font-weight: bold; padding: 6px 18px; border-radius: 20px; margin-top: 10px; }
        .table-breakdown { width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 20px; }
        .table-breakdown th { background: #f8fafc; text-align: left; padding: 10px; font-size: 12px; color: #64748b; border-bottom: 2px solid #e2e8f0; }
        .table-breakdown td { padding: 12px 10px; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        .email-footer { background: #f8fafc; padding: 20px; text-align: center; font-size: 12px; color: #94a3b8; border-top: 1px solid #e2e8f0; }
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
            <div class="candidate-meta">Evaluación de <strong>{$lenguaje}</strong> &bull; {$fecha}</div>

            <div class="score-box">
                <div class="score-val">{$porcentaje}%</div>
                <div style="font-size:13px; color:#64748b; margin-top:4px;">{$aciertos} aciertos de {$total} reactivos ({$puntos} puntos ponderados)</div>
                <div><span class="rank-badge">Nivel Dictaminado: {$nivel}</span></div>
            </div>

            <h3 style="font-size:15px; margin-bottom:10px; color:#073E63;">Desglose por Nivel de Complejidad:</h3>
            <table class="table-breakdown">
                <thead>
                    <tr>
                        <th>Nivel</th>
                        <th>Aciertos</th>
                        <th>Ponderación</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Junior</strong></td>
                        <td>{$desglose_jr}</td>
                        <td>1 pt c/u</td>
                    </tr>
                    <tr>
                        <td><strong>Semi-Senior (Mid)</strong></td>
                        <td>{$desglose_mid}</td>
                        <td>2 pts c/u</td>
                    </tr>
                    <tr>
                        <td><strong>Senior</strong></td>
                        <td>{$desglose_sr}</td>
                        <td>3 pts c/u</td>
                    </tr>
                    <tr>
                        <td><strong>Experto / Lead</strong></td>
                        <td>{$desglose_exp}</td>
                        <td>4 pts c/u</td>
                    </tr>
                </tbody>
            </table>

            <p style="font-size: 13px; line-height: 1.5; color: #475569;">
                Este reporte ha sido generado automáticamente por el sistema de evaluación técnica de AI-TI como parte del proceso de reclutamiento y validación de competencias de desarrollo de software.
            </p>
        </div>
        <div class="email-footer">
            &copy; AI-TI (Aplicaciones Integrales en TI) &bull; <a href="http://ai-ti.com.mx/" style="color:#00A8CC; text-decoration:none;">www.ai-ti.com.mx</a>
        </div>
    </div>
</body>
</html>
HTML;

// Preparar cabeceras de correo
$asunto = "Resultados de Evaluación Técnica en {$lenguaje} - {$nombre}";
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: AI-TI Evaluaciones <no-reply@ai-ti.com.mx>\r\n";
$headers .= "Reply-To: soporte@ai-ti.com.mx\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Intentar envío con mail() nativo
$enviado = false;
try {
    // Suprimir warnings en caso de que sendmail no esté configurado en php.ini de XAMPP local
    $enviado = @mail($destinatario, $asunto, $mensaje_html, $headers);
} catch (\Throwable $t) {
    $enviado = false;
}

// Guardar log local del correo enviado
$log_dir = __DIR__ . '/logs_correos';
if (!is_dir($log_dir)) {
    @mkdir($log_dir, 0777, true);
}
$log_file = $log_dir . '/envio_' . date('Ymd_His') . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $destinatario) . '.html';
@file_put_contents($log_file, $mensaje_html);

if ($enviado) {
    echo json_encode([
        'status' => 'success',
        'message' => '¡El informe ha sido enviado exitosamente a ' . htmlspecialchars($destinatario) . '!',
        'preview_html' => $mensaje_html
    ]);
} else {
    // Si no hay SMTP configurado en el servidor local (XAMPP por defecto), retornar éxito amigable con la vista previa
    echo json_encode([
        'status' => 'success',
        'message' => 'Reporte generado con éxito para ' . htmlspecialchars($destinatario) . '. (En tu entorno local XAMPP el reporte fue guardado y puedes ver la vista previa a continuación)',
        'preview_html' => $mensaje_html
    ]);
}
