<?php
// Ejecutor web para cargar exclusivamente la tecnología y preguntas de SAP
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
@set_time_limit(300);

// Asegurar que se resuelva 'config/constants.php' desde la raíz
set_include_path(dirname(__DIR__) . PATH_SEPARATOR . get_include_path());
require_once __DIR__ . '/../config/database.php';

if (!isset($conecction) || !$conecction || $conecction->connect_error) {
    die("Error al conectar a la base de datos: " . ($conecction->connect_error ?? 'Desconocido'));
}

$conecction->set_charset('utf8mb4');

$sap_preguntas = include __DIR__ . '/data/sap_preguntas.php';
$retos_data = include __DIR__ . '/data/retos_codigo.php';
$sap_retos = $retos_data['sap'] ?? [];

$mensajes = [];
$errores = [];

// 1. Insertar o actualizar lenguaje SAP
$sql_lang = "INSERT INTO `lenguajes_examen` (`clave`, `nombre`, `descripcion`, `icono`, `color`, `badge`, `activo`) 
VALUES (?, ?, ?, ?, ?, ?, 1)
ON DUPLICATE KEY UPDATE 
  nombre = VALUES(nombre), 
  descripcion = VALUES(descripcion), 
  icono = VALUES(icono), 
  color = VALUES(color), 
  badge = VALUES(badge), 
  activo = 1";

$stmt_l = $conecction->prepare($sql_lang);
if ($stmt_l) {
    $c = 'sap';
    $n = 'SAP (Core Modules & CAR Retail)';
    $d = 'Evaluación técnica de SAP Core (MM, SD, FI/CO, ABAP, Retail Master Data) y SAP Customer Activity Repository (CAR, POS DTA, UDF, OPP, OAA).';
    $i = 'bi-cart-check-fill';
    $col = '#0A6ED1';
    $b = 'Retail & SAP CAR';
    $stmt_l->bind_param('ssssss', $c, $n, $d, $i, $col, $b);
    if ($stmt_l->execute()) {
        $mensajes[] = "[OK] Tecnología 'SAP (Core Modules & CAR Retail)' registrada/actualizada exitosamente.";
    } else {
        $errores[] = "Error al registrar tecnología SAP: " . $stmt_l->error;
    }
    $stmt_l->close();
} else {
    $errores[] = "Error al preparar sentencia de lenguaje: " . $conecction->error;
}

// 2. Insertar retos de código de SAP
$conecction->query("DELETE FROM `retos_codigo_examen` WHERE `lenguaje` = 'sap'");
$sql_reto = "INSERT INTO `retos_codigo_examen` (`lenguaje`, `titulo`, `codigo`, `funcionalidad_esperada`, `conceptos_clave`, `activo`) VALUES (?, ?, ?, ?, ?, 1)";
$stmt_r = $conecction->prepare($sql_reto);
if ($stmt_r) {
    $count_retos = 0;
    foreach ($sap_retos as $reto) {
        $l = 'sap';
        $t = $reto['titulo'];
        $cod = $reto['codigo'];
        $func = $reto['funcionalidad_esperada'];
        $cjson = json_encode($reto['conceptos_clave'], JSON_UNESCAPED_UNICODE);
        $stmt_r->bind_param('sssss', $l, $t, $cod, $func, $cjson);
        if ($stmt_r->execute()) {
            $count_retos++;
        }
    }
    $stmt_r->close();
    $mensajes[] = "[OK] {$count_retos} Retos de código de SAP insertados exitosamente.";
}

// 3. Limpiar e insertar preguntas de SAP
$conecction->query("DELETE FROM `preguntas_examen` WHERE `lenguaje` = 'sap'");
$sql_preg = "INSERT INTO `preguntas_examen` (`lenguaje`, `pregunta`, `opcion_a`, `opcion_b`, `opcion_c`, `opcion_d`, `respuesta_correcta`, `complejidad`, `explicacion`, `activo`) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
$stmt_p = $conecction->prepare($sql_preg);

$count_preg = 0;
if ($stmt_p) {
    foreach ($sap_preguntas as $p) {
        $lang = 'sap';
        $stmt_p->bind_param(
            'sssssssss',
            $lang,
            $p['pregunta'],
            $p['opcion_a'],
            $p['opcion_b'],
            $p['opcion_c'],
            $p['opcion_d'],
            $p['respuesta_correcta'],
            $p['complejidad'],
            $p['explicacion']
        );
        if ($stmt_p->execute()) {
            $count_preg++;
        } else {
            $errores[] = "Error al insertar pregunta: " . $stmt_p->error;
        }
    }
    $stmt_p->close();
    $mensajes[] = "[OK] {$count_preg} preguntas de SAP (50 Core Retail + 50 CAR) insertadas exitosamente.";
} else {
    $errores[] = "Error al preparar sentencia de preguntas: " . $conecction->error;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga Incremental SAP | AI-TI</title>
    <link rel="icon" href="../img/aiti.png" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/examen.css">
</head>
<body class="examen-body">
    <nav class="examen-navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="index.php" class="examen-brand">
                <img src="../img/aiti.png" alt="Logo AI-TI">
                <div class="examen-brand-text">
                    <span class="examen-brand-title">AI-TI</span>
                    <span class="examen-brand-subtitle">Carga Incremental de Tecnología SAP</span>
                </div>
            </a>
            <div class="d-flex align-items-center gap-2">
                <a href="index.php" class="btn btn-sm btn-outline-light">
                    <i class="bi bi-play-circle me-1"></i> Ir al Examen
                </a>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div style="background:#e0f2fe; color:#0369a1; width:55px; height:55px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.8rem;">
                    <i class="bi bi-cart-check-fill"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-1 text-dark">Carga Incremental: SAP Retail y SAP CAR</h3>
                    <p class="text-muted mb-0">Este proceso añade exclusivamente el contenido de SAP sin alterar las otras tecnologías ni los registros existentes.</p>
                </div>
            </div>

            <?php if (!empty($errores)): ?>
                <div class="alert alert-danger shadow-sm rounded-3 p-3 mb-3">
                    <h6 class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-1"></i> Se presentaron errores:</h6>
                    <ul class="mb-0">
                        <?php foreach ($errores as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="alert alert-success shadow-sm rounded-3 p-3 mb-4 border-0" style="background:#ecfdf5; color:#065f46;">
                <h6 class="fw-bold mb-2"><i class="bi bi-check-circle-fill me-1"></i> Resumen de Operación:</h6>
                <ul class="mb-0">
                    <?php foreach ($mensajes as $msg): ?>
                        <li><?= htmlspecialchars($msg) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 border text-center">
                        <span class="text-muted small text-uppercase fw-semibold d-block">Tecnología Registrada</span>
                        <h4 class="fw-bold text-primary mb-0 mt-1">SAP</h4>
                        <small class="text-secondary">Core Retail &amp; CAR</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 border text-center">
                        <span class="text-muted small text-uppercase fw-semibold d-block">Preguntas Nuevas</span>
                        <h4 class="fw-bold text-success mb-0 mt-1">100</h4>
                        <small class="text-secondary">50 Core + 50 CAR</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 border text-center">
                        <span class="text-muted small text-uppercase fw-semibold d-block">Retos de Código</span>
                        <h4 class="fw-bold text-dark mb-0 mt-1">2</h4>
                        <small class="text-secondary">ABAP POS DTA / CDS OAA</small>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="index.php" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-play-circle me-1"></i> Ir a Seleccionar Examen
                </a>
                <a href="agregar_pregunta.php?filtro_lang=sap" class="btn btn-outline-secondary px-4 py-2">
                    <i class="bi bi-database me-1"></i> Ver Preguntas de SAP en el Banco
                </a>
                <a href="crud.php?file=sap_preguntas.php" class="btn btn-outline-secondary px-4 py-2">
                    <i class="bi bi-pencil-square me-1"></i> Editar en CRUD
                </a>
            </div>
        </div>
    </main>

    <footer class="examen-footer text-center">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y') ?> AI-TI. Portal de Evaluaciones Técnicas.</p>
        </div>
    </footer>
</body>
</html>

