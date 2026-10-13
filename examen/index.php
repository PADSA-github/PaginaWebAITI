<?php
// Forzar reporte de errores para diagnóstico
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Página Inicial - Selección de Examen Técnico Multi-Lenguaje
$error_db = null;
$tablas_instaladas = false;
$result_lenguajes = null;

try {
    // Asegurar que se resuelva 'config/constants.php' desde la raíz del proyecto
    set_include_path(dirname(__DIR__) . PATH_SEPARATOR . get_include_path());
    require_once __DIR__ . '/../config/database.php';

    if (isset($conecction) && $conecction) {
        $check = $conecction->query("SHOW TABLES LIKE 'lenguajes_examen'");
        if ($check && $check->num_rows > 0) {
            $tablas_instaladas = true;
            $query_lenguajes = "SELECT l.*, 
                (SELECT COUNT(*) FROM preguntas_examen p WHERE p.lenguaje = l.clave AND p.activo = 1) as total_preguntas
                FROM lenguajes_examen l 
                WHERE l.activo = 1 
                ORDER BY l.id ASC";
            $result_lenguajes = $conecction->query($query_lenguajes);
        } else {
            $tablas_instaladas = false;
        }
    }
} catch (Throwable $e) {
    $error_db = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación Técnica de Programación | AI-TI</title>
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
            <a href="<?= ROOT_URL ?>" class="examen-brand">
                <img src="../img/aiti.png" alt="Logo AI-TI">
                <div class="examen-brand-text">
                    <span class="examen-brand-title">AI-TI</span>
                    <span class="examen-brand-subtitle">Portal de Evaluaciones Técnicas</span>
                </div>
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="crud.php" class="examen-nav-link d-inline-block">
                    <i class="bi bi-pencil-square me-1"></i> CRUD Preguntas
                </a>
                <a href="agregar_pregunta.php" class="examen-nav-link d-none d-md-inline-block">
                    <i class="bi bi-plus-circle me-1"></i> Banco de Preguntas
                </a>
                <a href="<?= ROOT_URL ?>" class="btn btn-sm btn-outline-light d-flex align-items-center gap-1">
                    <i class="bi bi-house-door"></i> <span class="d-none d-sm-inline">Sitio Principal</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Header -->
    <header class="examen-hero-header">
        <div class="container">
            <span class="badge px-3 py-2 rounded-pill fw-bold mb-2 border text-primary" style="background-color: #e0f2fe;">
                <i class="bi bi-award-fill me-1"></i> Diagnóstico de Competencias en Programación
            </span>
            <h1 class="examen-main-title">Evaluación Técnica de Aspirantes</h1>
            <p class="examen-main-desc">
                Selecciona la tecnología a evaluar e ingresa tus datos. La prueba consta de <strong>18 preguntas de opción múltiple</strong> (6 Junior, 6 Semi-Senior, 6 Senior) y <strong>1 reto de análisis de código</strong> (2 puntos) para un total de <strong>20 puntos</strong>.
            </p>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="container my-4 flex-grow-1">
        <form action="cuestionario.php" method="POST" id="formSeleccionExamen">
            <input type="hidden" name="lenguaje" id="selected_lenguaje" value="" required>

            <!-- Sección 1: Selección de Lenguaje -->
            <div class="mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <span class="badge rounded-circle me-2 text-white" style="background-color: var(--aiti-primary); width:26px; height:26px; display:inline-flex; align-items:center; justify-content:center; font-size:0.8rem;">1</span>
                        Selecciona la Tecnología
                    </h5>
                    <span class="text-muted small">Elige una opción</span>
                </div>

                <div class="row g-3">
                    <?php if ($result_lenguajes && mysqli_num_rows($result_lenguajes) > 0): ?>
                        <?php while ($lang = mysqli_fetch_assoc($result_lenguajes)): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="language-card" data-lang="<?= htmlspecialchars($lang['clave']) ?>">
                                    <div class="lang-check"><i class="bi bi-check-lg"></i></div>
                                    <div class="lang-icon-wrap">
                                        <i class="bi <?= htmlspecialchars($lang['icono']) ?>"></i>
                                    </div>
                                    <span class="badge bg-light text-primary align-self-start mb-2 border">
                                        <?= htmlspecialchars($lang['badge']) ?>
                                    </span>
                                    <h5 class="lang-title"><?= htmlspecialchars($lang['nombre']) ?></h5>
                                    <p class="lang-desc"><?= htmlspecialchars($lang['descripcion']) ?></p>
                                    <div class="lang-meta">
                                        <span><i class="bi bi-database me-1"></i> <?= $lang['total_preguntas'] ?> preguntas</span>
                                        <span><i class="bi bi-check2-square me-1"></i> 20 Pts Totales</span>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12 py-3">
                            <?php if (!empty($error_db)): ?>
                                <div class="alert alert-danger shadow-sm rounded-4 p-4">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                                        <h5 class="fw-bold mb-0">Error de Base de Datos</h5>
                                    </div>
                                    <p class="mb-2"><?= htmlspecialchars($error_db) ?></p>
                                    <small class="text-muted">Verifica las credenciales en <code>config/constants.php</code> o asegúrate de que el servidor MySQL permita la conexión.</small>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info shadow-sm rounded-4 p-4 border" style="background:#f0f9ff; border-color:#bae6fd !important;">
                                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <i class="bi bi-database-fill-gear fs-1 text-primary"></i>
                                            <div>
                                                <h5 class="fw-bold mb-1 text-dark">Base de datos del examen no inicializada</h5>
                                                <p class="mb-0 text-secondary small">Las tablas del examen técnico (lenguajes, preguntas y retos) aún no han sido creadas o pobladas en la base de datos del servidor.</p>
                                            </div>
                                        </div>
                                        <a href="instalar_db.php" class="btn btn-primary btn-lg px-4 fw-bold text-nowrap">
                                            <i class="bi bi-play-circle-fill me-1"></i> Inicializar Base de Datos
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sección 2: Datos del Aspirante -->
            <div class="candidate-box">
                <div class="d-flex align-items-center mb-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <span class="badge rounded-circle me-2 text-white" style="background-color: var(--aiti-primary); width:26px; height:26px; display:inline-flex; align-items:center; justify-content:center; font-size:0.8rem;">2</span>
                        Datos del Aspirante
                    </h5>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nombre_candidato" name="nombre_candidato" placeholder="Juan Pérez" required>
                            <label for="nombre_candidato"><i class="bi bi-person me-1"></i> Nombre Completo</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email_candidato" name="email_candidato" placeholder="aspirante@ejemplo.com" required>
                            <label for="email_candidato"><i class="bi bi-envelope me-1"></i> Correo Electrónico (para resultados)</label>
                        </div>
                    </div>
                </div>

                <!-- Estructura de la Evaluación (18 + 2 = 20 pts) -->
                <div class="alert d-flex align-items-start gap-3 mt-4 mb-0 rounded-3 border" style="background-color: #f0f7fb; border-color: #bae6fd !important;">
                    <i class="bi bi-info-circle-fill fs-4 text-primary"></i>
                    <div class="small text-secondary">
                        <strong class="text-dark">Estructura y Ponderación del Examen (20 Puntos):</strong>
                        <ul class="mb-0 ps-3 mt-1">
                            <li><strong>18 Puntos:</strong> Preguntas de opción múltiple (<strong>6 Nivel Junior</strong>, <strong>6 Nivel Semi-Senior</strong> y <strong>6 Nivel Senior</strong> valiendo 1 punto cada una).</li>
                            <li><strong>2 Puntos:</strong> Análisis de código práctico. Se te mostrará un fragmento de código que deberás describir con tus propias palabras; el sistema evaluará si tu explicación corresponde a la funcionalidad.</li>
                            <li><strong>Tiempo Límite:</strong> 20 minutos. Al terminar obtendrás tu diagnóstico de nivel y podrás enviar el reporte por correo.</li>
                        </ul>
                    </div>
                </div>

                <!-- Botón de Envío -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-aiti btn-lg px-5" id="btnIniciarExamen" disabled>
                        <i class="bi bi-lock me-2"></i> Selecciona una tecnología arriba
                    </button>
                </div>
            </div>
        </form>
    </main>

    <!-- Footer Homogéneo al Sitio -->
    <footer class="examen-footer text-center">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y') ?> AI-TI (Aplicaciones Integrales en TI). Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="js/examen.js"></script>
</body>
</html>
