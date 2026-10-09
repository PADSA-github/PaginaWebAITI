<?php
// Script de compilación, balanceo estricto e instalación de los 5 Bancos de Preguntas
header('Content-Type: text/plain; charset=utf-8');

require_once __DIR__ . '/builder_java.php';
require_once __DIR__ . '/builder_cobol.php';
require_once __DIR__ . '/builder_react.php';
require_once __DIR__ . '/builder_informix.php';
require_once __DIR__ . '/builder_cloud_ia.php';

$banks = [
    'java' => get_java_bank(),
    'cobol' => get_cobol_bank(),
    'react' => get_react_bank(),
    'informix' => get_informix_bank(),
    'cloud_ia' => get_cloud_ia_bank()
];

$targets = ['A', 'B', 'C', 'D'];

foreach ($banks as $key => &$questions) {
    echo "========================================================\n";
    echo "PROCESANDO BANCO: $key (Total preguntas recibidas: " . count($questions) . ")\n";
    
    if (count($questions) !== 100) {
        die("[ERROR CRITICO] El banco $key no tiene exactamente 100 preguntas.\n");
    }

    $counts = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0];
    $complexities = ['Junior' => 0, 'Semi-Senior' => 0, 'Senior' => 0];

    foreach ($questions as $idx => &$q) {
        $desiredLetter = $targets[$idx % 4];
        $currentLetter = strtoupper(trim($q['respuesta_correcta']));

        if ($currentLetter !== $desiredLetter) {
            $curKey = 'opcion_' . strtolower($currentLetter);
            $desKey = 'opcion_' . strtolower($desiredLetter);

            // Swap the correct answer option text to the desired target slot
            $temp = $q[$desKey];
            $q[$desKey] = $q[$curKey];
            $q[$curKey] = $temp;

            $q['respuesta_correcta'] = $desiredLetter;
        }

        $counts[$q['respuesta_correcta']]++;
        if (isset($complexities[$q['complejidad']])) {
            $complexities[$q['complejidad']]++;
        }

        // Validate lengths
        $lens = [
            'A' => mb_strlen($q['opcion_a'], 'UTF-8'),
            'B' => mb_strlen($q['opcion_b'], 'UTF-8'),
            'C' => mb_strlen($q['opcion_c'], 'UTF-8'),
            'D' => mb_strlen($q['opcion_d'], 'UTF-8'),
        ];
        $corrLen = $lens[$q['respuesta_correcta']];
        unset($lens[$q['respuesta_correcta']]);
        $avgDistractors = array_sum($lens) / 3;

        if ($corrLen > $avgDistractors * 2.0 && $corrLen > 60) {
            echo "  [ADVERTENCIA LONGITUD #$idx] Correcta {$q['respuesta_correcta']} (len $corrLen vs avg dist " . round($avgDistractors, 1) . ")\n";
        }
    }
    unset($q);

    echo "Distribución de respuestas ($key): " . json_encode($counts) . "\n";
    echo "Distribución de complejidad ($key): " . json_encode($complexities) . "\n";

    // Exportar archivo formateado a examen/data/{key}_preguntas.php
    $targetPath = __DIR__ . '/../data/' . $key . '_preguntas.php';
    $exportContent = "<?php\n// Banco de 100 Preguntas Balanceadas de " . strtoupper($key) . "\n// Generado automáticamente con opciones equivalentes y balance A:25, B:25, C:25, D:25\n\nreturn " . var_export($questions, true) . ";\n";
    file_put_contents($targetPath, $exportContent);
    echo "[OK] Archivo guardado con éxito en: $targetPath\n";
}
unset($questions);

echo "\nTodos los 5 bancos procesados y exportados exitosamente.\n";
