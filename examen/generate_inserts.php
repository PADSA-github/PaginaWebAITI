<?php
header('Content-Type: text/html; charset=utf-8');
echo "<h2>Generador de SQL Inserts</h2>";

$sql = "-- Archivo generado con todos los inserts\n\n";

// 1. lenguajes_examen
$sql .= "-- ==========================================\n";
$sql .= "-- TABLA: lenguajes_examen\n";
$sql .= "-- ==========================================\n";
$lenguajes_iniciales = [
    [
        'clave' => 'java',
        'nombre' => 'Java (Core, JVM & Spring)',
        'descripcion' => 'Evaluación de Core Java, Programación Orientada a Objetos, Colecciones, Concurrencia y Arquitectura.',
        'icono' => 'bi-cup-hot-fill',
        'color' => '#073E63',
        'badge' => 'Backend & Enterprise'
    ],
    [
        'clave' => 'react',
        'nombre' => 'React.js & Modern Frontend',
        'descripcion' => 'Evaluación técnica de Hooks, Reconciliación Virtual DOM, Gestión de Estado y Arquitectura Web.',
        'icono' => 'bi-atom',
        'color' => '#289CC7',
        'badge' => 'Frontend & Web'
    ],
    [
        'clave' => 'cobol',
        'nombre' => 'COBOL & Mainframe Systems',
        'descripcion' => 'Evaluación de Divisiones, Cláusulas PIC, Manejo de Archivos VSAM, Monitores CICS, DB2 SQL y JCL.',
        'icono' => 'bi-terminal-fill',
        'color' => '#04253c',
        'badge' => 'Mainframe & JCL'
    ],
    [
        'clave' => 'informix',
        'nombre' => 'Informix 4GL & Relational Systems',
        'descripcion' => 'Evaluación de Sintaxis 4GL, Formularios .per, Manejo de Cursores, Transacciones, SPL y Reportes.',
        'icono' => 'bi-database-fill-gear',
        'color' => '#0e4d6c',
        'badge' => 'Database & 4GL'
    ],
    [
        'clave' => 'cloud_ia',
        'nombre' => 'Cloud & Inteligencia Artificial',
        'descripcion' => 'Evaluación de Arquitecturas Cloud AI, LLMs, AWS Bedrock, Vertex AI, Azure OpenAI, RAG, Embeddings y Agentes.',
        'icono' => 'bi-cpu-fill',
        'color' => '#107569',
        'badge' => 'AI & Cloud Systems'
    ]
];

foreach ($lenguajes_iniciales as $lang) {
    $desc = addslashes($lang['descripcion']);
    $sql .= "INSERT INTO `lenguajes_examen` (`clave`, `nombre`, `descripcion`, `icono`, `color`, `badge`, `activo`) VALUES ('{$lang['clave']}', '{$lang['nombre']}', '{$desc}', '{$lang['icono']}', '{$lang['color']}', '{$lang['badge']}', 1);\n";
}
$sql .= "\n\n";

// 2. retos_codigo_examen
$sql .= "-- ==========================================\n";
$sql .= "-- TABLA: retos_codigo_examen\n";
$sql .= "-- ==========================================\n";
$retos_file = __DIR__ . '/data/retos_codigo.php';
if (file_exists($retos_file)) {
    $retos_data = include $retos_file;
    foreach ($retos_data as $clave_lang => $lista_retos) {
        foreach ($lista_retos as $reto) {
            $conceptos_json = addslashes(json_encode($reto['conceptos_clave'], JSON_UNESCAPED_UNICODE));
            $titulo = addslashes($reto['titulo']);
            $codigo = addslashes($reto['codigo']);
            $funcionalidad = addslashes($reto['funcionalidad_esperada']);
            $sql .= "INSERT INTO `retos_codigo_examen` (`lenguaje`, `titulo`, `codigo`, `funcionalidad_esperada`, `conceptos_clave`, `activo`) VALUES ('$clave_lang', '$titulo', '$codigo', '$funcionalidad', '$conceptos_json', 1);\n";
        }
    }
}
$sql .= "\n\n";

// 3. preguntas_examen
$sql .= "-- ==========================================\n";
$sql .= "-- TABLA: preguntas_examen\n";
$sql .= "-- ==========================================\n";
$archivos_datos = [
    'java'     => __DIR__ . '/data/java_preguntas.php',
    'react'    => __DIR__ . '/data/react_preguntas.php',
    'cobol'    => __DIR__ . '/data/cobol_preguntas.php',
    'informix' => __DIR__ . '/data/informix_preguntas.php',
    'cloud_ia' => __DIR__ . '/data/cloud_ia_preguntas.php'
];

foreach ($archivos_datos as $clave_lenguaje => $ruta_archivo) {
    if (file_exists($ruta_archivo)) {
        $preguntas = include $ruta_archivo;
        foreach ($preguntas as $p) {
            $pregunta = addslashes($p['pregunta']);
            $opcion_a = addslashes($p['opcion_a']);
            $opcion_b = addslashes($p['opcion_b']);
            $opcion_c = addslashes($p['opcion_c']);
            $opcion_d = addslashes($p['opcion_d']);
            $explicacion = addslashes($p['explicacion']);
            
            $sql .= "INSERT INTO `preguntas_examen` (`lenguaje`, `pregunta`, `opcion_a`, `opcion_b`, `opcion_c`, `opcion_d`, `respuesta_correcta`, `complejidad`, `explicacion`, `activo`) VALUES ('$clave_lenguaje', '$pregunta', '$opcion_a', '$opcion_b', '$opcion_c', '$opcion_d', '{$p['respuesta_correcta']}', '{$p['complejidad']}', '$explicacion', 1);\n";
        }
    }
}

file_put_contents(__DIR__ . '/inserts_completos.sql', $sql);
echo "<p>El archivo <strong>inserts_completos.sql</strong> ha sido generado con éxito en la raíz de la carpeta <code>examen</code>.</p>";
echo "<textarea style='width:100%; height:400px;'>$sql</textarea>";
