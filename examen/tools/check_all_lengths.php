<?php
require_once __DIR__ . '/builder_cobol.php';
require_once __DIR__ . '/builder_react.php';
require_once __DIR__ . '/builder_informix.php';
require_once __DIR__ . '/builder_cloud_ia.php';

$banks = [
    'COBOL' => get_cobol_bank(),
    'REACT' => get_react_bank(),
    'INFORMIX' => get_informix_bank(),
    'CLOUD_IA' => get_cloud_ia_bank()
];

foreach ($banks as $name => $questions) {
    echo "--- Revisando $name ---\n";
    echo "Total preguntas: " . count($questions) . "\n";
    
    $out = [];
    foreach ($questions as $idx => $q) {
        $q_len = mb_strlen($q['pregunta'], 'UTF-8');
        
        $opts = [
            'A' => mb_strlen($q['opcion_a'], 'UTF-8'),
            'B' => mb_strlen($q['opcion_b'], 'UTF-8'),
            'C' => mb_strlen($q['opcion_c'], 'UTF-8'),
            'D' => mb_strlen($q['opcion_d'], 'UTF-8')
        ];
        // handle case where 'explicacion' might be missing in some builders
        $exp_len = isset($q['explicacion']) ? mb_strlen($q['explicacion'], 'UTF-8') : 0;
        
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
        echo "Validación de longitud: CORRECTA (0 violaciones).\n\n";
    } else {
        echo "Validación de longitud: SE ENCONTRARON " . count($out) . " VIOLACIONES:\n";
        echo implode("\n", $out) . "\n\n";
    }
}
