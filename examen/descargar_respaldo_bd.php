<?php
// Generador y descargador de respaldo SQL completo de la base de datos
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
@set_time_limit(300);

// Asegurar que se resuelva 'config/constants.php' desde la raíz
set_include_path(dirname(__DIR__) . PATH_SEPARATOR . get_include_path());
require_once __DIR__ . '/../config/database.php';

if (!isset($conecction) || !$conecction || $conecction->connect_error) {
    die("Error al conectar a la base de datos: " . ($conecction->connect_error ?? 'Desconocido'));
}

$conecction->set_charset('utf8mb4');

$db_name = DB_NAME;
$filename = "respaldo_bd_{$db_name}_" . date('Ymd_His') . ".sql";

// Si se ejecuta en navegador y no se pasa parámetro view=1, forzar descarga como archivo .sql
$is_cli = (php_sapi_name() === 'cli');
$view_mode = isset($_GET['view']) && $_GET['view'] == '1';

if (!$is_cli && !$view_mode) {
    header('Content-Type: application/sql; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');
} elseif (!$is_cli && $view_mode) {
    header('Content-Type: text/plain; charset=utf-8');
}

$output = "";
$output .= "-- ==========================================================\n";
$output .= "-- RESPALDO COMPLETO DE BASE DE DATOS: {$db_name}\n";
$output .= "-- Generado el: " . date('Y-m-d H:i:s') . "\n";
$output .= "-- Servidor MySQL: " . $conecction->server_info . "\n";
$output .= "-- Host: " . DB_HOST . "\n";
$output .= "-- ==========================================================\n\n";
$output .= "SET NAMES utf8mb4;\n";
$output .= "SET FOREIGN_KEY_CHECKS = 0;\n";
$output .= "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n\n";

if ($is_cli) {
    $filepath = __DIR__ . '/' . $filename;
    file_put_contents($filepath, $output);
} else {
    echo $output;
}

// Obtener todas las tablas
$tables_res = $conecction->query("SHOW FULL TABLES WHERE Table_type = 'BASE TABLE'");
$tables = [];
if ($tables_res) {
    while ($row = $tables_res->fetch_array()) {
        $tables[] = $row[0];
    }
}

foreach ($tables as $table) {
    $tbl_output = "";
    $tbl_output .= "-- ----------------------------------------------------------\n";
    $tbl_output .= "-- Estructura y datos de la tabla `{$table}`\n";
    $tbl_output .= "-- ----------------------------------------------------------\n";
    $tbl_output .= "DROP TABLE IF EXISTS `{$table}`;\n";

    // Create table
    $create_res = $conecction->query("SHOW CREATE TABLE `{$table}`");
    if ($create_res && $create_row = $create_res->fetch_array()) {
        $tbl_output .= $create_row[1] . ";\n\n";
    }

    // Insert rows
    $rows_res = $conecction->query("SELECT * FROM `{$table}`");
    if ($rows_res && $rows_res->num_rows > 0) {
        $num_fields = $rows_res->field_count;
        $fields_info = $rows_res->fetch_fields();

        $tbl_output .= "INSERT INTO `{$table}` VALUES\n";
        $first_row = true;

        while ($row = $rows_res->fetch_array(MYSQLI_NUM)) {
            if (!$first_row) {
                $tbl_output .= ",\n";
            }
            $tbl_output .= "(";
            for ($i = 0; $i < $num_fields; $i++) {
                if (is_null($row[$i])) {
                    $tbl_output .= "NULL";
                } elseif (is_numeric($row[$i]) && $fields_info[$i]->type != MYSQLI_TYPE_STRING && $fields_info[$i]->type != MYSQLI_TYPE_VAR_STRING) {
                    $tbl_output .= $row[$i];
                } else {
                    $escaped = $conecction->real_escape_string($row[$i]);
                    $tbl_output .= "'" . $escaped . "'";
                }
                if ($i < ($num_fields - 1)) {
                    $tbl_output .= ", ";
                }
            }
            $tbl_output .= ")";
            $first_row = false;
        }
        $tbl_output .= ";\n\n";
    }

    if ($is_cli) {
        file_put_contents($filepath, $tbl_output, FILE_APPEND);
    } else {
        echo $tbl_output;
    }
}

$footer = "SET FOREIGN_KEY_CHECKS = 1;\n";
$footer .= "-- Fin del respaldo\n";

if ($is_cli) {
    file_put_contents($filepath, $footer, FILE_APPEND);
    echo "[OK] Respaldo generado con éxito: $filepath (" . filesize($filepath) . " bytes)\n";
} else {
    echo $footer;
}

