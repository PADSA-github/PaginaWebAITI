<?php
// Script de instalación y migración de base de datos para el módulo de examen
header('Content-Type: text/html; charset=utf-8');

// Cargar configuración de base de datos
$config_path = __DIR__ . '/../config/database.php';
if (file_exists($config_path)) {
    require_once $config_path;
} else {
    // Fallback de conexión
    $conecction = new mysqli('localhost', 'root', '', 'blog_aiticommx');
    if ($conecction->connect_error) {
        die("Error de conexión: " . $conecction->connect_error);
    }
}

$conecction->set_charset('utf8mb4');

echo "<h2>Instalador del Módulo de Exámenes Técnicos Multi-Lenguaje</h2>";
echo "<pre style='background:#f4f4f4; padding:15px; border-radius:6px; font-family:monospace;'>";

// 1. Crear tabla de lenguajes
$sql_lenguajes = "CREATE TABLE IF NOT EXISTS `lenguajes_examen` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `clave` VARCHAR(50) UNIQUE NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT,
  `icono` VARCHAR(100) DEFAULT 'bi-code-slash',
  `color` VARCHAR(20) DEFAULT '#073E63',
  `badge` VARCHAR(50) DEFAULT 'Tecnología',
  `activo` TINYINT(1) DEFAULT 1,
  `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conecction->query($sql_lenguajes)) {
    echo "[OK] Tabla 'lenguajes_examen' verificada/creada correctamente.\n";
} else {
    echo "[ERROR] Creando tabla 'lenguajes_examen': " . $conecction->error . "\n";
}

// 2. Insertar o actualizar lenguajes iniciales
$lenguajes_iniciales = [
    [
        'clave' => 'java',
        'nombre' => 'Java (Core, JVM & Spring)',
        'descripcion' => 'Evaluación de Core Java, Programación Orientada a Objetos, Colecciones, Concurrencia, Memoria JVM y Arquitectura.',
        'icono' => 'bi-cup-hot-fill',
        'color' => '#E76F00',
        'badge' => 'Backend & Enterprise'
    ],
    [
        'clave' => 'react',
        'nombre' => 'React.js & Modern Frontend',
        'descripcion' => 'Evaluación técnica de Hooks, Reconciliación Virtual DOM, Gestión de Estado, Server Components y Performance.',
        'icono' => 'bi-atom',
        'color' => '#087ea4',
        'badge' => 'Frontend & Web'
    ],
    [
        'clave' => 'cobol',
        'nombre' => 'COBOL & Mainframe Systems',
        'descripcion' => 'Evaluación de Divisiones, Cláusulas PIC, Manejo de Archivos VSAM, Monitores CICS, DB2 SQL y Optimización MIPS.',
        'icono' => 'bi-terminal-fill',
        'color' => '#073E63',
        'badge' => 'Mainframe & Legacy'
    ]
];

$stmt_lang = $conecction->prepare("INSERT INTO `lenguajes_examen` (clave, nombre, descripcion, icono, color, badge, activo) 
    VALUES (?, ?, ?, ?, ?, ?, 1)
    ON DUPLICATE KEY UPDATE 
    nombre = VALUES(nombre), descripcion = VALUES(descripcion), icono = VALUES(icono), color = VALUES(color), badge = VALUES(badge), activo = 1");

foreach ($lenguajes_iniciales as $lang) {
    $stmt_lang->bind_param('ssssss', $lang['clave'], $lang['nombre'], $lang['descripcion'], $lang['icono'], $lang['color'], $lang['badge']);
    $stmt_lang->execute();
}
$stmt_lang->close();
echo "[OK] Lenguajes base (Java, React, COBOL) registrados/actualizados con éxito.\n";

// 3. Crear tabla de preguntas
$sql_preguntas = "CREATE TABLE IF NOT EXISTS `preguntas_examen` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `lenguaje` VARCHAR(50) NOT NULL,
  `pregunta` TEXT NOT NULL,
  `opcion_a` TEXT NOT NULL,
  `opcion_b` TEXT NOT NULL,
  `opcion_c` TEXT NOT NULL,
  `opcion_d` TEXT NOT NULL,
  `respuesta_correcta` CHAR(1) NOT NULL,
  `complejidad` ENUM('Junior', 'Semi-Senior', 'Senior', 'Experto') NOT NULL,
  `explicacion` TEXT NULL,
  `activo` TINYINT(1) DEFAULT 1,
  `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_lenguaje_complejidad` (`lenguaje`, `complejidad`, `activo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conecction->query($sql_preguntas)) {
    echo "[OK] Tabla 'preguntas_examen' verificada/creada correctamente.\n";
} else {
    echo "[ERROR] Creando tabla 'preguntas_examen': " . $conecction->error . "\n";
}

// 4. Cargar e insertar preguntas de los tres archivos de datos
$archivos_datos = [
    'java' => __DIR__ . '/data/java_preguntas.php',
    'react' => __DIR__ . '/data/react_preguntas.php',
    'cobol' => __DIR__ . '/data/cobol_preguntas.php'
];

$conecction->query("DELETE FROM `preguntas_examen` WHERE lenguaje IN ('java', 'react', 'cobol')");
echo "[INFO] Limpieza de preguntas previas realizada para inserción limpia.\n";

$insert_sql = "INSERT INTO `preguntas_examen` (lenguaje, pregunta, opcion_a, opcion_b, opcion_c, opcion_d, respuesta_correcta, complejidad, explicacion, activo)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
$stmt_preg = $conecction->prepare($insert_sql);

if (!$stmt_preg) {
    die("[ERROR FATAL] Error al preparar consulta de preguntas: " . $conecction->error . "\n");
}

$total_insertadas = 0;

foreach ($archivos_datos as $clave_lenguaje => $ruta_archivo) {
    if (!file_exists($ruta_archivo)) {
        echo "[ADVERTENCIA] Archivo no encontrado: $ruta_archivo\n";
        continue;
    }
    
    $preguntas = include $ruta_archivo;
    $count_lang = 0;
    
    foreach ($preguntas as $p) {
        $stmt_preg->bind_param(
            'sssssssss',
            $clave_lenguaje,
            $p['pregunta'],
            $p['opcion_a'],
            $p['opcion_b'],
            $p['opcion_c'],
            $p['opcion_d'],
            $p['respuesta_correcta'],
            $p['complejidad'],
            $p['explicacion']
        );
        if ($stmt_preg->execute()) {
            $count_lang++;
            $total_insertadas++;
        } else {
            echo "[ERROR] Error al insertar pregunta: " . $stmt_preg->error . "\n";
        }
    }
    echo "[OK] $count_lang preguntas insertadas exitosamente para '$clave_lenguaje'.\n";
}

$stmt_preg->close();

echo "\n============================================\n";
echo "RESUMEN FINAL DE INSTALACIÓN:\n";
echo "Total de preguntas en base de datos: $total_insertadas\n";

// Conteo por lenguaje y complejidad
$res = $conecction->query("SELECT lenguaje, complejidad, COUNT(*) as cantidad FROM preguntas_examen WHERE activo=1 GROUP BY lenguaje, complejidad ORDER BY lenguaje, FIELD(complejidad, 'Junior', 'Semi-Senior', 'Senior', 'Experto')");
echo "\nDesglose por tecnología y nivel:\n";
while ($row = $res->fetch_assoc()) {
    printf("  %-8s | %-12s : %2d preguntas\n", strtoupper($row['lenguaje']), $row['complejidad'], $row['cantidad']);
}

echo "\n¡Instalación completada con éxito!\n";
echo "</pre>";

if (php_sapi_name() !== 'cli') {
    echo "<p><a href='index.php' style='display:inline-block; background:#073E63; color:#fff; padding:10px 20px; text-decoration:none; border-radius:5px;'>Ir al Examen</a></p>";
}
