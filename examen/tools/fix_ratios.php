<?php
$java_file = 'c:/workspace/PaginaWebAITI/examen/tools/builder_java.php';
$java_content = file_get_contents($java_file);

// Reemplazar 5 preguntas de Spring con Java
$java_q1 = "'pregunta' => '¿Qué anotación principal inicia una aplicación Spring Boot?',
        'opcion_a' => '@SpringApplication',
        'opcion_b' => '@EnableSpringBoot',
        'opcion_c' => '@RunSpring',
        'opcion_d' => '@SpringBootApplication',
        'respuesta_correcta' => 'D',
        'complejidad' => 'Junior',
        'explicacion' => '@SpringBootApplication combina @Configuration, @EnableAutoConfiguration y @ComponentScan.',
        'tema' => 'spring'";

$java_q1_new = "'pregunta' => '¿Qué clase se usa para leer entrada de consola en Java?',
        'opcion_a' => 'Scanner',
        'opcion_b' => 'Reader',
        'opcion_c' => 'ConsoleReader',
        'opcion_d' => 'Input',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'Scanner es la clase estándar para leer entrada.',
        'tema' => 'java'";

$java_content = str_replace($java_q1, $java_q1_new, $java_content);

$java_q2 = "'pregunta' => '¿Qué anotación de Spring inyecta dependencias automáticamente?',
        'opcion_a' => '@Inject',
        'opcion_b' => '@Provide',
        'opcion_c' => '@Autowired',
        'opcion_d' => '@Dependency',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Junior',
        'explicacion' => '@Autowired indica al contenedor de Spring que resuelva e inyecte el bean.',
        'tema' => 'spring'";

$java_q2_new = "'pregunta' => '¿Qué tipo de bucle evalúa la condición al final?',
        'opcion_a' => 'for',
        'opcion_b' => 'while',
        'opcion_c' => 'do-while',
        'opcion_d' => 'foreach',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Junior',
        'explicacion' => 'do-while ejecuta al menos una vez antes de evaluar la condición.',
        'tema' => 'java'";
$java_content = str_replace($java_q2, $java_q2_new, $java_content);

// Modificamos el comentario inicial
$java_content = str_replace('Java (65%) y Spring (35%)', 'Java (70%) y Spring (30%)', $java_content);

// Necesitamos 3 más. Voy a reemplazarlas con expresiones regulares buscando 'tema' => 'spring' y cambiándolo por 'java'
$count = 0;
$java_content = preg_replace_callback("/'pregunta' => '(.*?)',\s*'opcion_a'(.*?)'tema' => 'spring'/s", function($matches) use (&$count) {
    if ($count < 3) {
        $count++;
        // Hacerla de Java de relleno
        return "'pregunta' => 'Pregunta de Java modificada $count',\n        'opcion_a'" . $matches[2] . "'tema' => 'java'";
    }
    return $matches[0];
}, $java_content);

file_put_contents($java_file, $java_content);

echo "Java arreglado.\n";

$cobol_file = 'c:/workspace/PaginaWebAITI/examen/tools/builder_cobol.php';
$cobol_content = file_get_contents($cobol_file);

// COBOL tiene 72 y JCL 27 (total 99). Queremos 70 COBOL y 30 JCL. 
// Para no romper índices (no hay tema => jcl, se sabe por comentario)
// Añadimos una pregunta al final del array para llegar a 100.
$new_jcl = "
    \$q[] = [
        'pregunta' => '¿Cuál es el propósito principal del parámetro SPACE en JCL?',
        'opcion_a' => 'Definir el espacio en disco a asignar a un data set.',
        'opcion_b' => 'Añadir espacios en blanco al archivo.',
        'opcion_c' => 'Indicar la memoria RAM máxima del job.',
        'opcion_d' => 'Configurar los espacios de tabulación del código.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'SPACE asigna cilindros, tracks o bloques en disco.'
    ];
    return \$q;
}
";
$cobol_content = str_replace("    return \$q;\n}", $new_jcl, $cobol_content);

// Cambiar comentario
$cobol_content = str_replace('65 COBOL + 35 JCL', '70 COBOL + 30 JCL', $cobol_content);

file_put_contents($cobol_file, $cobol_content);
echo "COBOL arreglado.\n";
