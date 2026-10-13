<?php
// Equalizer script to ensure all 4 options in every question have comparable technical detail and length
header('Content-Type: text/plain; charset=utf-8');

$files = [
    'java'     => __DIR__ . '/../data/java_preguntas.php',
    'cobol'    => __DIR__ . '/../data/cobol_preguntas.php',
    'react'    => __DIR__ . '/../data/react_preguntas.php',
    'informix' => __DIR__ . '/../data/informix_preguntas.php',
    'cloud_ia' => __DIR__ . '/../data/cloud_ia_preguntas.php'
];

// Contextual expansions per technology domain to make distractors plausible and balanced
$domain_qualifiers = [
    'cloud_ia' => [
        'en entornos de producción con alta concurrencia y tolerancia a fallos.',
        'mediante la orquestación distribuida de microservicios en clústeres de cómputo.',
        'a través de políticas de control de acceso y cifrado gestionado en la nube.',
        'optimizando los tiempos de respuesta y reduciendo la sobrecarga de ancho de banda.',
        'para garantizar el cumplimiento de normativas de seguridad y gobernanza empresarial.',
        'en arquitecturas de almacenamiento persistente orientadas a eventos y mensajería.',
        'sincronizando los flujos de trabajo asíncronos en canalizaciones de datos por lotes.',
        'mediante la gestión desacoplada de dependencias e interfaces de programación de aplicaciones.'
    ],
    'informix' => [
        'en transacciones distribuidas con niveles estrictos de aislamiento y control de bloqueos.',
        'optimizando el rendimiento de las operaciones de entrada y salida en disco DASD.',
        'garantizando la integridad referencial en entornos relacionales de alta transaccionalidad.',
        'para coordinar el acceso concurrente de múltiples sesiones en el motor de base de datos.',
        'mediante la asignación dinámica de recursos en la memoria compartida de la instancia.',
        'asegurando la coherencia de los datos en la tabla del catálogo durante el procesamiento batch.',
        'en combinación con directivas de optimización del compilador y precompilador SQL.',
        'manejando los estados de error y excepciones en los procedimientos almacenados de sistema.'
    ],
    'cobol' => [
        'durante la ejecución de trabajos batch de alto volumen en el sistema operativo z/OS.',
        'para coordinar el paso de parámetros y la disposición de datasets en el subsistema JES.',
        'garantizando la persistencia de registros y la coherencia en archivos indexados de gran escala.',
        'en regiones transaccionales de CICS para optimizar el uso de memoria de los terminales.',
        'asegurando la integridad de las operaciones de entrada y salida en el catálogo maestro.',
        'mediante la evaluación de códigos de retorno y condiciones de error en pasos posteriores.',
        'optimizando el aprovechamiento de cilindros y pistas en unidades de almacenamiento directo.',
        'para permitir el procesamiento secuencial ininterrumpido sin bloqueos de contención de datos.'
    ],
    'react' => [
        'manteniendo la coherencia del estado inmutable a lo largo de los ciclos de reconciliación.',
        'optimizando los tiempos de pintura y reduciendo el trabajo síncrono en el hilo principal.',
        'para prevenir re-renderizados innecesarios y garantizar una experiencia de usuario fluida.',
        'desacoplando la lógica de negocio de la capa de presentación visual del componente.',
        'asegurando la compatibilidad con el renderizado concurrente y la hidratación progresiva.',
        'mediante la gestión estructurada del árbol de nodos y la propagación de eventos sintéticos.',
        'facilitando la reutilización de código y la modularidad en arquitecturas web a gran escala.',
        'para evitar discrepancias entre el árbol generado en el servidor y el cliente navegador.'
    ],
    'java' => [
        'garantizando la seguridad de tipos y la coherencia en la memoria compartida de la JVM.',
        'optimizando la recolección de basura y evitando bloqueos innecesarios entre hilos.',
        'en arquitecturas empresariales basadas en microservicios y contenedor de inversión de control.',
        'para asegurar transacciones atómicas y aislamiento de datos en la capa de persistencia.',
        'mediante la delegación de responsabilidades a proxies dinámicos y componentes gestionados.',
        'permitiendo el procesamiento asíncrono no bloqueante con alto rendimiento computacional.'
    ]
];

foreach ($files as $name => $path) {
    $questions = include $path;
    $modified = 0;
    $qualifiers = $domain_qualifiers[$name] ?? $domain_qualifiers['java'];
    $qCount = count($qualifiers);

    foreach ($questions as $idx => &$q) {
        $c = $q['respuesta_correcta'];
        $cKey = 'opcion_' . strtolower($c);
        $cLen = mb_strlen($q[$cKey], 'UTF-8');

        // Check if any distractor is too short compared to the correct answer
        $distractorKeys = array_diff(['a', 'b', 'c', 'd'], [strtolower($c)]);
        $otherLens = [];
        foreach ($distractorKeys as $k) {
            $otherLens[$k] = mb_strlen($q['opcion_' . $k], 'UTF-8');
        }
        $avgOther = array_sum($otherLens) / 3;

        if ($cLen > $avgOther * 1.55 && $cLen > 50) {
            $modified++;
            // Expand distractors that are shorter than 75% of the correct answer
            foreach ($distractorKeys as $k) {
                $curOpt = rtrim(trim($q['opcion_' . $k]), '.');
                $curOptLen = mb_strlen($curOpt, 'UTF-8');
                if ($curOptLen < $cLen * 0.75) {
                    $qual = $qualifiers[($idx + ord($k)) % $qCount];
                    // Append qualifier smoothly
                    if (mb_substr($curOpt, -1) !== ',') {
                        $curOpt .= ', ' . $qual;
                    } else {
                        $curOpt .= ' ' . $qual;
                    }
                    $q['opcion_' . $k] = $curOpt;
                }
            }
        }
    }
    unset($q);

    if ($modified > 0) {
        $exportContent = "<?php\n// Banco de 100 Preguntas Balanceadas de " . strtoupper($name) . "\n// Balance estricto de opciones y longitudes para evaluación técnica\n\nreturn " . var_export($questions, true) . ";\n";
        file_put_contents($path, $exportContent);
        echo "[$name] $modified preguntas equilibradas y guardadas.\n";
    } else {
        echo "[$name] Ya se encuentra perfectamente equilibrado.\n";
    }
}

echo "Proceso de ecualización concluido.\n";
