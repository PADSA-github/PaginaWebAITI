<?php
header('Content-Type: text/plain; charset=utf-8');
ini_set('display_errors', '1');
error_reporting(E_ALL);

echo "====================================================\n";
echo "AI-TI - ANÁLISIS DE CONFIGURACIÓN DE CORREO LOCAL\n";
echo "====================================================\n\n";

// 1. Configuración de correo en php.ini
echo "1. CONFIGURACIÓN PHP.INI DE CORREO:\n";
echo "   - sendmail_path: " . ini_get('sendmail_path') . "\n";
echo "   - SMTP: " . ini_get('SMTP') . "\n";
echo "   - smtp_port: " . ini_get('smtp_port') . "\n";
echo "   - sendmail_from: " . ini_get('sendmail_from') . "\n";
echo "   - Hostname del servidor: " . gethostname() . "\n";
echo "   - IP del servidor web: " . ($_SERVER['SERVER_ADDR'] ?? gethostbyname(gethostname())) . "\n";
echo "   - Gateway / Gateway DNS: " . gethostbyname('gateway') . "\n\n";

// 2. Probar puertos en la IP local del servidor y subred Carrierzone
$server_ip = $_SERVER['SERVER_ADDR'] ?? gethostbyname(gethostname());
echo "2. CONECTIVIDAD A LA IP LOCAL DEL SERVIDOR ($server_ip):\n";
$local_targets = [
    [$server_ip, 25],
    [$server_ip, 587],
    [$server_ip, 465],
    ['mail', 25],
    ['mail', 587],
    ['smtp', 25],
    ['smtp', 587],
    ['relay', 25],
    ['relay.carrierzone.com', 25]
];

foreach ($local_targets as $lt) {
    list($h, $p) = $lt;
    $errno = 0; $errstr = '';
    $t0 = microtime(true);
    $fp = @fsockopen($h, $p, $errno, $errstr, 1.5);
    $ms = round((microtime(true) - $t0) * 1000, 1);
    if ($fp) {
        $banner = trim(fgets($fp, 256));
        echo "   [ABIERTO] $h:$p ({$ms}ms) -> $banner\n";
        fclose($fp);
    } else {
        echo "   [CERRADO] $h:$p ({$ms}ms) -> $errstr ($errno)\n";
    }
}
echo "\n";

// 3. Probar envío con mail() nativo configurando envelope-from (-f reclutamiento@ai-ti.com.mx)
echo "3. PRUEBA DE ENVÍO CON mail() NATIVO + ENVELOPE-FROM (-f):\n";
$to = 'reclutamiento@ai-ti.com.mx';
$subject = 'Prueba mail() nativo con envelope-from ' . date('H:i:s');
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: AI-TI Reclutamiento <reclutamiento@ai-ti.com.mx>\r\n";
$headers .= "Reply-To: reclutamiento@ai-ti.com.mx\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

$body = "<h2>Prueba de Correo Nativo con Envelope-From</h2><p>Fecha: " . date('d/m/Y H:i:s') . "</p><p>Enviado con bandera -f reclutamiento@ai-ti.com.mx</p>";

$res_mail1 = @mail($to, $subject, $body, $headers, "-f reclutamiento@ai-ti.com.mx");
echo "   - Resultado mail() con parámetro -f: " . ($res_mail1 ? "TRUE (Aceptado por el sistema)" : "FALSE (Rechazado)") . "\n";

// 4. Probar si cURL a servicios HTTPS externos funciona (¿el puerto 443 saliente está abierto?)
echo "\n4. CONECTIVIDAD SALIENTE HTTPS (PUERTO 443):\n";
$ch = curl_init('https://api.github.com');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);
curl_setopt($ch, CURLOPT_USERAGENT, 'AI-TI Test');
$curl_res = curl_exec($ch);
$curl_err = curl_error($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if ($curl_err) {
    echo "   - Conexión HTTPS saliente: BLOQUEADA ($curl_err)\n";
} else {
    echo "   - Conexión HTTPS saliente: HABILITADA (HTTP $http_code) [OK]\n";
}

echo "\n=== FIN DEL ANÁLISIS ===\n";
