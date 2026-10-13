<?php
$files = [
    'java' => __DIR__ . '/../data/java_preguntas.php',
    'cobol' => __DIR__ . '/../data/cobol_preguntas.php',
    'react' => __DIR__ . '/../data/react_preguntas.php',
    'informix' => __DIR__ . '/../data/informix_preguntas.php',
    'cloud_ia' => __DIR__ . '/../data/cloud_ia_preguntas.php'
];

foreach ($files as $name => $path) {
    $data = include $path;
    $anomalies = 0;
    foreach ($data as $i => $q) {
        $c = $q['respuesta_correcta'];
        $lens = [
            'A' => mb_strlen($q['opcion_a'], 'UTF-8'),
            'B' => mb_strlen($q['opcion_b'], 'UTF-8'),
            'C' => mb_strlen($q['opcion_c'], 'UTF-8'),
            'D' => mb_strlen($q['opcion_d'], 'UTF-8'),
        ];
        $cLen = $lens[$c];
        unset($lens[$c]);
        $avgOthers = array_sum($lens) / 3;

        // Anomaly: correct answer is significantly longer than distractors
        if ($cLen > $avgOthers * 1.6 && $cLen > 50) {
            $anomalies++;
        }
    }
    echo "[$name] Total preguntas: " . count($data) . " | Anomalías de longitud en respuesta correcta: $anomalies / 100\n";
}
