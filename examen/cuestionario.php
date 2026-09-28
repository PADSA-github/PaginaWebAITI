<?php
// Cuestionario de Examen Dinámico con 20 Preguntas Balanceadas
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
$res_lang = $stmt_lang->get_result();
$info_lenguaje = $res_lang->fetch_assoc();
$stmt_lang->close();

if (!$info_lenguaje) {
    die("La tecnología seleccionada no se encuentra disponible.");
}

// Extraer 20 preguntas balanceadas: 5 Junior, 5 Semi-Senior, 5 Senior, 5 Experto
$niveles = ['Junior', 'Semi-Senior', 'Senior', 'Experto'];
$preguntas_seleccionadas = [];

$stmt_preg = $conecction->prepare("SELECT id, pregunta, opcion_a, opcion_b, opcion_c, opcion_d, complejidad 
    FROM preguntas_examen 
    WHERE lenguaje = ? AND complejidad = ? AND activo = 1 
    ORDER BY RAND() 
    LIMIT 5");

foreach ($niveles as $nivel) {
    $stmt_preg->bind_param('ss', $lenguaje_clave, $nivel);
    $stmt_preg->execute();
    $res_preg = $stmt_preg->get_result();
    while ($row = $res_preg->fetch_assoc()) {
        $preguntas_seleccionadas[] = $row;
    }
}
$stmt_preg->close();

// Si por alguna razón no se completaron 20 (banco incompleto), rellenar con aleatorias del lenguaje
if (count($preguntas_seleccionadas) < 20) {
    $ids_existentes = array_column($preguntas_seleccionadas, 'id');
    $ids_ignorar = !empty($ids_existentes) ? implode(',', array_map('intval', $ids_existentes)) : '0';
    $faltantes = 20 - count($preguntas_seleccionadas);
    
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
                    <span class="examen-brand-subtitle">Examen en Curso</span>
                </div>
            </a>
            <div class="d-flex align-items-center gap-2 text-white">
                <i class="bi bi-person-circle fs-5"></i>
                <span class="fw-semibold small d-none d-sm-inline"><?= htmlspecialchars($nombre_candidato) ?></span>
            </div>
        </div>
    </nav>

    <!-- Barra de Estado y Progreso Fija (Sticky) -->
    <div class="sticky-exam-header">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge px-3 py-2 rounded-pill fw-bold text-white" style="background-color: <?= htmlspecialchars($info_lenguaje['color']) ?>;">
                        <i class="bi <?= htmlspecialchars($info_lenguaje['icono']) ?> me-1"></i>
                        <?= htmlspecialchars($info_lenguaje['nombre']) ?>
                    </span>
                    <span class="exam-info-pill">
                        <i class="bi bi-ui-checks"></i>
                        <span>Respondidas: <strong id="answeredCount">0</strong> / 20</span>
                    </span>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="exam-info-pill timer-pill" id="timerPill">
                        <i class="bi bi-stopwatch-fill"></i>
                        <span id="timerText">30:00</span>
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

            <div class="row">
                <!-- Columna Principal: Las 20 Preguntas -->
                <div class="col-lg-8">
                    <?php foreach ($preguntas_seleccionadas as $index => $q): 
                        $num = $index + 1;
                        $q_id = $q['id'];
                        $comp_class = match($q['complejidad']) {
                            'Junior' => 'badge-jr',
                            'Semi-Senior' => 'badge-mid',
                            'Senior' => 'badge-sr',
                            'Experto' => 'badge-exp',
                            default => 'bg-secondary'
                        };
                    ?>
                        <input type="hidden" name="preguntas_ids[]" value="<?= $q_id ?>">
                        
                        <div class="question-card" id="pregunta_<?= $index ?>" data-qid="<?= $q_id ?>">
                            <div class="question-header">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold">Pregunta <?= $num ?> de 20</span>
                                    <span class="badge-complexity <?= $comp_class ?>">Nivel <?= $q['complejidad'] ?></span>
                                </div>
                            </div>

                            <h5 class="question-text"><?= htmlspecialchars($q['pregunta']) ?></h5>

                            <!-- Opciones A, B, C, D -->
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

                <!-- Columna Lateral: Navegador Rápido de Preguntas y Botón de Envío -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 85px;">
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-3">
                            <h6 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                                <i class="bi bi-grid-3x3-gap-fill text-primary"></i>
                                Mapa de Preguntas
                            </h6>
                            <p class="text-muted small mb-3">Haz clic en cualquier número para ir directamente al reactivo:</p>

                            <div class="nav-questions-grid">
                                <?php for ($i = 0; $i < count($preguntas_seleccionadas); $i++): ?>
                                    <button type="button" class="grid-q-btn" data-target="<?= $i ?>">
                                        <?= $i + 1 ?>
                                    </button>
                                <?php endfor; ?>
                            </div>

                            <div class="d-flex align-items-center justify-content-between small text-muted pt-2 border-top">
                                <span><i class="bi bi-square-fill text-info me-1"></i> Respondida</span>
                                <span><i class="bi bi-square text-secondary me-1"></i> Pendiente</span>
                            </div>
                        </div>

                        <!-- Botón para Concluir Examen -->
                        <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                            <h6 class="fw-bold mb-2">¿Terminaste tu evaluación?</h6>
                            <p class="text-muted small mb-3">Revisa que hayas respondido las 20 preguntas antes de enviar.</p>
                            <button type="submit" class="btn btn-aiti btn-lg w-100 py-3 fw-bold">
                                <i class="bi bi-check2-circle me-2"></i> Finalizar y Calificar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <!-- Footer -->
    <footer class="examen-footer text-center">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y') ?> AI-TI. Examen Técnico de Programación.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="js/examen.js"></script>
</body>
</html>
