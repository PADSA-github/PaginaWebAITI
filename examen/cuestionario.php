<?php
// Cuestionario de Examen Dinámico: 18 Preguntas (6 Jr, 6 Mid, 6 Sr) + 1 Reto de Código (2 pts) = 20 Puntos
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['lenguaje'])) {
    header('Location: index.php');
    exit;
}

$lenguaje_clave = filter_var($_POST['lenguaje'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nombre_candidato = filter_var($_POST['nombre_candidato'] ?? 'Aspirante', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email_candidato = filter_var($_POST['email_candidato'] ?? '', FILTER_SANITIZE_EMAIL);

// Consultar información del lenguaje
$stmt_lang = $conecction->prepare("SELECT * FROM lenguajes_examen WHERE clave = ? AND activo = 1 LIMIT 1");
$stmt_lang->bind_param('s', $lenguaje_clave);
$stmt_lang->execute();
$info_lenguaje = $stmt_lang->get_result()->fetch_assoc();
$stmt_lang->close();

if (!$info_lenguaje) {
    die("La tecnología seleccionada no se encuentra disponible.");
}

// Extraer 18 preguntas: 6 Junior, 6 Semi-Senior, 6 Senior (1 punto cada una = 18 puntos)
$niveles_requeridos = [
    'Junior'      => 6,
    'Semi-Senior' => 6,
    'Senior'      => 6
];

$preguntas_seleccionadas = [];

$stmt_preg = $conecction->prepare("SELECT id, pregunta, opcion_a, opcion_b, opcion_c, opcion_d, complejidad 
    FROM preguntas_examen 
    WHERE lenguaje = ? AND complejidad = ? AND activo = 1 
    ORDER BY RAND() 
    LIMIT ?");

foreach ($niveles_requeridos as $nivel => $limite) {
    $stmt_preg->bind_param('ssi', $lenguaje_clave, $nivel, $limite);
    $stmt_preg->execute();
    $res_preg = $stmt_preg->get_result();
    while ($row = $res_preg->fetch_assoc()) {
        $preguntas_seleccionadas[] = $row;
    }
}
$stmt_preg->close();

// Si por alguna razón no se completaron 18 preguntas, completar con aleatorias
if (count($preguntas_seleccionadas) < 18) {
    $ids_existentes = array_column($preguntas_seleccionadas, 'id');
    $ids_ignorar = !empty($ids_existentes) ? implode(',', array_map('intval', $ids_existentes)) : '0';
    $faltantes = 18 - count($preguntas_seleccionadas);
    
    $query_extra = "SELECT id, pregunta, opcion_a, opcion_b, opcion_c, opcion_d, complejidad 
        FROM preguntas_examen 
        WHERE lenguaje = '$lenguaje_clave' AND id NOT IN ($ids_ignorar) AND activo = 1 
        ORDER BY RAND() 
        LIMIT $faltantes";
    $res_extra = mysqli_query($conecction, $query_extra);
    while ($row = mysqli_fetch_assoc($res_extra)) {
        $preguntas_seleccionadas[] = $row;
    }
}

// Consultar 1 reto de código para el lenguaje (Valor: 2 puntos)
$stmt_reto = $conecction->prepare("SELECT id, titulo, codigo FROM retos_codigo_examen WHERE lenguaje = ? AND activo = 1 ORDER BY RAND() LIMIT 1");
$stmt_reto->bind_param('s', $lenguaje_clave);
$stmt_reto->execute();
$reto_codigo = $stmt_reto->get_result()->fetch_assoc();
$stmt_reto->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Técnico: <?= htmlspecialchars($info_lenguaje['nombre']) ?> | AI-TI</title>
    <link rel="icon" href="../img/aiti.png" />
    
    <!-- Bootstrap 5 & Icons -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Estilos Homogéneos del Módulo -->
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
                    <span class="examen-brand-subtitle">Evaluación Técnica en Curso</span>
                </div>
            </a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white small d-none d-md-inline">
                    <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($nombre_candidato) ?>
                </span>
                <a href="index.php" class="btn btn-sm btn-outline-light" onclick="return confirm('¿Deseas salir del examen? Las respuestas no guardadas se perderán.');">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </a>
            </div>
        </div>
    </nav>

    <!-- Barra de Estado y Progreso Fija -->
    <div class="sticky-exam-header">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge px-3 py-2 rounded-pill fw-bold text-white" style="background-color: var(--aiti-primary);">
                        <i class="bi <?= htmlspecialchars($info_lenguaje['icono']) ?> me-1"></i>
                        <?= htmlspecialchars($info_lenguaje['nombre']) ?>
                    </span>
                    <span class="exam-info-pill">
                        <i class="bi bi-list-check"></i>
                        <span>Respondidas: <strong id="answeredCount">0</strong> / 19</span>
                    </span>
                    <span class="exam-info-pill d-none d-sm-inline-flex">
                        <i class="bi bi-award"></i>
                        <span>Total: <strong>20 Puntos</strong></span>
                    </span>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="exam-info-pill timer-pill" id="timerPill">
                        <i class="bi bi-clock-history"></i>
                        <span id="timerText">20:00</span>
                    </span>
                </div>
            </div>

            <!-- Barra de Progreso Visual -->
            <div class="exam-progress-bar">
                <div class="exam-progress-fill" id="examProgressFill" style="width: 0%;"></div>
            </div>
        </div>
    </div>

    <!-- Contenedor del Cuestionario -->
    <main class="container my-4 flex-grow-1">
        <form action="evaluar.php" method="POST" id="examForm">
            <input type="hidden" name="lenguaje" value="<?= htmlspecialchars($lenguaje_clave) ?>">
            <input type="hidden" name="nombre_candidato" value="<?= htmlspecialchars($nombre_candidato) ?>">
            <input type="hidden" name="email_candidato" value="<?= htmlspecialchars($email_candidato) ?>">
            <input type="hidden" name="reto_id" value="<?= $reto_codigo ? $reto_codigo['id'] : 0 ?>">

            <div class="row">
                <!-- Columna Principal: 18 Preguntas + 1 Reto de Código -->
                <div class="col-lg-8">

                    <!-- SECCIÓN 1: 18 PREGUNTAS DE OPCIÓN MÚLTIPLE (18 PUNTOS) -->
                    <div class="mb-3">
                        <div class="p-3 bg-white rounded-3 border mb-3 d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Parte 1: Preguntas de Opción Múltiple (18 Puntos)</h6>
                                <span class="text-muted small">6 Junior &bull; 6 Semi-Senior &bull; 6 Senior (1 pt cada una)</span>
                            </div>
                            <span class="badge bg-light text-primary border fw-bold">18 reactivos</span>
                        </div>

                        <?php foreach ($preguntas_seleccionadas as $index => $q): 
                            $num = $index + 1;
                            $q_id = $q['id'];
                            $comp_class = match($q['complejidad']) {
                                'Junior' => 'badge-jr',
                                'Semi-Senior' => 'badge-mid',
                                'Senior' => 'badge-sr',
                                default => 'bg-secondary'
                            };
                        ?>
                            <input type="hidden" name="preguntas_ids[]" value="<?= $q_id ?>">
                            
                            <div class="question-card" id="pregunta_<?= $index ?>" data-qid="<?= $q_id ?>">
                                <div class="question-header">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-primary rounded-pill px-3 py-1 fw-bold">Reactivo <?= $num ?> / 18</span>
                                        <span class="badge-complexity <?= $comp_class ?>"><?= $q['complejidad'] ?></span>
                                    </div>
                                    <span class="text-muted small fw-semibold">Valor: 1 punto</span>
                                </div>

                                <h5 class="question-text"><?= htmlspecialchars($q['pregunta']) ?></h5>

                                <!-- Opciones A, B, C, D Simétricas -->
                                <div class="options-container">
                                    <?php 
                                    $opciones = [
                                        'A' => $q['opcion_a'],
                                        'B' => $q['opcion_b'],
                                        'C' => $q['opcion_c'],
                                        'D' => $q['opcion_d']
                                    ];
                                    foreach ($opciones as $letra => $texto_opcion): 
                                        $input_id = "q_{$q_id}_{$letra}";
                                    ?>
                                        <div>
                                            <input type="radio" 
                                                   name="respuestas[<?= $q_id ?>]" 
                                                   id="<?= $input_id ?>" 
                                                   value="<?= $letra ?>" 
                                                   class="option-input">
                                            <label for="<?= $input_id ?>" class="option-label">
                                                <span class="option-key"><?= $letra ?></span>
                                                <span class="option-content"><?= htmlspecialchars($texto_opcion) ?></span>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- SECCIÓN 2: RETO DE CÓDIGO (2 PUNTOS) -->
                    <?php if ($reto_codigo): ?>
                        <div class="code-challenge-card" id="pregunta_18" data-qid="reto">
                            <div class="code-challenge-header">
                                <div>
                                    <span class="badge-challenge me-2">Parte 2: Análisis Práctico de Código</span>
                                    <span class="badge bg-light text-dark border fw-bold">Valor: 2 Puntos</span>
                                </div>
                            </div>

                            <h5 class="fw-bold text-dark mb-2"><?= htmlspecialchars($reto_codigo['titulo']) ?></h5>
                            <p class="text-muted small mb-3">
                                Lee atentamente el siguiente fragmento de código y explica con tus propias palabras qué hace y cuál es su funcionalidad técnica:
                            </p>

                            <!-- Bloque de Código con estilo terminal AI-TI -->
                            <div class="code-box-container">
                                <div class="code-box-topbar">
                                    <span class="dot dot-red"></span>
                                    <span class="dot dot-yellow"></span>
                                    <span class="dot dot-green"></span>
                                    <span class="ms-2"><?= htmlspecialchars($info_lenguaje['nombre']) ?> &bull; Código a analizar</span>
                                </div>
                                <pre class="code-display"><?= htmlspecialchars($reto_codigo['codigo']) ?></pre>
                            </div>

                            <!-- Área de Respuesta del Aspirante -->
                            <div class="mt-3">
                                <label for="descripcion_codigo" class="form-label fw-bold text-dark d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-pencil-square text-primary me-1"></i> Tu Explicación Técnica:</span>
                                    <span class="text-muted small fw-normal">Máximo 2 puntos</span>
                                </label>
                                <textarea class="form-control" 
                                          name="descripcion_codigo" 
                                          id="descripcion_codigo" 
                                          rows="5" 
                                          placeholder="Describe detalladamente qué hace este código, qué operaciones realiza, qué parámetros recibe y qué retorna o genera..." 
                                          required></textarea>
                                <div class="form-text text-muted">
                                    El sistema evaluará si tu descripción corresponde a la funcionalidad real del código (palabras clave, flujo de ejecución y resultado).
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

                <!-- Columna Lateral: Mapa de Navegación y Envío -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 85px;">
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-3 bg-white">
                            <h6 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                                <i class="bi bi-grid-3x3-gap-fill text-primary"></i>
                                Mapa de la Prueba (20 Pts)
                            </h6>
                            <p class="text-muted small mb-2">Haz clic para saltar directamente a cualquier sección:</p>

                            <!-- Cuadrícula 18 Reactivos + Reto Código -->
                            <div class="nav-questions-grid">
                                <?php for ($i = 0; $i < 18; $i++): ?>
                                    <button type="button" class="grid-q-btn" data-target="<?= $i ?>">
                                        <?= $i + 1 ?>
                                    </button>
                                <?php endfor; ?>
                                <button type="button" class="grid-q-btn challenge-btn" data-target="18">
                                    <i class="bi bi-code-slash me-1"></i> Código (2 pts)
                                </button>
                            </div>

                            <div class="d-flex align-items-center justify-content-between small text-muted pt-2 border-top">
                                <span><i class="bi bi-check-circle-fill text-info me-1"></i> Respondida</span>
                                <span><i class="bi bi-circle text-secondary me-1"></i> Pendiente</span>
                            </div>
                        </div>

                        <!-- Botón de Envío -->
                        <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white">
                            <h6 class="fw-bold mb-2 text-dark">¿Concluiste tu evaluación?</h6>
                            <p class="text-muted small mb-3">Revisa haber respondido las 18 preguntas y la descripción de código.</p>
                            <button type="submit" class="btn btn-aiti btn-lg w-100 py-3 fw-bold">
                                <i class="bi bi-check2-circle me-2"></i> Finalizar y Calificar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

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
