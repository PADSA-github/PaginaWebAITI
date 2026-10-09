<?php
require_once __DIR__ . '/builder_java.php';
$java_questions = get_java_bank();

$out = [];
foreach ($java_questions as $idx => $q) {
    $q_len = mb_strlen($q['pregunta'], 'UTF-8');
    
    $opts = [
        'A' => mb_strlen($q['opcion_a'], 'UTF-8'),
        'B' => mb_strlen($q['opcion_b'], 'UTF-8'),
        'C' => mb_strlen($q['opcion_c'], 'UTF-8'),
        'D' => mb_strlen($q['opcion_d'], 'UTF-8')
    ];
    $exp_len = mb_strlen($q['explicacion'], 'UTF-8');
    
    $violation = false;
    $msg = "Q#" . ($idx) . " ";
    
    if ($q_len > 100) {
        $violation = true;
        $msg .= "[PREGUNTA: $q_len] ";
    }
    
    foreach ($opts as $k => $v) {
        if ($v > 90) {
            $violation = true;
            $msg .= "[OP_$k: $v] ";
        }
    }

    if ($exp_len > 90) {
        $violation = true;
        $msg .= "[EXPL: $exp_len] ";
    }
    
    if ($violation) {
        $out[] = $msg . "\nTexto P: " . $q['pregunta'];
    }
}

if (count($out) === 0) {
    echo "TODO ESTA CORRECTO.\n";
} else {
    echo "SE ENCONTRARON " . count($out) . " VIOLACIONES:\n";
    echo implode("\n\n", $out);
}
