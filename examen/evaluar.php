<?php
// Evaluación del Examen, Cálculo de Nivel y Generación de Resultados
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['preguntas_ids'])) {
    header('Location: index.php');
    exit;
}

$lenguaje_clave = filter_var($_POST['lenguaje'] ?? 'java', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nombre_candidato = filter_var($_POST['nombre_candidato'] ?? 'Aspirante', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email_candidato = filter_var($_POST['email_candidato'] ?? '', FILTER_SANITIZE_EMAIL);
$preguntas_ids = array_map('intval', $_POST['preguntas_ids'] ?? []);
$respuestas_usuario = $_POST['respuestas'] ?? [];

// Consultar datos del lenguaje
$stmt_lang = $conecction->prepare("SELECT * FROM lenguajes_examen WHERE clave = ? LIMIT 1");
$stmt_lang->bind_param('s', $lenguaje_clave);
$stmt_lang->execute();
$info_lenguaje = $stmt_lang->get_result()->fetch_assoc();
$stmt_lang->close();

$lang_nombre = $info_lenguaje['nombre'] ?? strtoupper($lenguaje_clave);

// Consultar las preguntas exactas en la BD para calificar
if (empty($preguntas_ids)) {
    header('Location: index.php');
    exit;
}

$ids_str = implode(',', $preguntas_ids);
$query_calificar = "SELECT id, pregunta, opcion_a, opcion_b, opcion_c, opcion_d, respuesta_correcta, complejidad, explicacion 
    FROM preguntas_examen 
    WHERE id IN ($ids_str)
    ORDER BY FIELD(id, $ids_str)";
$res_calificar = mysqli_query($conecction, $query_calificar);

// Variables de calificación
$total_preguntas = 0;
$aciertos_total = 0;
$puntos_obtenidos = 0;
$puntos_maximos = 0;

$desglose = [
    'Junior'      => ['total' => 0, 'correctas' => 0, 'peso' => 1],
    'Semi-Senior' => ['total' => 0, 'correctas' => 0, 'peso' => 2],
    'Senior'      => ['total' => 0, 'correctas' => 0, 'peso' => 3],
    'Experto'     => ['total' => 0, 'correctas' => 0, 'peso' => 4],
];

$revision_preguntas = [];

while ($row = mysqli_fetch_assoc($res_calificar)) {
    $q_id = $row['id'];
    $comp = $row['complejidad'];
    $resp_correcta = strtoupper(trim($row['respuesta_correcta']));
    $resp_candidato = isset($respuestas_usuario[$q_id]) ? strtoupper(trim($respuestas_usuario[$q_id])) : null;
    
    $es_correcta = ($resp_candidato !== null && $resp_candidato === $resp_correcta);
    
    $total_preguntas++;
    if (isset($desglose[$comp])) {
        $desglose[$comp]['total']++;
        $peso = $desglose[$comp]['peso'];
        $puntos_maximos += $peso;
        if ($es_correcta) {
            $desglose[$comp]['correctas']++;
            $aciertos_total++;
            $puntos_obtenidos += $peso;
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

$porcentaje = ($total_preguntas > 0) ? round(($aciertos_total / $total_preguntas) * 100, 1) : 0;
$porcentaje_ponderado = ($puntos_maximos > 0) ? round(($puntos_obtenidos / $puntos_maximos) * 100, 1) : 0;

// Determinación del Nivel Diagnóstico
$nivel_determinado = 'Trainee';
$badge_rank_style = 'background: linear-gradient(135deg, #64748B, #475569); color: white;';
$mensaje_diagnostico = '';

$aciertos_jr = $desglose['Junior']['correctas'];
$aciertos_mid = $desglose['Semi-Senior']['correctas'];
$aciertos_sr = $desglose['Senior']['correctas'];
$aciertos_exp = $desglose['Experto']['correctas'];

if ($porcentaje >= 90 || ($aciertos_sr >= 4 && $aciertos_exp >= 4 && $porcentaje >= 80)) {
    $nivel_determinado = 'Experto / Lead Developer';
    $badge_rank_style = 'background: linear-gradient(135deg, #7C3AED, #4F46E5); color: white;';
    $mensaje_diagnostico = 'Demuestras dominio avanzado en arquitectura, optimización a bajo nivel, escalabilidad y patrones de diseño complejos.';
} elseif ($porcentaje >= 75 || ($aciertos_sr >= 4 && $porcentaje >= 70)) {
    $nivel_determinado = 'Programador Senior';
    $badge_rank_style = 'background: linear-gradient(135deg, #D97706, #B45309); color: white;';
    $mensaje_diagnostico = 'Posees sólidas competencias técnicas en buenas prácticas, resolución de problemas complejos y rendimiento.';
} elseif ($porcentaje >= 50) {
    $nivel_determinado = 'Programador Semi-Senior (Mid)';
    $badge_rank_style = 'background: linear-gradient(135deg, #2563EB, #1D4ED8); color: white;';
    $mensaje_diagnostico = 'Cuentas con buen dominio de las herramientas principales y capacidad para resolver requerimientos de negocio con autonomía.';
} elseif ($porcentaje >= 30) {
    $nivel_determinado = 'Programador Junior';
    $badge_rank_style = 'background: linear-gradient(135deg, #059669, #047857); color: white;';
    $mensaje_diagnostico = 'Comprendes los conceptos fundamentales y la sintaxis básica; apto para roles iniciales con supervisión y mentoría.';
} else {
    $nivel_determinado = 'Nivel Básico / Trainee';
    $badge_rank_style = 'background: linear-gradient(135deg, #DC2626, #991B1B); color: white;';
    $mensaje_diagnostico = 'Requieres reforzar los fundamentos teóricos y prácticos de la tecnología para alcanzar el nivel profesional requerido.';
}

$color_score = ($porcentaje >= 75) ? '#10B981' : (($porcentaje >= 50) ? '#3B82F6' : (($porcentaje >= 35) ? '#F59E0B' : '#EF4444'));
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Estilos del Módulo -->
    <link rel="stylesheet" href="css/examen.css">
</head>
<body class="examen-body">

    <!-- Barra de Navegación -->
    <nav class="examen-navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="index.php" class="examen-brand">
                <img src="../img/aiti.png" alt="Logo AI-TI">
                <div class="examen-brand-text">
                    <span>AI-TI</span>
                    <span class="examen-brand-subtitle">Resultados de Evaluación</span>
                </div>
            </a>
            <a href="index.php" class="btn btn-sm btn-light">
                <i class="bi bi-arrow-left"></i> Nuevo Examen
            </a>
        </div>
    </nav>

    <!-- Contenido de Resultados -->
    <main class="container my-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- Tarjeta Principal de Diagnóstico -->
                <div class="results-card mb-4">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-3">
                        <i class="bi bi-patch-check-fill me-1"></i> Evaluación Concluida
                    </span>

                    <h2 class="fw-bold mb-1 text-dark"><?= htmlspecialchars($nombre_candidato) ?></h2>
                    <p class="text-muted mb-4">
                        Examen de <strong><?= htmlspecialchars($lang_nombre) ?></strong> &bull; <?= date('d/m/Y H:i') ?>
                    </p>

                    <!-- Gráfico Circular de Calificación -->
                    <div class="score-circle" style="--score-pct: <?= $porcentaje ?>; --score-color: <?= $color_score ?>;">
                        <span class="score-number"><?= $porcentaje ?>%</span>
                        <span class="score-total"><?= $aciertos_total ?> de <?= $total_preguntas ?> correctas</span>
                    </div>

                    <!-- Insignia de Nivel Alcanzado -->
                    <div class="badge-rank" style="<?= $badge_rank_style ?>">
                        <i class="bi bi-trophy-fill me-2"></i> Nivel: <?= $nivel_determinado ?>
                    </div>

                    <p class="lead text-secondary mx-auto" style="max-width: 680px;">
                        <?= $mensaje_diagnostico ?>
                    </p>

                    <!-- Métricas Resumen -->
                    <div class="row g-3 mt-4 text-start">
                        <div class="col-sm-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block">Aciertos Totales</span>
                                <h4 class="fw-bold text-dark mb-0"><?= $aciertos_total ?> / <?= $total_preguntas ?></h4>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block">Puntuación Ponderada</span>
                                <h4 class="fw-bold text-primary mb-0"><?= $puntos_obtenidos ?> / <?= $puntos_maximos ?> pts</h4>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block">Efectividad Global</span>
                                <h4 class="fw-bold text-success mb-0"><?= $porcentaje ?>%</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desglose por Complejidad -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-bar-chart-line-fill text-primary me-2"></i>
                        Desempeño por Nivel de Complejidad
                    </h5>

                    <?php foreach ($desglose as $nivel_nombre => $datos): 
                        $pct_nivel = ($datos['total'] > 0) ? round(($datos['correctas'] / $datos['total']) * 100) : 0;
                        $color_bar = match($nivel_nombre) {
                            'Junior' => 'var(--color-jr)',
                            'Semi-Senior' => 'var(--color-mid)',
                            'Senior' => 'var(--color-sr)',
                            'Experto' => 'var(--color-exp)',
                            default => '#64748B'
                        };
                    ?>
                        <div class="breakdown-row">
                            <span class="fw-semibold" style="width: 130px;"><?= $nivel_nombre ?></span>
                            <div class="breakdown-progress">
                                <div class="breakdown-fill" style="width: <?= $pct_nivel ?>%; background-color: <?= $color_bar ?>;"></div>
                            </div>
                            <span class="fw-bold text-end" style="width: 100px;">
                                <?= $datos['correctas'] ?> / <?= $datos['total'] ?> (<?= $pct_nivel ?>%)
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Tarjeta de Envío por Correo -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white" id="seccionCorreo">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <h5 class="fw-bold text-dark mb-1">
                                <i class="bi bi-envelope-check-fill text-primary me-2"></i>
                                Enviar Reporte por Correo Electrónico
                            </h5>
                            <p class="text-muted small mb-0">Envía una copia del informe detallado al aspirante o al equipo de reclutamiento.</p>
                        </div>
                    </div>

                    <form id="emailResultsForm" class="mt-3">
                        <input type="hidden" name="nombre_candidato" value="<?= htmlspecialchars($nombre_candidato) ?>">
                        <input type="hidden" name="lenguaje_nombre" value="<?= htmlspecialchars($lang_nombre) ?>">
                        <input type="hidden" name="porcentaje" value="<?= $porcentaje ?>">
                        <input type="hidden" name="aciertos" value="<?= $aciertos_total ?>">
                        <input type="hidden" name="total" value="<?= $total_preguntas ?>">
                        <input type="hidden" name="puntos" value="<?= $puntos_obtenidos ?>">
                        <input type="hidden" name="nivel" value="<?= htmlspecialchars($nivel_determinado) ?>">
                        <input type="hidden" name="desglose_jr" value="<?= $aciertos_jr ?>/<?= $desglose['Junior']['total'] ?>">
                        <input type="hidden" name="desglose_mid" value="<?= $aciertos_mid ?>/<?= $desglose['Semi-Senior']['total'] ?>">
                        <input type="hidden" name="desglose_sr" value="<?= $aciertos_sr ?>/<?= $desglose['Senior']['total'] ?>">
                        <input type="hidden" name="desglose_exp" value="<?= $aciertos_exp ?>/<?= $desglose['Experto']['total'] ?>">

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

                <!-- Revisión Detallada de Preguntas -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-journal-text text-primary me-2"></i>
                        Revisión Detallada de las 20 Preguntas
                    </h5>

                    <div class="accordion" id="accordionRevision">
                        <?php foreach ($revision_preguntas as $idx => $rev): 
                            $es_correcta = $rev['es_correcta'];
                            $class_border = $es_correcta ? 'review-correct' : 'review-incorrect';
                            $icono_estado = $es_correcta ? '<i class="bi bi-check-circle-fill text-success fs-5"></i>' : '<i class="bi bi-x-circle-fill text-danger fs-5"></i>';
                        ?>
                            <div class="review-item <?= $class_border ?>">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <?= $icono_estado ?>
                                        <span class="fw-bold text-dark">Pregunta <?= $idx + 1 ?> (<?= $rev['complejidad'] ?>)</span>
                                    </div>
                                    <span class="badge <?= $es_correcta ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $es_correcta ? 'Correcta' : 'Incorrecta' ?>
                                    </span>
                                </div>

                                <p class="fw-semibold mb-3 text-secondary"><?= htmlspecialchars($rev['pregunta']) ?></p>

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
                                    <div class="explanation-box">
                                        <strong><i class="bi bi-lightbulb me-1"></i> Retroalimentación técnica:</strong>
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
                        <i class="bi bi-house me-2"></i> Volver a AI-TI
                    </a>
                </div>

            </div>
        </div>
    </main>

    <!-- Modal de Previsualización de Correo Electrónico (Para entornos locales sin SMTP) -->
    <div class="modal fade" id="emailPreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-envelope-paper-fill me-2"></i> Vista Previa del Correo Generado
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light" id="emailPreviewContent">
                    <!-- Contenido HTML del correo inyectado por JS -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
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
