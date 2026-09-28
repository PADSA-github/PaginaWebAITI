<?php
// Gestión de Banco de Preguntas y Nuevos Lenguajes
require_once __DIR__ . '/../config/database.php';

$mensaje = '';
$tipo_alerta = 'info';

// Procesar formulario de alta de pregunta o nuevo lenguaje
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modo_lenguaje = $_POST['modo_lenguaje'] ?? 'existente';
    $lenguaje_clave = '';

    if ($modo_lenguaje === 'nuevo') {
        $nueva_clave = strtolower(trim(preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['nueva_clave'] ?? '')));
        $nuevo_nombre = trim(filter_var($_POST['nuevo_nombre'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $nueva_desc = trim(filter_var($_POST['nueva_desc'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $nuevo_icono = trim(filter_var($_POST['nuevo_icono'] ?? 'bi-code-slash', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $nuevo_color = trim(filter_var($_POST['nuevo_color'] ?? '#073E63', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $nuevo_badge = trim(filter_var($_POST['nuevo_badge'] ?? 'Tecnología', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        if (!empty($nueva_clave) && !empty($nuevo_nombre)) {
            $stmt_new_lang = $conecction->prepare("INSERT INTO lenguajes_examen (clave, nombre, descripcion, icono, color, badge, activo) 
                VALUES (?, ?, ?, ?, ?, ?, 1)
                ON DUPLICATE KEY UPDATE nombre=VALUES(nombre), descripcion=VALUES(descripcion)");
            $stmt_new_lang->bind_param('ssssss', $nueva_clave, $nuevo_nombre, $nueva_desc, $nuevo_icono, $nuevo_color, $nuevo_badge);
            $stmt_new_lang->execute();
            $stmt_new_lang->close();
            $lenguaje_clave = $nueva_clave;
        } else {
            $mensaje = 'Debes ingresar una clave y nombre válidos para el nuevo lenguaje.';
            $tipo_alerta = 'danger';
        }
    } else {
        $lenguaje_clave = filter_var($_POST['lenguaje_existente'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    $pregunta = trim($_POST['pregunta'] ?? '');
    $opcion_a = trim($_POST['opcion_a'] ?? '');
    $opcion_b = trim($_POST['opcion_b'] ?? '');
    $opcion_c = trim($_POST['opcion_c'] ?? '');
    $opcion_d = trim($_POST['opcion_d'] ?? '');
    $respuesta_correcta = strtoupper(trim($_POST['respuesta_correcta'] ?? ''));
    $complejidad = filter_var($_POST['complejidad'] ?? 'Junior', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $explicacion = trim($_POST['explicacion'] ?? '');

    if (!empty($lenguaje_clave) && !empty($pregunta) && !empty($opcion_a) && !empty($opcion_b) && !empty($opcion_c) && !empty($opcion_d) && in_array($respuesta_correcta, ['A', 'B', 'C', 'D'])) {
        $stmt_ins = $conecction->prepare("INSERT INTO preguntas_examen (lenguaje, pregunta, opcion_a, opcion_b, opcion_c, opcion_d, respuesta_correcta, complejidad, explicacion, activo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");
        $stmt_ins->bind_param('sssssssss', $lenguaje_clave, $pregunta, $opcion_a, $opcion_b, $opcion_c, $opcion_d, $respuesta_correcta, $complejidad, $explicacion);
        
        if ($stmt_ins->execute()) {
            $mensaje = "¡Pregunta agregada con éxito para la tecnología '<strong>" . htmlspecialchars($lenguaje_clave) . "</strong>' (Nivel " . htmlspecialchars($complejidad) . ")!";
            $tipo_alerta = 'success';
        } else {
            $mensaje = "Error al guardar la pregunta: " . $stmt_ins->error;
            $tipo_alerta = 'danger';
        }
        $stmt_ins->close();
    } elseif (empty($mensaje)) {
        $mensaje = "Por favor completa todos los campos requeridos y selecciona una respuesta correcta válida (A, B, C o D).";
        $tipo_alerta = 'warning';
    }
}

// Consultar lenguajes activos
$res_langs = mysqli_query($conecction, "SELECT * FROM lenguajes_examen WHERE activo = 1 ORDER BY nombre ASC");

// Consultar últimas 15 preguntas agregadas
$filtro_lang = filter_var($_GET['filtro_lang'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$where_filtro = !empty($filtro_lang) ? "WHERE lenguaje = '" . mysqli_real_escape_string($conecction, $filtro_lang) . "'" : "";
$query_ultimas = "SELECT * FROM preguntas_examen $where_filtro ORDER BY id DESC LIMIT 15";
$res_ultimas = mysqli_query($conecction, $query_ultimas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración del Banco de Preguntas | AI-TI</title>
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
                    <span class="examen-brand-subtitle">Gestión de Reactivos</span>
                </div>
            </a>
            <a href="index.php" class="btn btn-sm btn-light">
                <i class="bi bi-play-circle me-1"></i> Ir al Examen
            </a>
        </div>
    </nav>

    <!-- Header -->
    <div class="examen-hero-header">
        <div class="container">
            <h2 class="examen-main-title">Banco de Preguntas y Tecnologías</h2>
            <p class="examen-main-desc">Agrega nuevas preguntas o da de alta nuevos lenguajes de programación al sistema de evaluaciones.</p>
        </div>
    </div>

    <!-- Contenedor Principal -->
    <main class="container my-4 flex-grow-1">
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?= $tipo_alerta ?> alert-dismissible fade show" role="alert">
                <?= $mensaje ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Formulario de Agregar Pregunta -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h5 class="fw-bold mb-3 text-dark">
                        <i class="bi bi-patch-plus-fill text-primary me-2"></i>
                        Nueva Pregunta de Opción Múltiple
                    </h5>

                    <form action="agregar_pregunta.php" method="POST">
                        <!-- Selección o Alta de Lenguaje -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tecnología / Lenguaje:</label>
                            <div class="d-flex gap-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="modo_lenguaje" id="modo_existente" value="existente" checked onchange="toggleModoLenguaje()">
                                    <label class="form-check-label" for="modo_existente">Existente</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="modo_lenguaje" id="modo_nuevo" value="nuevo" onchange="toggleModoLenguaje()">
                                    <label class="form-check-label" for="modo_nuevo">+ Registrar Nuevo Lenguaje</label>
                                </div>
                            </div>

                            <!-- Selector Existente -->
                            <div id="seccion_existente">
                                <select class="form-select" name="lenguaje_existente" id="lenguaje_existente">
                                    <?php 
                                    mysqli_data_seek($res_langs, 0);
                                    while ($l = mysqli_fetch_assoc($res_langs)): ?>
                                        <option value="<?= htmlspecialchars($l['clave']) ?>">
                                            <?= htmlspecialchars($l['nombre']) ?> (<?= htmlspecialchars($l['clave']) ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <!-- Formulario Nuevo Lenguaje -->
                            <div id="seccion_nuevo" style="display:none;" class="p-3 bg-light rounded-3 border mt-2">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="text" class="form-control form-control-sm" name="nueva_clave" placeholder="clave (ej: python, csharp)">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control form-control-sm" name="nuevo_nombre" placeholder="Nombre (ej: Python 3)">
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-sm" name="nueva_desc" placeholder="Descripción del perfil">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control form-control-sm" name="nuevo_icono" value="bi-code-square" placeholder="Icono (bi-*)">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control form-control-sm" name="nuevo_badge" value="Backend" placeholder="Badge">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Complejidad -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nivel de Complejidad:</label>
                            <select class="form-select" name="complejidad" required>
                                <option value="Junior">Junior (Conceptos básicos, sintaxis, fundamentos)</option>
                                <option value="Semi-Senior">Semi-Senior (POO, APIs, estructuras, manejo de errores)</option>
                                <option value="Senior">Senior (Arquitectura, patrones de diseño, optimización)</option>
                                <option value="Experto">Experto / Lead (Sistemas distribuidos, concurrency, internals)</option>
                            </select>
                        </div>

                        <!-- Enunciado de la Pregunta -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Enunciado de la Pregunta:</label>
                            <textarea class="form-control" name="pregunta" rows="3" placeholder="¿Cuál es la diferencia entre...?" required></textarea>
                        </div>

                        <!-- Opciones A, B, C, D -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Opciones de Respuesta (4 opciones):</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text fw-bold">A</span>
                                <input type="text" class="form-control" name="opcion_a" placeholder="Opción A" required>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text fw-bold">B</span>
                                <input type="text" class="form-control" name="opcion_b" placeholder="Opción B" required>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text fw-bold">C</span>
                                <input type="text" class="form-control" name="opcion_c" placeholder="Opción C" required>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text fw-bold">D</span>
                                <input type="text" class="form-control" name="opcion_d" placeholder="Opción D" required>
                            </div>
                        </div>

                        <!-- Respuesta Correcta -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Respuesta Correcta:</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="respuesta_correcta" id="ans_a" value="A" required>
                                    <label class="form-check-label fw-bold" for="ans_a">Opción A</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="respuesta_correcta" id="ans_b" value="B">
                                    <label class="form-check-label fw-bold" for="ans_b">Opción B</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="respuesta_correcta" id="ans_c" value="C">
                                    <label class="form-check-label fw-bold" for="ans_c">Opción C</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="respuesta_correcta" id="ans_d" value="D">
                                    <label class="form-check-label fw-bold" for="ans_d">Opción D</label>
                                </div>
                            </div>
                        </div>

                        <!-- Explicación / Feedback -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Explicación Técnica (Retroalimentación):</label>
                            <textarea class="form-control" name="explicacion" rows="2" placeholder="Explica por qué es la respuesta correcta..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-aiti w-100 py-2">
                            <i class="bi bi-save me-2"></i> Guardar en la Base de Datos
                        </button>
                    </form>
                </div>
            </div>

            <!-- Panel de Preguntas Recientes -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-clock-history text-primary me-2"></i>
                            Últimas Preguntas en el Banco
                        </h5>
                    </div>

                    <!-- Filtro por lenguaje -->
                    <form method="GET" class="mb-3">
                        <div class="input-group">
                            <select class="form-select form-select-sm" name="filtro_lang" onchange="this.form.submit()">
                                <option value="">Todos los lenguajes</option>
                                <?php 
                                mysqli_data_seek($res_langs, 0);
                                while ($l = mysqli_fetch_assoc($res_langs)): ?>
                                    <option value="<?= htmlspecialchars($l['clave']) ?>" <?= ($filtro_lang === $l['clave']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($l['nombre']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                            <?php if (!empty($filtro_lang)): ?>
                                <a href="agregar_pregunta.php" class="btn btn-sm btn-outline-secondary">Limpiar</a>
                            <?php endif; ?>
                        </div>
                    </form>

                    <div style="max-height: 650px; overflow-y: auto;">
                        <?php if ($res_ultimas && mysqli_num_rows($res_ultimas) > 0): ?>
                            <?php while ($p = mysqli_fetch_assoc($res_ultimas)): ?>
                                <div class="p-3 mb-2 bg-light rounded-3 border">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="badge bg-dark rounded-pill"><?= strtoupper($p['lenguaje']) ?></span>
                                        <span class="badge bg-secondary"><?= $p['complejidad'] ?></span>
                                    </div>
                                    <p class="fw-semibold small mb-1 text-dark"><?= htmlspecialchars($p['pregunta']) ?></p>
                                    <div class="small text-success">
                                        <strong>Correcta:</strong> Opción <?= $p['respuesta_correcta'] ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="text-muted text-center py-4">No se encontraron preguntas registradas.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="examen-footer text-center">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y') ?> AI-TI. Portal de Evaluaciones Técnicas.</p>
        </div>
    </footer>

    <script src="../js/bootstrap.min.js"></script>
    <script>
        function toggleModoLenguaje() {
            const esNuevo = document.getElementById('modo_nuevo').checked;
            document.getElementById('seccion_existente').style.display = esNuevo ? 'none' : 'block';
            document.getElementById('seccion_nuevo').style.display = esNuevo ? 'block' : 'none';
        }
    </script>
</body>
</html>
