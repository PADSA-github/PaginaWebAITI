<?php
// Evaluación del Examen: 18 Preguntas Opción Múltiple (18 pts) + Reto de Código (2 pts) = 20 Puntos
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['preguntas_ids'])) {
    header('Location: index.php');
    exit;
}

$lenguaje_clave = filter_var($_POST['lenguaje'] ?? 'java', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nombre_candidato = filter_var($_POST['nombre_candidato'] ?? 'Aspirante', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email_candidato = filter_var($_POST['email_candidato'] ?? '', FILTER_SANITIZE_EMAIL);
$reto_id = intval($_POST['reto_id'] ?? 0);
$descripcion_codigo = trim($_POST['descripcion_codigo'] ?? '');
$preguntas_ids = array_map('intval', $_POST['preguntas_ids'] ?? []);
$respuestas_usuario = $_POST['respuestas'] ?? [];

// Consultar datos del lenguaje
$stmt_lang = $conecction->prepare("SELECT * FROM lenguajes_examen WHERE clave = ? LIMIT 1");
$stmt_lang->bind_param('s', $lenguaje_clave);
$stmt_lang->execute();
$info_lenguaje = $stmt_lang->get_result()->fetch_assoc();
$stmt_lang->close();

$lang_nombre = $info_lenguaje['nombre'] ?? strtoupper($lenguaje_clave);

// -------------------------------------------------------------
// 1. CALIFICACIÓN DE LAS 18 PREGUNTAS DE OPCIÓN MÚLTIPLE (18 PTS)
// -------------------------------------------------------------
$ids_str = implode(',', $preguntas_ids);
$query_calificar = "SELECT id, pregunta, opcion_a, opcion_b, opcion_c, opcion_d, respuesta_correcta, complejidad, explicacion 
    FROM preguntas_examen 
    WHERE id IN ($ids_str)
    ORDER BY FIELD(id, $ids_str)";
$res_calificar = mysqli_query($conecction, $query_calificar);

$total_preguntas_opcion = 0;
$aciertos_opcion = 0;

$desglose = [
    'Junior'      => ['total' => 0, 'correctas' => 0],
    'Semi-Senior' => ['total' => 0, 'correctas' => 0],
    'Senior'      => ['total' => 0, 'correctas' => 0]
];

$revision_preguntas = [];

while ($row = mysqli_fetch_assoc($res_calificar)) {
    $q_id = $row['id'];
    $comp = $row['complejidad'];
    $resp_correcta = strtoupper(trim($row['respuesta_correcta']));
    $resp_candidato = isset($respuestas_usuario[$q_id]) ? strtoupper(trim($respuestas_usuario[$q_id])) : null;
    
    $es_correcta = ($resp_candidato !== null && $resp_candidato === $resp_correcta);
    
    $total_preguntas_opcion++;
    if (isset($desglose[$comp])) {
        $desglose[$comp]['total']++;
        if ($es_correcta) {
            $desglose[$comp]['correctas']++;
            $aciertos_opcion++;
        }
    }

    $revision_preguntas[] = [
        'id' => $q_id,
        'pregunta' => $row['pregunta'],
        'opcion_a' => $row['opcion_a'],
        'opcion_b' => $row['opcion_b'],
        'opcion_c' => $row['opcion_c'],
        'opcion_d' => $row['opcion_d'],
        'respuesta_correcta' => $resp_correcta,
        'respuesta_candidato' => $resp_candidato,
        'es_correcta' => $es_correcta,
        'complejidad' => $comp,
        'explicacion' => $row['explicacion']
    ];
}

// -------------------------------------------------------------
// 2. EVALUACIÓN INTELIGENTE DEL RETO DE CÓDIGO (MÁXIMO 2 PUNTOS)
// -------------------------------------------------------------
$puntos_reto = 0;
$feedback_reto = '';
$criterios_detectados = [];
$reto_data = null;

if ($reto_id > 0) {
    $stmt_r = $conecction->prepare("SELECT * FROM retos_codigo_examen WHERE id = ? LIMIT 1");
    $stmt_r->bind_param('i', $reto_id);
    $stmt_r->execute();
    $reto_data = $stmt_r->get_result()->fetch_assoc();
    $stmt_r->close();

    if ($reto_data) {
        $criterios = json_decode($reto_data['conceptos_clave'], true);
        $esenciales = $criterios['esenciales'] ?? [];
        $secundarios = $criterios['secundarios'] ?? [];
        $min_esenciales = $criterios['min_esenciales'] ?? 3;

        // Normalizar texto del candidato (quitar acentos, minúsculas)
        $desc_norm = mb_strtolower($descripcion_codigo, 'UTF-8');
        $desc_norm = str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['a', 'e', 'i', 'o', 'u', 'u', 'n'], $desc_norm);

        $encontrados_esenciales = 0;
        $encontrados_secundarios = 0;

        foreach ($esenciales as $palabra) {
            $palabra_norm = str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['a', 'e', 'i', 'o', 'u', 'u', 'n'], mb_strtolower($palabra, 'UTF-8'));
            if (strpos($desc_norm, $palabra_norm) !== false) {
                $encontrados_esenciales++;
                $criterios_detectados[] = $palabra;
            }
        }

        foreach ($secundarios as $palabra) {
            $palabra_norm = str_replace(['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['a', 'e', 'i', 'o', 'u', 'u', 'n'], mb_strtolower($palabra, 'UTF-8'));
            if (strpos($desc_norm, $palabra_norm) !== false) {
                $encontrados_secundarios++;
                if (!in_array($palabra, $criterios_detectados)) {
                    $criterios_detectados[] = $palabra;
                }
            }
        }

        $longitud_valida = (mb_strlen(trim($descripcion_codigo)) >= 35);

        // Calificación semántica:
        // 2 Puntos: Describe la funcionalidad esencial completa (>= min_esenciales y longitud suficiente)
        // 1 Punto: Describe parcialmente la intención (al menos 1 o 2 conceptos)
        // 0 Puntos: No describe la funcionalidad, vacío o sin relación
        if ($encontrados_esenciales >= $min_esenciales && $longitud_valida) {
            $puntos_reto = 2;
            $feedback_reto = "Excelente interpretación. Tu descripción identificó con precisión la funcionalidad, propósito técnico y flujo del código.";
        } elseif (($encontrados_esenciales >= 1 || $encontrados_secundarios >= 2) && mb_strlen(trim($descripcion_codigo)) >= 15) {
            $puntos_reto = 1;
            $feedback_reto = "Comprensión parcial. Identificaste conceptos clave generales, pero faltó profundizar en el resultado final o en los mecanismos internos del código.";
        } else {
            $puntos_reto = 0;
            $feedback_reto = "Descripción insuficiente o incompleta. La explicación proporcionada no corresponde adecuadamente a la funcionalidad del código analizado.";
        }
    }
}

// -------------------------------------------------------------
// 3. CÁLCULO DE PUNTUACIÓN TOTAL (SOBRE 20 PUNTOS)
// -------------------------------------------------------------
$puntos_totales = $aciertos_opcion + $puntos_reto; // Máximo 18 + 2 = 20 puntos
$porcentaje = round(($puntos_totales / 20) * 100, 1);

// Determinación del Nivel Diagnóstico
$nivel_determinado = 'Trainee';
$mensaje_diagnostico = '';

if ($puntos_totales >= 17) {
    $nivel_determinado = 'Programador Senior';
    $mensaje_diagnostico = 'Dominio técnico sobresaliente. Capacidad comprobada para resolver problemas complejos de arquitectura, optimización y análisis de código.';
} elseif ($puntos_totales >= 13) {
    $nivel_determinado = 'Programador Semi-Senior (Mid)';
    $mensaje_diagnostico = 'Buen dominio de las bases de la tecnología, comprensión de flujo de datos y capacidad para trabajar con autonomía en requerimientos de negocio.';
} elseif ($puntos_totales >= 9) {
    $nivel_determinado = 'Programador Junior';
    $mensaje_diagnostico = 'Comprensión de la sintaxis y conceptos fundamentales; apto para incorporarse con supervisión técnica y desarrollo continuo.';
} else {
    $nivel_determinado = 'Nivel Básico / Trainee';
    $mensaje_diagnostico = 'Requiere reforzar las bases teóricas y prácticas de la tecnología para alcanzar el perfil profesional requerido.';
}

$color_score = ($puntos_totales >= 15) ? '#289CC7' : (($puntos_totales >= 10) ? '#073E63' : '#64748B');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Evaluación: <?= htmlspecialchars($nombre_candidato) ?> | AI-TI</title>
    <link rel="icon" href="../img/aiti.png" />
    
    <!-- Bootstrap 5 & Icons -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Estilos Homogéneos -->
    <link rel="stylesheet" href="css/examen.css">
</head>
<body class="examen-body">

    <!-- Barra de Navegación Homogénea al Sitio -->
    <nav class="examen-navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="index.php" class="examen-brand">
                <img src="../img/aiti.png" alt="Logo AI-TI">
                <div class="examen-brand-text">
                    <span class="examen-brand-title">AI-TI</span>
                    <span class="examen-brand-subtitle">Resultados de Evaluación Técnica</span>
                </div>
            </a>
            <a href="index.php" class="btn btn-sm btn-outline-light">
                <i class="bi bi-arrow-left me-1"></i> Nuevo Examen
            </a>
        </div>
    </nav>

    <!-- Contenido de Resultados -->
    <main class="container my-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- Tarjeta Principal de Diagnóstico -->
                <div class="results-card mb-4">
                    <span class="badge px-3 py-2 rounded-pill fw-bold mb-3 border text-primary" style="background-color: #e0f2fe;">
                        <i class="bi bi-patch-check-fill me-1"></i> Evaluación Oficial Concluida
                    </span>

                    <h2 class="fw-bold mb-1 text-dark"><?= htmlspecialchars($nombre_candidato) ?></h2>
                    <p class="text-muted mb-4">
                        Tecnología Evaluada: <strong><?= htmlspecialchars($lang_nombre) ?></strong> &bull; <?= date('d/m/Y H:i') ?>
                    </p>

                    <!-- Gráfico Circular de Calificación Homogéneo -->
                    <div class="score-circle" style="--score-pct: <?= $porcentaje ?>; --score-color: #289CC7;">
                        <span class="score-number"><?= $puntos_totales ?> <small style="font-size:1.1rem; color:#64748B;">/ 20</small></span>
                        <span class="score-total"><?= $porcentaje ?>% Efectividad</span>
                    </div>

                    <!-- Insignia de Nivel Dictaminado -->
                    <div class="badge-rank">
                        <i class="bi bi-trophy-fill me-2" style="color: #289CC7;"></i> Dictamen: <?= $nivel_determinado ?>
                    </div>

                    <p class="lead text-secondary mx-auto mb-4" style="max-width: 680px; font-size: 1.05rem;">
                        <?= $mensaje_diagnostico ?>
                    </p>

                    <!-- Métricas Resumen: 18 pts Opcion Multiple + 2 pts Código = 20 pts -->
                    <div class="row g-3 text-start">
                        <div class="col-sm-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block">Parte 1: Opción Múltiple</span>
                                <h4 class="fw-bold text-dark mb-0"><?= $aciertos_opcion ?> / 18 pts</h4>
                                <small class="text-muted">6 Jr, 6 Mid, 6 Sr</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block">Parte 2: Reto de Código</span>
                                <h4 class="fw-bold text-primary mb-0"><?= $puntos_reto ?> / 2 pts</h4>
                                <small class="text-muted">Análisis funcional</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block">Calificación Total</span>
                                <h4 class="fw-bold text-success mb-0"><?= $puntos_totales ?> / 20 pts</h4>
                                <small class="text-muted"><?= $porcentaje ?>% efectividad</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desglose por Nivel de Preguntas -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-bar-chart-fill text-primary me-2"></i>
                        Desempeño en Preguntas de Opción Múltiple (18 Puntos)
                    </h5>

                    <?php foreach ($desglose as $nivel_nombre => $datos): 
                        $pct_nivel = ($datos['total'] > 0) ? round(($datos['correctas'] / $datos['total']) * 100) : 0;
                    ?>
                        <div class="breakdown-row">
                            <span class="fw-semibold" style="width: 140px; color: var(--aiti-primary);"><?= $nivel_nombre ?></span>
                            <div class="breakdown-progress">
                                <div class="breakdown-fill" style="width: <?= $pct_nivel ?>%;"></div>
                            </div>
                            <span class="fw-bold text-end" style="width: 110px;">
                                <?= $datos['correctas'] ?> / <?= $datos['total'] ?> (<?= $pct_nivel ?>%)
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Tarjeta Detallada de la Evaluación del Reto de Código -->
                <?php if ($reto_data): ?>
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                            <h5 class="fw-bold text-dark mb-0">
                                <i class="bi bi-code-slash text-primary me-2"></i>
                                Evaluación del Reto de Código: <?= htmlspecialchars($reto_data['titulo']) ?>
                            </h5>
                            <span class="badge px-3 py-2 rounded-pill fw-bold <?= ($puntos_reto == 2) ? 'bg-success' : (($puntos_reto == 1) ? 'bg-warning text-dark' : 'bg-danger') ?>">
                                Puntuación: <?= $puntos_reto ?> / 2 Puntos
                            </span>
                        </div>

                        <!-- Código Analizado -->
                        <div class="code-box-container mb-3">
                            <div class="code-box-topbar">
                                <span class="dot dot-red"></span>
                                <span class="dot dot-yellow"></span>
                                <span class="dot dot-green"></span>
                                <span class="ms-2">Código Fuente Presentado</span>
                            </div>
                            <pre class="code-display"><?= htmlspecialchars($reto_data['codigo']) ?></pre>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold text-dark small d-block">Descripción ingresada por el aspirante:</label>
                            <div class="p-3 bg-light rounded-3 border fst-italic text-secondary small">
                                "<?= nl2br(htmlspecialchars($descripcion_codigo ?: '(No se ingresó descripción)')) ?>"
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold text-dark small d-block">Funcionalidad Técnica Esperada:</label>
                            <div class="p-3 rounded-3 border small" style="background-color: #f0fdf4; border-color: #bbf7d0 !important;">
                                <i class="bi bi-check-circle-fill text-success me-1"></i>
                                <?= htmlspecialchars($reto_data['funcionalidad_esperada']) ?>
                            </div>
                        </div>

                        <!-- Veredicto del Evaluador Semántico -->
                        <div class="p-3 rounded-3 border" style="background-color: #f0f7fb; border-color: #bae6fd !important;">
                            <strong class="text-primary d-block mb-1"><i class="bi bi-robot me-1"></i> Dictamen de la Evaluación de Código:</strong>
                            <p class="small text-secondary mb-2"><?= $feedback_reto ?></p>
                            <?php if (!empty($criterios_detectados)): ?>
                                <div class="small text-muted">
                                    <strong>Conceptos técnicos detectados en la respuesta:</strong>
                                    <?php foreach ($criterios_detectados as $crit): ?>
                                        <span class="badge bg-white text-primary border me-1"><?= htmlspecialchars($crit) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Tarjeta de Envío por Correo -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white" id="seccionCorreo">
                    <h5 class="fw-bold text-dark mb-1">
                        <i class="bi bi-envelope-check-fill text-primary me-2"></i>
                        Enviar Reporte Oficial por Correo Electrónico
                    </h5>
                    <p class="text-muted small mb-3">Envía un reporte detallado con la calificación (sobre 20 puntos) y el desglose de competencias.</p>

                    <form id="emailResultsForm">
                        <input type="hidden" name="nombre_candidato" value="<?= htmlspecialchars($nombre_candidato) ?>">
                        <input type="hidden" name="lenguaje_nombre" value="<?= htmlspecialchars($lang_nombre) ?>">
                        <input type="hidden" name="porcentaje" value="<?= $porcentaje ?>">
                        <input type="hidden" name="puntos_totales" value="<?= $puntos_totales ?>">
                        <input type="hidden" name="aciertos_opcion" value="<?= $aciertos_opcion ?>">
                        <input type="hidden" name="puntos_reto" value="<?= $puntos_reto ?>">
                        <input type="hidden" name="nivel" value="<?= htmlspecialchars($nivel_determinado) ?>">
                        <input type="hidden" name="desglose_jr" value="<?= $desglose['Junior']['correctas'] ?>/6">
                        <input type="hidden" name="desglose_mid" value="<?= $desglose['Semi-Senior']['correctas'] ?>/6">
                        <input type="hidden" name="desglose_sr" value="<?= $desglose['Senior']['correctas'] ?>/6">

                        <div class="row g-2 align-items-center">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-at"></i></span>
                                    <input type="email" class="form-control" name="destinatario_email" 
                                           value="<?= htmlspecialchars($email_candidato) ?>" 
                                           placeholder="correo@ejemplo.com" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-aiti w-100" id="btnSendEmail">
                                    <i class="bi bi-send-fill me-2"></i> Enviar Resultados
                                </button>
                            </div>
                        </div>
                        <div id="emailFeedback"></div>
                    </form>
                </div>

                <!-- Revisión Detallada de las 18 Preguntas -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-card-checklist text-primary me-2"></i>
                        Revisión de las 18 Preguntas de Opción Múltiple
                    </h5>

                    <div class="accordion" id="accordionRevision">
                        <?php foreach ($revision_preguntas as $idx => $rev): 
                            $es_correcta = $rev['es_correcta'];
                            $class_border = $es_correcta ? 'border-success' : 'border-danger';
                            $icono_estado = $es_correcta ? '<i class="bi bi-check-circle-fill text-success fs-5"></i>' : '<i class="bi bi-x-circle-fill text-danger fs-5"></i>';
                        ?>
                            <div class="p-3 mb-3 bg-white rounded-3 border <?= $class_border ?>" style="border-left-width: 5px !important;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <?= $icono_estado ?>
                                        <span class="fw-bold text-dark">Reactivo <?= $idx + 1 ?> &bull; Nivel <?= $rev['complejidad'] ?></span>
                                    </div>
                                    <span class="badge <?= $es_correcta ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $es_correcta ? '1 / 1 pt' : '0 / 1 pt' ?>
                                    </span>
                                </div>

                                <p class="fw-semibold text-secondary mb-2"><?= htmlspecialchars($rev['pregunta']) ?></p>

                                <div class="small mb-2">
                                    <strong>Tu respuesta:</strong> 
                                    <span class="<?= $es_correcta ? 'text-success fw-bold' : 'text-danger fw-bold' ?>">
                                        Opción <?= $rev['respuesta_candidato'] ?: 'Sin Responder' ?>
                                    </span>
                                    <?php if (!$es_correcta): ?>
                                        &bull; <strong>Respuesta correcta:</strong> 
                                        <span class="text-success fw-bold">Opción <?= $rev['respuesta_correcta'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($rev['explicacion'])): ?>
                                    <div class="p-2 bg-light rounded text-muted small mt-2 border-start border-3 border-info">
                                        <strong><i class="bi bi-info-circle me-1"></i> Retroalimentación:</strong>
                                        <?= htmlspecialchars($rev['explicacion']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Botones de Acción Finales -->
                <div class="text-center my-4 d-flex justify-content-center gap-3">
                    <a href="index.php" class="btn btn-aiti btn-lg px-4">
                        <i class="bi bi-arrow-repeat me-2"></i> Presentar Otra Evaluación
                    </a>
                    <a href="<?= ROOT_URL ?>" class="btn btn-aiti-outline btn-lg px-4">
                        <i class="bi bi-house me-2"></i> Volver al Portal AI-TI
                    </a>
                </div>

            </div>
        </div>
    </main>

    <!-- Modal de Previsualización de Correo Electrónico -->
    <div class="modal fade" id="emailPreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header text-white" style="background-color: var(--aiti-primary);">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-envelope-paper-fill me-2"></i> Vista Previa del Correo Generado
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light" id="emailPreviewContent">
                    <!-- Contenido HTML inyectado por JS -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Homogéneo -->
    <footer class="examen-footer text-center">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y') ?> AI-TI. Portal de Evaluaciones Técnicas.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="js/examen.js"></script>
</body>
</html>
