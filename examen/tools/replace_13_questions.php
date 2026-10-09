<?php
$file = 'c:/workspace/PaginaWebAITI/examen/tools/builder_java.php';
$content = file_get_contents($file);

$replacements = [
    "¿Cómo mitiga el patrón Builder la complejidad de constructores con muchos parámetros?" => [
        "pregunta" => "¿Qué patrón de diseño restringe la instanciación de una clase a un solo objeto?",
        "A" => "Factory", "B" => "Singleton", "C" => "Observer", "D" => "Decorator", "ans" => "B", "expl" => "Singleton garantiza una única instancia en toda la aplicación."
    ],
    "¿Qué papel cumple ReentrantLock frente al bloque synchronized tradicional?" => [
        "pregunta" => "¿Qué palabra clave se usa para evitar que una variable sea cacheada por los hilos?",
        "A" => "static", "B" => "volatile", "C" => "transient", "D" => "synchronized", "ans" => "B", "expl" => "Volatile obliga a leer y escribir la variable directamente en memoria principal."
    ],
    "¿Por qué se deben cerrar conexiones, statements y result sets en JDBC?" => [
        "pregunta" => "¿Qué método de la interfaz Connection confirma una transacción en JDBC?",
        "A" => "commit()", "B" => "save()", "C" => "execute()", "D" => "flush()", "ans" => "A", "expl" => "commit() consolida los cambios en la base de datos."
    ],
    "¿Qué técnica permite ejecutar pruebas unitarias aislando dependencias externas?" => [
        "pregunta" => "¿Qué anotación de JUnit 5 indica que un método es una prueba?",
        "A" => "@Test", "B" => "@TestCase", "C" => "@Run", "D" => "@Check", "ans" => "A", "expl" => "@Test marca el método para que el runner lo ejecute."
    ],
    "¿Qué afirma el principio de Inversión de Dependencias (DIP) de SOLID?" => [
        "pregunta" => "¿Qué letra de SOLID promueve interfaces pequeñas y específicas?",
        "A" => "S", "B" => "O", "C" => "I", "D" => "D", "ans" => "C", "expl" => "La I corresponde al Principio de Segregación de Interfaces (ISP)."
    ],
    "¿Qué método de ExecutorService detiene ordenadamente la aceptación de nuevas tareas?" => [
        "pregunta" => "¿Qué estructura de datos usa ThreadPoolExecutor para encolar tareas?",
        "A" => "Stack", "B" => "BlockingQueue", "C" => "HashSet", "D" => "Vector", "ans" => "B", "expl" => "Usa BlockingQueue para manejar hilos de manera segura."
    ],
    "¿Qué buena práctica de logging se debe seguir en sistemas de alta concurrencia?" => [
        "pregunta" => "¿Qué nivel de log en SLF4J es el más detallado?",
        "A" => "INFO", "B" => "DEBUG", "C" => "TRACE", "D" => "ERROR", "ans" => "C", "expl" => "TRACE proporciona el nivel más bajo de detalle en logs."
    ],
    "¿Por qué @Transactional puede fallar si se invoca desde la misma clase (this)?" => [
        "pregunta" => "¿Qué scope de bean de Spring crea una nueva instancia por cada inyección?",
        "A" => "Singleton", "B" => "Prototype", "C" => "Request", "D" => "Session", "ans" => "B", "expl" => "Prototype genera un nuevo objeto cada vez que se solicita."
    ],
    "¿Cuál es el rol de SecurityFilterChain en la configuración de Spring Security 6?" => [
        "pregunta" => "¿Qué interfaz principal gestiona usuarios en Spring Security?",
        "A" => "UserDetailsService", "B" => "AuthManager", "C" => "SecurityUser", "D" => "Principal", "ans" => "A", "expl" => "UserDetailsService carga datos del usuario para autenticación."
    ],
    "¿Qué optimización aporta @Transactional(readOnly = true) con Hibernate?" => [
        "pregunta" => "¿Qué módulo de Spring Boot facilita monitorear la salud de la app?",
        "A" => "Actuator", "B" => "Monitor", "C" => "DevTools", "D" => "Admin", "ans" => "A", "expl" => "Spring Boot Actuator expone endpoints de métricas y estado."
    ],
    "¿Para qué sirve el parámetro rollbackFor en la anotación @Transactional?" => [
        "pregunta" => "¿Qué anotación inyecta valores desde properties en Spring?",
        "A" => "@Value", "B" => "@Property", "C" => "@Inject", "D" => "@Config", "ans" => "A", "expl" => "@Value inyecta propiedades directamente a variables."
    ],
    "¿Cuál es la función del filtro CSRF habilitado por defecto en Spring Security?" => [
        "pregunta" => "¿Qué algoritmo de hash recomienda Spring Security para contraseñas?",
        "A" => "MD5", "B" => "SHA1", "C" => "BCrypt", "D" => "AES", "ans" => "C", "expl" => "BCryptPasswordEncoder es el estándar seguro por defecto."
    ],
    "¿Cómo se evitan dependencias circulares entre dos beans colaboradores en Spring?" => [
        "pregunta" => "¿Qué anotación de Spring define controladores RESTful?",
        "A" => "@Controller", "B" => "@RestController", "C" => "@Web", "D" => "@Api", "ans" => "B", "expl" => "@RestController combina @Controller y @ResponseBody."
    ]
];

$replaced = 0;
foreach ($replacements as $old_q => $new_data) {
    // Find the whole array element that contains the old question text
    // Assuming structure:
    //    $q[] = [
    //        'pregunta' => 'old_q',
    //        ...
    //    ];
    $pattern = "/\\\$q\[\]\s*=\s*\[\s*'pregunta'\s*=>\s*'" . preg_quote($old_q, '/') . "'.*?\];/is";
    
    // Construct new array element
    $new_element = "\$q[] = [\n" .
        "        'pregunta' => '" . $new_data['pregunta'] . "',\n" .
        "        'opcion_a' => '" . $new_data['A'] . "',\n" .
        "        'opcion_b' => '" . $new_data['B'] . "',\n" .
        "        'opcion_c' => '" . $new_data['C'] . "',\n" .
        "        'opcion_d' => '" . $new_data['D'] . "',\n" .
        "        'respuesta_correcta' => '" . $new_data['ans'] . "',\n" .
        "        'complejidad' => 'Senior',\n" . // Just preserving structure loosely
        "        'explicacion' => '" . $new_data['expl'] . "',\n" .
        "        'tema' => 'java'\n" .
        "    ];";
    
    $content = preg_replace($pattern, $new_element, $content, -1, $count);
    $replaced += $count;
}

file_put_contents($file, $content);
echo "Reemplazados $replaced bloques.\n";
