<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

echo "<h2>Diagnóstico de Servidor y Base de Datos (Módulo Examen AI-TI)</h2>";
echo "<pre style='background:#f4f6f8; padding:18px; border-radius:8px; font-family:monospace; font-size:14px; line-height:1.6;'>";

echo "1. INFORMACIÓN DEL SERVIDOR:\n";
echo "   - Versión de PHP: " . phpversion() . "\n";
echo "   - SAPI / Servidor: " . php_sapi_name() . " / " . ($_SERVER['SERVER_SOFTWARE'] ?? 'N/A') . "\n";
echo "   - Directorio del script: " . __DIR__ . "\n";

$db_file = __DIR__ . '/../config/database.php';
echo "\n2. RUTA DE CONFIGURACIÓN:\n";
echo "   - Buscando: " . $db_file . "\n";
echo "   - ¿El archivo existe?: " . (file_exists($db_file) ? "SI [OK]" : "NO [ERROR]") . "\n";

if (!file_exists($db_file)) {
    die("\n[ERROR CRÍTICO] No se encontró config/database.php en la ruta esperada.</pre>");
}

// Asegurar resolución de rutas relativas como 'config/constants.php' desde la raíz
set_include_path(dirname(__DIR__) . PATH_SEPARATOR . get_include_path());

echo "\n3. CONEXIÓN A BASE DE DATOS:\n";
try {
    require_once $db_file;

    if (!isset($conecction) || !$conecction) {
        throw new Exception("La variable \$conecction no fue inicializada en config/database.php");
    }

    if ($conecction->connect_error) {
        throw new Exception("Fallo de conexión: " . $conecction->connect_error);
    }

    echo "   - Conexión MySQL establecida: [OK]\n";
    echo "   - Servidor MySQL: " . $conecction->server_info . "\n";
    echo "   - Host info: " . $conecction->host_info . "\n";
    
    // Base de datos actual
    $db_name_res = $conecction->query("SELECT DATABASE() as db");
    $current_db = $db_name_res ? $db_name_res->fetch_assoc()['db'] : 'Desconocida';
    echo "   - Base de datos conectada: " . $current_db . "\n";

    echo "\n4. VERIFICACIÓN DE TABLAS DEL EXAMEN:\n";
    $tablas = [
        'lenguajes_examen',
        'preguntas_examen',
        'retos_codigo_examen'
    ];

    $todas_existen = true;
    foreach ($tablas as $tabla) {
        $res = $conecction->query("SHOW TABLES LIKE '$tabla'");
        if ($res && $res->num_rows > 0) {
            $count_res = $conecction->query("SELECT COUNT(*) as total FROM `$tabla`");
            $total = $count_res ? $count_res->fetch_assoc()['total'] : 'Error';
            echo "   [OK] Tabla '$tabla' EXISTE con $total registros.\n";
        } else {
            echo "   [FALTA] Tabla '$tabla' NO EXISTE en esta base de datos.\n";
            $todas_existen = false;
        }
    }

    echo "\n5. PRUEBA DE CONSULTA PRINCIPAL (examen/index.php):\n";
    $sql_index = "SELECT l.*, 
        (SELECT COUNT(*) FROM preguntas_examen p WHERE p.lenguaje = l.clave AND p.activo = 1) as total_preguntas
        FROM lenguajes_examen l 
        WHERE l.activo = 1 
        ORDER BY l.id ASC";

    $res_index = $conecction->query($sql_index);
    if ($res_index) {
        echo "   [OK] La consulta se ejecutó con éxito. Lenguajes encontrados: " . $res_index->num_rows . "\n";
        while ($row = $res_index->fetch_assoc()) {
            echo "        - {$row['clave']}: {$row['nombre']} ({$row['total_preguntas']} preguntas)\n";
        }
    } else {
        echo "   [ERROR] Falló la consulta: " . $conecction->error . "\n";
    }

    echo "\n============================================\n";
    if ($todas_existen && $res_index && $res_index->num_rows > 0) {
        echo "¡TODO CORRECTO! La base de datos y consultas funcionan al 100%.\n";
        echo "Puedes abrir index.php directamente: <a href='index.php'>Ir al Examen</a>\n";
    } else {
        echo "FALTAN TABLAS O DATOS. Por favor corre el instalador: <a href='instalar_db.php'>Ejecutar instalar_db.php</a>\n";
    }

} catch (Throwable $e) {
    echo "   [ERROR EXCEPCIÓN DETECTADO]:\n";
    echo "   Mensaje: " . $e->getMessage() . "\n";
    echo "   Archivo: " . $e->getFile() . " (Línea: " . $e->getLine() . ")\n";
    echo "\n   Traza:\n" . $e->getTraceAsString() . "\n";
}

echo "</pre>";
