<?php
require_once __DIR__ . '/builder_java.php';
require_once __DIR__ . '/builder_cobol.php';

$java_questions = get_java_bank();
$cobol_questions = get_cobol_bank();

function validate_questions($name, $questions, $topic1, $topic2, $ratio1) {
    echo "--- Validando $name ---\n";
    $count_topic1 = 0;
    $count_topic2 = 0;
    $violates_length = 0;

    foreach ($questions as $idx => $q) {
        // Topic ratio
        $is_topic1 = false;
        if (stripos($q['pregunta'], $topic1) !== false || (isset($q['tema']) && stripos($q['tema'], $topic1) !== false)) {
            $is_topic1 = true;
        }
        
        $is_topic2 = false;
        if (stripos($q['pregunta'], $topic2) !== false || (isset($q['tema']) && stripos($q['tema'], $topic2) !== false)) {
            $is_topic2 = true;
        }

        // Just use 'tema' if available, otherwise heuristic
        if (isset($q['tema'])) {
            if (strtolower($q['tema']) === strtolower($topic1)) $count_topic1++;
            elseif (strtolower($q['tema']) === strtolower($topic2)) $count_topic2++;
            else {
                // heuristic
                if (stripos($q['pregunta'], $topic2) !== false) $count_topic2++;
                else $count_topic1++;
            }
        } else {
             if (stripos($q['pregunta'], $topic2) !== false) $count_topic2++;
             else $count_topic1++;
        }

        // Check lengths
        $q_len = mb_strlen($q['pregunta'], 'UTF-8');
        $opts = ['A' => $q['opcion_a'], 'B' => $q['opcion_b'], 'C' => $q['opcion_c'], 'D' => $q['opcion_d']];
        $opts_len = true;
        foreach($opts as $k => $v) {
            if (mb_strlen($v, 'UTF-8') > 90) {
                $opts_len = false;
            }
        }

        if ($q_len > 100 || !$opts_len) {
            $violates_length++;
            echo "Viola longitud: Q#$idx - Q:$q_len chars. Respuestas > 90? " . ($opts_len ? 'No' : 'Si') . "\n";
        }
    }

    $total = count($questions);
    echo "Total preguntas: $total\n";
    echo "$topic1 count: $count_topic1 (" . round($count_topic1 / $total * 100) . "%)\n";
    echo "$topic2 count: $count_topic2 (" . round($count_topic2 / $total * 100) . "%)\n";
    echo "Violan longitud: $violates_length\n\n";
}

validate_questions("JAVA", $java_questions, "java", "spring", 0.7);
validate_questions("COBOL", $cobol_questions, "cobol", "jcl", 0.7);
