<?php
/**
 * ============================================================================
 * AI-TI Evaluaciones - Módulo de Envío de Correo SMTP y Sendmail Interno
 * ============================================================================
 * Configurado exclusivamente para el módulo de exámenes técnicos de AI-TI.
 * Compatible con PHP 7.4+ y PHP 8+.
 * Maneja sockets SMTP (587 STARTTLS / 465 SSL) y fallback automático a Sendmail
 * interno con Envelope-Sender (-f reclutamiento@ai-ti.com.mx).
 */

if (!defined('EXAM_SMTP_HOST')) {
    define('EXAM_SMTP_HOST', 'mailc76.carrierzone.com');
}
if (!defined('EXAM_SMTP_PORT')) {
    define('EXAM_SMTP_PORT', 587);
}
if (!defined('EXAM_SMTP_USER')) {
    define('EXAM_SMTP_USER', 'reclutamiento@ai-ti.com.mx');
}
if (!defined('EXAM_SMTP_PASS')) {
    define('EXAM_SMTP_PASS', '*AITIsa2023');
}
if (!defined('EXAM_SMTP_FROM_EMAIL')) {
    define('EXAM_SMTP_FROM_EMAIL', 'reclutamiento@ai-ti.com.mx');
}
if (!defined('EXAM_SMTP_FROM_NAME')) {
    define('EXAM_SMTP_FROM_NAME', 'AI-TI Reclutamiento');
}
if (!defined('EXAM_SMTP_TIMEOUT')) {
    define('EXAM_SMTP_TIMEOUT', 3); // 3 segundos para evitar lentitud si hay firewall
}

class ExamSMTPException extends Exception {}

class ExamSMTPMailer
{
    private $host;
    private $port;
    private $user;
    private $pass;
    private $from_email;
    private $from_name;
    private $timeout;
    private $socket = null;
    private $logs = [];

    public function __construct(
        $host = EXAM_SMTP_HOST,
        $port = EXAM_SMTP_PORT,
        $user = EXAM_SMTP_USER,
        $pass = EXAM_SMTP_PASS,
        $from_email = EXAM_SMTP_FROM_EMAIL,
        $from_name = EXAM_SMTP_FROM_NAME,
        $timeout = EXAM_SMTP_TIMEOUT
    ) {
        $this->host = $host;
        $this->port = (int)$port;
        $this->user = $user;
        $this->pass = $pass;
        $this->from_email = $from_email;
        $this->from_name = $from_name;
        $this->timeout = (int)$timeout;
    }

    public function log($message)
    {
        $this->logs[] = date('Y-m-d H:i:s') . ' - ' . $message;
    }

    public function getLogs()
    {
        return $this->logs;
    }

    private function readResponse()
    {
        $response = '';
        while ($line = fgets($this->socket, 515)) {
            $response .= $line;
            if (strlen($line) >= 4 && substr($line, 3, 1) === ' ') {
                break;
            }
        }
        $this->log('< ' . trim($response));
        return $response;
    }

    private function sendCommand($command, $expected_code = null)
    {
        if (strpos($command, base64_encode($this->pass)) !== false) {
            $this->log('> [AUTH PASSWORD REDACTED]');
        } else {
            $this->log('> ' . $command);
        }

        fputs($this->socket, $command . "\r\n");
        $response = $this->readResponse();

        if ($expected_code !== null) {
            $actual_code = substr($response, 0, 3);
            if ($actual_code != $expected_code) {
                throw new ExamSMTPException(
                    "Error SMTP en comando [$command]: Esperado $expected_code, Recibido: " . trim($response)
                );
            }
        }

        return $response;
    }

    /**
     * Envío a través de un puerto de socket específico
     */
    public function sendToPort($target_port, $to_email, $to_name, $subject, $html_body, $copy_to_recruiter = true)
    {
        $to_email = trim($to_email);
        $to_name = trim($to_name ?: 'Candidato');

        if (!filter_var($to_email, FILTER_VALIDATE_EMAIL)) {
            throw new ExamSMTPException("La dirección de correo del destinatario [$to_email] no es válida.");
        }

        $is_ssl = ((int)$target_port === 465);
        $protocol = $is_ssl ? 'ssl' : 'tcp';
        $uri = "{$protocol}://{$this->host}:{$target_port}";

        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);

        $this->log("Conectando a {$uri} (timeout: {$this->timeout}s)...");
        $errno = 0;
        $errstr = '';
        $this->socket = @stream_socket_client(
            $uri,
            $errno,
            $errstr,
            $this->timeout,
            STREAM_CLIENT_CONNECT,
            $context
        );

        if (!$this->socket) {
            throw new ExamSMTPException("Fallo al conectar con {$uri}: $errstr ($errno)");
        }

        stream_set_timeout($this->socket, $this->timeout);

        try {
            // 1. Banner inicial
            $banner = $this->readResponse();
            if (substr($banner, 0, 3) != '220') {
                throw new ExamSMTPException("Banner inicial inválido: " . trim($banner));
            }

            if ($is_ssl) {
                $this->sendCommand("EHLO ai-ti.com.mx", 250);
            } else {
                $this->sendCommand("EHLO ai-ti.com.mx", 250);
                $this->sendCommand("STARTTLS", 220);

                $crypto_method = STREAM_CRYPTO_METHOD_TLS_CLIENT;
                if (defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')) {
                    $crypto_method |= STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
                }
                if (defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT')) {
                    $crypto_method |= STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT;
                }

                $crypto_ok = @stream_socket_enable_crypto($this->socket, true, $crypto_method);
                if (!$crypto_ok) {
                    throw new ExamSMTPException("Fallo al negociar TLS con el servidor en puerto $target_port.");
                }
                $this->log("Handshake TLS completado con éxito.");
                $this->sendCommand("EHLO ai-ti.com.mx", 250);
            }

            // 2. Autenticación AUTH LOGIN
            $this->sendCommand("AUTH LOGIN", 334);
            $this->sendCommand(base64_encode($this->user), 334);
            $this->sendCommand(base64_encode($this->pass), 235);
            $this->log("Autenticación SMTP exitosa para {$this->user}.");

            // 3. Remitente
            $this->sendCommand("MAIL FROM:<{$this->from_email}>", 250);

            // 4. Destinatario principal
            $this->sendCommand("RCPT TO:<{$to_email}>", 250);

            // 5. Copia oculta (BCC) para reclutamiento
            $enviar_bcc = $copy_to_recruiter && (strtolower($to_email) !== strtolower($this->user));
            if ($enviar_bcc) {
                $this->sendCommand("RCPT TO:<{$this->user}>", 250);
                $this->log("Copia agregada para el equipo de reclutamiento ({$this->user}).");
            }

            // 6. Comando DATA
            $this->sendCommand("DATA", 354);

            // 7. Encabezados MIME Base64
            $encoded_subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
            $encoded_from_name = '=?UTF-8?B?' . base64_encode($this->from_name) . '?=';
            $encoded_to_name = '=?UTF-8?B?' . base64_encode($to_name) . '?=';
            $message_id = '<' . time() . '.' . bin2hex(random_bytes(8)) . '@ai-ti.com.mx>';

            $headers  = "Date: " . date('r') . "\r\n";
            $headers .= "From: {$encoded_from_name} <{$this->from_email}>\r\n";
            $headers .= "To: {$encoded_to_name} <{$to_email}>\r\n";
            $headers .= "Reply-To: {$encoded_from_name} <{$this->from_email}>\r\n";
            $headers .= "Subject: {$encoded_subject}\r\n";
            $headers .= "Message-ID: {$message_id}\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers .= "Content-Transfer-Encoding: base64\r\n";
            $headers .= "X-Mailer: AI-TI Exam SMTP Engine 2.2\r\n";

            $body_chunked = chunk_split(base64_encode($html_body));

            $payload = $headers . "\r\n" . $body_chunked . "\r\n.\r\n";
            fputs($this->socket, $payload);

            $data_resp = $this->readResponse();
            if (substr($data_resp, 0, 3) != '250') {
                throw new ExamSMTPException("El servidor rechazó el mensaje tras DATA: " . trim($data_resp));
            }

            // 8. QUIT
            try {
                $this->sendCommand("QUIT", 221);
            } catch (\Throwable $t) {}

            @fclose($this->socket);
            $this->socket = null;

            return [
                'success' => true,
                'method' => "SMTP (Puerto {$target_port})",
                'message' => "Correo entregado exitosamente a {$to_email} por SMTP (puerto {$target_port}).",
                'recipient' => $to_email,
                'bcc_recruiter' => $enviar_bcc,
                'logs' => $this->logs
            ];

        } catch (\Throwable $e) {
            if ($this->socket && is_resource($this->socket)) {
                @fputs($this->socket, "QUIT\r\n");
                @fclose($this->socket);
                $this->socket = null;
            }
            throw $e;
        }
    }

    /**
     * Envío híbrido:
     * 1. Intenta SMTP por socket (587 y 465).
     * 2. Si el hosting bloquea los puertos salientes (timeout 110),
     *    conmuta al Sendmail interno de Telmex con Envelope Sender (-f).
     */
    public function send($to_email, $to_name, $subject, $html_body, $copy_to_recruiter = true)
    {
        $this->logs = [];
        $ports_to_try = [587, 465];
        $last_exception = null;

        // Paso 1: Intentar sockets SMTP directos
        foreach ($ports_to_try as $port) {
            try {
                $this->log("Probando conexión SMTP por socket en puerto {$port}...");
                return $this->sendToPort($port, $to_email, $to_name, $subject, $html_body, $copy_to_recruiter);
            } catch (\Throwable $e) {
                $this->log("Puerto {$port} no disponible en este entorno: " . $e->getMessage());
                $last_exception = $e;
            }
        }

        // Paso 2: Si los sockets están bloqueados por firewall del hosting, usar Sendmail local con envelope-from
        $this->log("Puertos de socket bloqueados por firewall. Conmutando a Sendmail interno con Envelope Sender (-f)...");

        $encoded_from_name = '=?UTF-8?B?' . base64_encode($this->from_name) . '?=';
        $encoded_to_name = '=?UTF-8?B?' . base64_encode($to_name ?: 'Candidato') . '?=';
        $encoded_subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

        $additional_headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8',
            'Content-Transfer-Encoding: base64',
            "From: {$encoded_from_name} <{$this->from_email}>",
            "Reply-To: {$encoded_from_name} <{$this->from_email}>",
            "Return-Path: <{$this->from_email}>",
            'X-Mailer: AI-TI Exam Engine (Internal Relay)'
        ];

        $enviar_bcc = $copy_to_recruiter && (strtolower($to_email) !== strtolower($this->user));
        if ($enviar_bcc) {
            $additional_headers[] = "Bcc: <{$this->user}>";
            $this->log("Copia BCC agregada para reclutamiento ({$this->user}).");
        }

        $headers_str = implode("\r\n", $additional_headers);
        $envelope_param = "-f " . escapeshellarg($this->from_email);
        $body_base64 = chunk_split(base64_encode($html_body));

        $mail_ok = @mail($to_email, $encoded_subject, $body_base64, $headers_str, $envelope_param);

        if ($mail_ok) {
            $this->log("Mensaje procesado y despachado con éxito por el servicio interno de correo con envelope {$this->from_email}.");
            return [
                'success' => true,
                'method' => 'Sendmail Interno Autorizado (-f ' . $this->from_email . ')',
                'message' => "Correo entregado exitosamente a {$to_email} desde {$this->from_email}.",
                'recipient' => $to_email,
                'bcc_recruiter' => $enviar_bcc,
                'logs' => $this->logs
            ];
        }

        throw new ExamSMTPException(
            "No fue posible entregar el correo por SMTP directo (bloqueo firewall: " . 
            ($last_exception ? $last_exception->getMessage() : '') . ") ni por el servicio local."
        );
    }
}

/**
 * Helper principal para enviar correos de examen
 */
function enviar_correo_examen_smtp($destinatario, $nombre_destinatario, $asunto, $cuerpo_html, $copia_reclutamiento = true)
{
    $mailer = new ExamSMTPMailer();
    $result = [
        'success' => false,
        'message' => '',
        'method' => null,
        'error' => null,
        'logs' => []
    ];

    try {
        $send_result = $mailer->send($destinatario, $nombre_destinatario, $asunto, $cuerpo_html, $copia_reclutamiento);
        $result['success'] = true;
        $result['method'] = $send_result['method'];
        $result['message'] = $send_result['message'];
        $result['logs'] = $send_result['logs'];
    } catch (ExamSMTPException $e) {
        $result['success'] = false;
        $result['error'] = $e->getMessage();
        $result['message'] = $e->getMessage();
        $result['logs'] = $mailer->getLogs();
    } catch (\Throwable $t) {
        $result['success'] = false;
        $result['error'] = $t->getMessage();
        $result['message'] = "Error inesperado: " . $t->getMessage();
        $result['logs'] = $mailer->getLogs();
    }

    return $result;
}
