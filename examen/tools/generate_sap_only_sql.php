<?php
// Genera el script SQL para cargar EXCLUSIVAMENTE la tecnología y preguntas de SAP
$sap_preguntas = include dirname(__DIR__) . '/data/sap_preguntas.php';
$retos_data = include dirname(__DIR__) . '/data/retos_codigo.php';
$sap_retos = $retos_data['sap'] ?? [];

$sql = "-- ==========================================================\n";
$sql .= "-- SCRIPT DE CARGA INCREMENTAL: SOLO SAP RETAIL Y SAP CAR\n";
$sql .= "-- Proyecto: AI-TI Portal de Evaluaciones Técnicas\n";
$sql .= "-- Fecha: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- ==========================================================\n\n";
$sql .= "SET NAMES utf8mb4;\n";
$sql .= "SET FOREIGN_KEY_CHECKS = 0;\n\n";

// 1. Lenguaje SAP
$sql .= "-- ----------------------------------------------------------\n";
$sql .= "-- 1. Registrar o actualizar la tecnología SAP\n";
$sql .= "-- ----------------------------------------------------------\n";
$sql .= "INSERT INTO `lenguajes_examen` (`clave`, `nombre`, `descripcion`, `icono`, `color`, `badge`, `activo`) \n";
$sql .= "VALUES ('sap', 'SAP (Core Modules & CAR Retail)', 'Evaluación técnica de SAP Core (MM, SD, FI/CO, ABAP, Retail Master Data) y SAP Customer Activity Repository (CAR, POS DTA, UDF, OPP, OAA).', 'bi-cart-check-fill', '#0A6ED1', 'Retail & SAP CAR', 1)\n";
$sql .= "ON DUPLICATE KEY UPDATE \n";
$sql .= "  nombre = VALUES(nombre), \n";
$sql .= "  descripcion = VALUES(descripcion), \n";
$sql .= "  icono = VALUES(icono), \n";
$sql .= "  color = VALUES(color), \n";
$sql .= "  badge = VALUES(badge), \n";
$sql .= "  activo = 1;\n\n";

// 2. Retos de código de SAP
$sql .= "-- ----------------------------------------------------------\n";
$sql .= "-- 2. Retos de Código de SAP (Valor: 2 Puntos c/u)\n";
$sql .= "-- ----------------------------------------------------------\n";
$sql .= "DELETE FROM `retos_codigo_examen` WHERE `lenguaje` = 'sap';\n\n";

foreach ($sap_retos as $r) {
    $titulo = addslashes($r['titulo']);
    $codigo = addslashes($r['codigo']);
    $func = addslashes($r['funcionalidad_esperada']);
    $conceptos = addslashes(json_encode($r['conceptos_clave'], JSON_UNESCAPED_UNICODE));
    $sql .= "INSERT INTO `retos_codigo_examen` (`lenguaje`, `titulo`, `codigo`, `funcionalidad_esperada`, `conceptos_clave`, `activo`) \n";
    $sql .= "VALUES ('sap', '$titulo', '$codigo', '$func', '$conceptos', 1);\n\n";
}

// 3. Preguntas de SAP
$sql .= "-- ----------------------------------------------------------\n";
$sql .= "-- 3. Preguntas de Examen de SAP (50 Core Retail + 50 SAP CAR = 100)\n";
$sql .= "-- ----------------------------------------------------------\n";
$sql .= "DELETE FROM `preguntas_examen` WHERE `lenguaje` = 'sap';\n\n";

foreach ($sap_preguntas as $idx => $p) {
    $pregunta = addslashes($p['pregunta']);
    $opcion_a = addslashes($p['opcion_a']);
    $opcion_b = addslashes($p['opcion_b']);
    $opcion_c = addslashes($p['opcion_c']);
    $opcion_d = addslashes($p['opcion_d']);
    $correcta = $p['respuesta_correcta'];
    $nivel = $p['complejidad'];
    $explicacion = addslashes($p['explicacion']);
    
    $sql .= "INSERT INTO `preguntas_examen` (`lenguaje`, `pregunta`, `opcion_a`, `opcion_b`, `opcion_c`, `opcion_d`, `respuesta_correcta`, `complejidad`, `explicacion`, `activo`) \n";
    $sql .= "VALUES ('sap', '$pregunta', '$opcion_a', '$opcion_b', '$opcion_c', '$opcion_d', '$correcta', '$nivel', '$explicacion', 1);\n";
}

$sql .= "\nSET FOREIGN_KEY_CHECKS = 1;\n";
$sql .= "-- Fin del script incremental de SAP\n";

$target_file = dirname(__DIR__) . '/cargar_solo_sap.sql';
file_put_contents($target_file, $sql);
echo "[OK] Archivo generado exitosamente: $target_file\n";
echo "Total preguntas: " . count($sap_preguntas) . "\n";
echo "Total retos: " . count($sap_retos) . "\n";
echo "Bytes: " . filesize($target_file) . "\n";

