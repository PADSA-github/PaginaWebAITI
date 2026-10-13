<?php
require_once __DIR__ . '/../config/constants.php';

$dataDir = __DIR__ . '/data';
$files = glob($dataDir . '/*_preguntas.php');

$selectedFile = $_GET['file'] ?? '';
$action = $_GET['action'] ?? 'list';
$questions = [];

if ($selectedFile && in_array($dataDir . '/' . $selectedFile, $files)) {
    $questions = include($dataDir . '/' . $selectedFile);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $selectedFile) {
    if ($action === 'save') {
        $id = $_POST['id'] ?? null;
        $pregunta = [
            'pregunta' => trim($_POST['pregunta']),
            'opcion_a' => trim($_POST['opcion_a']),
            'opcion_b' => trim($_POST['opcion_b']),
            'opcion_c' => trim($_POST['opcion_c']),
            'opcion_d' => trim($_POST['opcion_d']),
            'respuesta_correcta' => strtoupper(trim($_POST['respuesta_correcta'])),
            'complejidad' => trim($_POST['complejidad']),
            'explicacion' => trim($_POST['explicacion']),
            'tema' => trim($_POST['tema'] ?? '')
        ];

        if ($id !== null && $id !== '') {
            $questions[(int)$id] = $pregunta;
        } else {
            $questions[] = $pregunta;
        }

        $content = "<?php\nreturn " . var_export($questions, true) . ";\n";
        file_put_contents($dataDir . '/' . $selectedFile, $content);
        header("Location: crud.php?file=" . urlencode($selectedFile));
        exit;
    } elseif ($action === 'delete') {
        $id = $_POST['id'] ?? null;
        if ($id !== null && isset($questions[(int)$id])) {
            unset($questions[(int)$id]);
            // Reindex array
            $questions = array_values($questions);
            $content = "<?php\nreturn " . var_export($questions, true) . ";\n";
            file_put_contents($dataDir . '/' . $selectedFile, $content);
        }
        header("Location: crud.php?file=" . urlencode($selectedFile));
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Preguntas | AI-TI Evaluaciones</title>
    <link rel="icon" href="../img/aiti.png" />
    
    <!-- Bootstrap 5 & Icons -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Estilos Homogéneos -->
    <link rel="stylesheet" href="css/examen.css">
    <style>
        .char-counter {
            font-size: 0.78rem;
            float: right;
            font-weight: 600;
        }
        .char-valid { color: #198754; }
        .char-invalid { color: #dc3545; }
        .table-responsive { max-height: 600px; overflow-y: auto; }
        .badge-junior { background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .badge-semi-senior { background-color: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
        .badge-senior { background-color: #ffedd5; color: #9a3412; border: 1px solid #fed7aa; }
        .badge-ans { font-weight: 700; width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; }
    </style>
</head>
<body class="examen-body">

    <!-- Barra de Navegación Homogénea -->
    <nav class="examen-navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="index.php" class="examen-brand">
                <img src="../img/aiti.png" alt="Logo AI-TI">
                <div class="examen-brand-text">
                    <span class="examen-brand-title">AI-TI</span>
                    <span class="examen-brand-subtitle">CRUD y Edición de Bancos de Preguntas</span>
                </div>
            </a>
            <div class="d-flex align-items-center gap-2">
                <a href="agregar_pregunta.php" class="btn btn-sm btn-outline-light d-none d-md-inline-block">
                    <i class="bi bi-database me-1"></i> Banco en BD
                </a>
                <a href="index.php" class="btn btn-sm btn-outline-light">
                    <i class="bi bi-play-circle me-1"></i> Ir al Examen
                </a>
                <a href="<?= ROOT_URL ?>" class="btn btn-sm btn-outline-light">
                    <i class="bi bi-house me-1"></i> Inicio
                </a>
            </div>
        </div>
    </nav>

    <!-- Header Principal -->
    <header class="examen-hero-header">
        <div class="container">
            <span class="badge px-3 py-2 rounded-pill fw-bold mb-2 border text-primary" style="background-color: #e0f2fe;">
                <i class="bi bi-pencil-square me-1"></i> Herramienta de Gestión Técnica
            </span>
            <h1 class="examen-main-title">Administración Directa de Archivos de Preguntas</h1>
            <p class="examen-main-desc">
                Edita, agrega o elimina preguntas directamente sobre los archivos de datos de cada tecnología. 
                Condiciones: <strong>Pregunta &le; 100 caracteres</strong> y <strong>Opciones &le; 90 caracteres</strong>.
            </p>
        </div>
    </header>

    <main class="container my-4 flex-grow-1">
        <!-- Selector de Tecnología -->
        <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
            <div class="card-body p-4">
                <form method="GET" class="row g-3 align-items-end">
                    <div class="col-md-6 col-lg-5">
                        <label for="file" class="form-label fw-bold text-dark">
                            <i class="bi bi-file-earmark-code me-1 text-primary"></i> Selecciona la tecnología a gestionar:
                        </label>
                        <select name="file" id="file" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Selecciona un archivo de preguntas --</option>
                            <?php foreach ($files as $f): ?>
                                <?php 
                                    $fname = basename($f); 
                                    $label = str_replace('_preguntas.php', '', $fname);
                                    $label = strtoupper($label);
                                ?>
                                <option value="<?= $fname ?>" <?= $selectedFile === $fname ? 'selected' : '' ?>>
                                    <?= $label ?> (<?= $fname ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php if ($selectedFile): ?>
                    <div class="col-md-6 col-lg-7 d-flex justify-content-md-end gap-2">
                        <button type="button" class="btn btn-success fw-bold d-flex align-items-center gap-1" onclick="openModal()">
                            <i class="bi bi-plus-circle"></i> Nueva Pregunta
                        </button>
                    </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <?php if ($selectedFile): ?>
        <!-- Resumen del Archivo -->
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-list-check me-2 text-primary"></i> Preguntas en <code><?= htmlspecialchars($selectedFile) ?></code>
                    <span class="badge bg-primary rounded-pill ms-2"><?= count($questions) ?> registros</span>
                </h5>
                <div class="d-flex align-items-center gap-2">
                    <input type="text" id="filtroTabla" class="form-control form-control-sm" placeholder="Buscar en preguntas..." style="max-width: 240px;">
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tablaPreguntas">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;" class="text-center">#</th>
                                <th style="width: 120px;">Nivel</th>
                                <th style="width: 70px;" class="text-center">Resp.</th>
                                <th>Pregunta</th>
                                <th style="width: 150px;" class="text-end pe-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($questions)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No hay preguntas registradas en este archivo.</td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($questions as $id => $q): ?>
                            <?php 
                                $comp = $q['complejidad'] ?? 'Junior';
                                $badgeClass = 'badge-junior';
                                if ($comp === 'Semi-Senior') $badgeClass = 'badge-semi-senior';
                                if ($comp === 'Senior') $badgeClass = 'badge-senior';
                                
                                $qLen = mb_strlen($q['pregunta'] ?? '', 'UTF-8');
                                $isQLong = $qLen > 100;
                            ?>
                            <tr class="pregunta-fila">
                                <td class="text-center fw-bold text-muted"><?= $id ?></td>
                                <td>
                                    <span class="badge <?= $badgeClass ?> px-2 py-1 rounded-pill fw-semibold"><?= htmlspecialchars($comp) ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-dark badge-ans text-white"><?= htmlspecialchars($q['respuesta_correcta'] ?? '') ?></span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark mb-1">
                                        <?= htmlspecialchars($q['pregunta'] ?? '') ?>
                                        <?php if ($isQLong): ?>
                                            <span class="badge bg-danger ms-1">&gt;100 chars (<?= $qLen ?>)</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="small text-muted d-flex flex-wrap gap-2">
                                        <span><strong>A:</strong> <?= htmlspecialchars($q['opcion_a'] ?? '') ?></span>
                                        <span><strong>B:</strong> <?= htmlspecialchars($q['opcion_b'] ?? '') ?></span>
                                        <span><strong>C:</strong> <?= htmlspecialchars($q['opcion_c'] ?? '') ?></span>
                                        <span><strong>D:</strong> <?= htmlspecialchars($q['opcion_d'] ?? '') ?></span>
                                    </div>
                                </td>
                                <td class="text-end pe-3">
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick='editQuestion(<?= $id ?>, <?= json_encode($q, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>)'>
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form method="POST" action="crud.php?file=<?= urlencode($selectedFile) ?>&action=delete" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que deseas eliminar la pregunta #<?= $id ?>?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <!-- Modal de Edición / Nueva Pregunta con Bootstrap -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                <div class="modal-header bg-primary text-white" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                    <h5 class="modal-title fw-bold" id="modalTitle">Nueva Pregunta</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="crud.php?file=<?= urlencode($selectedFile) ?>&action=save" id="formPreguntaModal">
                    <input type="hidden" name="id" id="form_id">
                    <div class="modal-body p-4">
                        <!-- Pregunta -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark d-flex justify-content-between">
                                <span>Texto de la Pregunta:</span>
                                <span id="count_pregunta" class="char-counter char-valid">0 / 100</span>
                            </label>
                            <textarea name="pregunta" id="form_pregunta" rows="2" class="form-control" maxlength="100" required oninput="updateCharCount(this, 'count_pregunta', 100)"></textarea>
                            <div class="form-text">Máximo 100 caracteres.</div>
                        </div>

                        <!-- Opciones A y B -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark d-flex justify-content-between">
                                    <span>Opción A:</span>
                                    <span id="count_opcion_a" class="char-counter char-valid">0 / 90</span>
                                </label>
                                <input type="text" name="opcion_a" id="form_opcion_a" class="form-control" maxlength="90" required oninput="updateCharCount(this, 'count_opcion_a', 90)">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark d-flex justify-content-between">
                                    <span>Opción B:</span>
                                    <span id="count_opcion_b" class="char-counter char-valid">0 / 90</span>
                                </label>
                                <input type="text" name="opcion_b" id="form_opcion_b" class="form-control" maxlength="90" required oninput="updateCharCount(this, 'count_opcion_b', 90)">
                            </div>
                        </div>

                        <!-- Opciones C y D -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark d-flex justify-content-between">
                                    <span>Opción C:</span>
                                    <span id="count_opcion_c" class="char-counter char-valid">0 / 90</span>
                                </label>
                                <input type="text" name="opcion_c" id="form_opcion_c" class="form-control" maxlength="90" required oninput="updateCharCount(this, 'count_opcion_c', 90)">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark d-flex justify-content-between">
                                    <span>Opción D:</span>
                                    <span id="count_opcion_d" class="char-counter char-valid">0 / 90</span>
                                </label>
                                <input type="text" name="opcion_d" id="form_opcion_d" class="form-control" maxlength="90" required oninput="updateCharCount(this, 'count_opcion_d', 90)">
                            </div>
                        </div>

                        <!-- Respuesta Correcta y Complejidad -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Respuesta Correcta:</label>
                                <select name="respuesta_correcta" id="form_respuesta_correcta" class="form-select" required>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Nivel / Complejidad:</label>
                                <select name="complejidad" id="form_complejidad" class="form-select" required>
                                    <option value="Junior">Junior</option>
                                    <option value="Semi-Senior">Semi-Senior</option>
                                    <option value="Senior">Senior</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Tema (Etiqueta):</label>
                                <input type="text" name="tema" id="form_tema" class="form-control" placeholder="java, spring, react...">
                            </div>
                        </div>

                        <!-- Explicación -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark d-flex justify-content-between">
                                <span>Explicación / Justificación:</span>
                                <span id="count_explicacion" class="char-counter char-valid">0 / 90</span>
                            </label>
                            <textarea name="explicacion" id="form_explicacion" rows="2" class="form-control" maxlength="90" required oninput="updateCharCount(this, 'count_explicacion', 90)"></textarea>
                            <div class="form-text">Máximo 90 caracteres recomendados.</div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary fw-bold px-4">
                            <i class="bi bi-save me-1"></i> Guardar Pregunta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>
        let editModalInstance = null;

        document.addEventListener('DOMContentLoaded', function() {
            const modalEl = document.getElementById('editModal');
            if (modalEl && window.bootstrap) {
                editModalInstance = new bootstrap.Modal(modalEl);
            }

            // Filtro dinámico en tiempo real
            const filtroInput = document.getElementById('filtroTabla');
            if (filtroInput) {
                filtroInput.addEventListener('input', function() {
                    const term = this.value.toLowerCase();
                    const rows = document.querySelectorAll('.pregunta-fila');
                    rows.forEach(r => {
                        const text = r.innerText.toLowerCase();
                        r.style.display = text.includes(term) ? '' : 'none';
                    });
                });
            }
        });

        function updateCharCount(el, counterId, max) {
            const counter = document.getElementById(counterId);
            if (!counter) return;
            const len = el.value.length;
            counter.innerText = `${len} / ${max}`;
            if (len > max) {
                counter.className = 'char-counter char-invalid';
            } else {
                counter.className = 'char-counter char-valid';
            }
        }

        function refreshAllCounters() {
            updateCharCount(document.getElementById('form_pregunta'), 'count_pregunta', 100);
            updateCharCount(document.getElementById('form_opcion_a'), 'count_opcion_a', 90);
            updateCharCount(document.getElementById('form_opcion_b'), 'count_opcion_b', 90);
            updateCharCount(document.getElementById('form_opcion_c'), 'count_opcion_c', 90);
            updateCharCount(document.getElementById('form_opcion_d'), 'count_opcion_d', 90);
            updateCharCount(document.getElementById('form_explicacion'), 'count_explicacion', 90);
        }

        function openModal() {
            document.getElementById('modalTitle').innerText = 'Nueva Pregunta';
            document.getElementById('form_id').value = '';
            document.getElementById('form_pregunta').value = '';
            document.getElementById('form_opcion_a').value = '';
            document.getElementById('form_opcion_b').value = '';
            document.getElementById('form_opcion_c').value = '';
            document.getElementById('form_opcion_d').value = '';
            document.getElementById('form_respuesta_correcta').value = 'A';
            document.getElementById('form_complejidad').value = 'Junior';
            document.getElementById('form_explicacion').value = '';
            document.getElementById('form_tema').value = '';

            refreshAllCounters();
            if (editModalInstance) editModalInstance.show();
        }

        function editQuestion(id, data) {
            document.getElementById('modalTitle').innerText = 'Editar Pregunta #' + id;
            document.getElementById('form_id').value = id;
            document.getElementById('form_pregunta').value = data.pregunta || '';
            document.getElementById('form_opcion_a').value = data.opcion_a || '';
            document.getElementById('form_opcion_b').value = data.opcion_b || '';
            document.getElementById('form_opcion_c').value = data.opcion_c || '';
            document.getElementById('form_opcion_d').value = data.opcion_d || '';
            document.getElementById('form_respuesta_correcta').value = data.respuesta_correcta || 'A';
            document.getElementById('form_complejidad').value = data.complejidad || 'Junior';
            document.getElementById('form_explicacion').value = data.explicacion || '';
            document.getElementById('form_tema').value = data.tema || '';

            refreshAllCounters();
            if (editModalInstance) editModalInstance.show();
        }
    </script>
</body>
</html>
