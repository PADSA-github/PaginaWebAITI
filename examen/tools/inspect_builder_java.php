<?php
require_once __DIR__ . '/builder_java.php';
$b_qs = get_java_bank();

echo "Builder has " . count($b_qs) . " questions.\n";

$by_comp = [];
$counts = ['A'=>0,'B'=>0,'C'=>0,'D'=>0];
foreach ($b_qs as $q) {
    $by_comp[$q['complejidad']] = ($by_comp[$q['complejidad']] ?? 0) + 1;
    $counts[$q['respuesta_correcta']] = ($counts[$q['respuesta_correcta']] ?? 0) + 1;
}
echo "Complejidad: " . json_encode($by_comp) . "\n";
echo "Respuestas: " . json_encode($counts) . "\n";
