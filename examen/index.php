<?php
// Página Inicial - Selección de Examen Técnico Multi-Lenguaje
require_once __DIR__ . '/../config/database.php';

// Obtener lenguajes disponibles y activos
$query_lenguajes = "SELECT l.*, 
    (SELECT COUNT(*) FROM preguntas_examen p WHERE p.lenguaje = l.clave AND p.activo = 1) as total_preguntas
    FROM lenguajes_examen l 
    WHERE l.activo = 1 
    ORDER BY l.id ASC";

$result_lenguajes = mysqli_query($conecction, $query_lenguajes);
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Estilos del Módulo -->
    <link rel="stylesheet" href="css/examen.css">
</head>
<body class="examen-body">

    <!-- Barra de Navegación -->
    <nav class="examen-navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="<?= ROOT_URL ?>" class="examen-brand">
                <img src="../img/aiti.png" alt="Logo AI-TI">
                <div class="examen-brand-text">
                    <span>AI-TI</span>
                    <span class="examen-brand-subtitle">Portal de Evaluaciones</span>
                </div>
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="agregar_pregunta.php" class="btn btn-sm btn-outline-light d-none d-md-inline-flex align-items-center gap-1">
                    <i class="bi bi-plus-circle"></i> Agregar Pregunta
                </a>
                <a href="<?= ROOT_URL ?>" class="btn btn-sm btn-light d-flex align-items-center gap-1">
                    <i class="bi bi-house-door"></i> <span class="d-none d-sm-inline">Sitio Principal</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Header -->
    <header class="examen-hero-header">
        <div class="container">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-2">
                <i class="bi bi-award-fill me-1"></i> Diagnóstico de Competencias Técnicas
            </span>
            <h1 class="examen-main-title">Evaluación Técnica de Aspirantes</h1>
            <p class="examen-main-desc">
                Selecciona la tecnología a evaluar e ingresa tus datos. El sistema seleccionará <strong>20 preguntas balanceadas</strong> en 4 niveles de complejidad (Junior, Semi-Senior, Senior y Experto) para determinar tu nivel técnico.
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
                    <h4 class="fw-bold mb-0 text-dark">
                        <span class="badge bg-dark rounded-circle me-2" style="width:28px;height:28px;display:inline-flex;align-items:center;justify-content:center;font-size:0.85rem;">1</span>
                        Elige la Tecnología a Evaluar
                    </h4>
                    <span class="text-muted small">Selecciona una tarjeta</span>
                </div>

                <div class="row g-3">
                    <?php if ($result_lenguajes && mysqli_num_rows($result_lenguajes) > 0): ?>
                        <?php while ($lang = mysqli_fetch_assoc($result_lenguajes)): ?>
                            <div class="col-md-4">
                                <div class="language-card" data-lang="<?= htmlspecialchars($lang['clave']) ?>">
                                    <div class="lang-check"><i class="bi bi-check-lg"></i></div>
                                    <div class="lang-icon-wrap" style="background-color: <?= htmlspecialchars($lang['color']) ?>15; color: <?= htmlspecialchars($lang['color']) ?>;">
                                        <i class="bi <?= htmlspecialchars($lang['icono']) ?>"></i>
                                    </div>
                                    <span class="badge bg-light text-dark align-self-start mb-2 border">
                                        <?= htmlspecialchars($lang['badge']) ?>
                                    </span>
                                    <h5 class="lang-title"><?= htmlspecialchars($lang['nombre']) ?></h5>
                                    <p class="lang-desc"><?= htmlspecialchars($lang['descripcion']) ?></p>
                                    <div class="lang-meta">
                                        <span class="text-primary"><i class="bi bi-database me-1"></i> Banco: <?= $lang['total_preguntas'] ?> preguntas</span>
                                        <span class="text-muted"><i class="bi bi-clock me-1"></i> 20 reactivos</span>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <div class="alert alert-warning">
                                No hay lenguajes activos. Por favor ejecuta el <a href="instalar_db.php">instalador inicial</a> para registrar las tecnologías base.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sección 2: Datos del Aspirante -->
            <div class="candidate-box">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="fw-bold mb-0 text-dark">
                        <span class="badge bg-dark rounded-circle me-2" style="width:28px;height:28px;display:inline-flex;align-items:center;justify-content:center;font-size:0.85rem;">2</span>
                        Datos del Aspirante
                    </h4>
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

                <!-- Instrucciones -->
                <div class="alert alert-info d-flex align-items-start gap-3 mt-4 mb-0 rounded-3">
                    <i class="bi bi-info-circle-fill fs-4 text-primary"></i>
                    <div class="small">
                        <strong>Condiciones del Examen:</strong>
                        <ul class="mb-0 ps-3 mt-1">
                            <li>El examen consta de <strong>20 preguntas de opción múltiple</strong> elegidas aleatoriamente de nuestro banco de 100 preguntas por tecnología.</li>
                            <li>Incluye <strong>5 preguntas Junior, 5 Semi-Senior, 5 Senior y 5 de nivel Experto</strong>.</li>
                            <li>El tiempo máximo estimado es de <strong>30 minutos</strong>. Al terminar recibirás tu calificación y diagnóstico de nivel.</li>
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

    <!-- Footer -->
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
