<?php
// Banco de 100 Preguntas de Java (25 Junior, 25 Semi-Senior, 25 Senior, 25 Experto)

return [
    // ==========================================
    // NIVEL JUNIOR (25 PREGUNTAS)
    // ==========================================
    [
        'pregunta' => '¿Cuál de los siguientes NO es un tipo de dato primitivo en Java?',
        'opcion_a' => 'int',
        'opcion_b' => 'boolean',
        'opcion_c' => 'String',
        'opcion_d' => 'char',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Junior',
        'explicacion' => 'String es una clase de objeto en java.lang, no un tipo de dato primitivo.'
    ],
    [
        'pregunta' => '¿Cuál es el valor por defecto de una variable booleana como atributo de clase en Java?',
        'opcion_a' => 'true',
        'opcion_b' => 'false',
        'opcion_c' => 'null',
        'opcion_d' => '0',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => 'Los atributos primitivos booleanos en Java se inicializan por defecto en false.'
    ],
    [
        'pregunta' => '¿Qué palabra reservada se utiliza para heredar una clase en Java?',
        'opcion_a' => 'implements',
        'opcion_b' => 'inherits',
        'opcion_c' => 'extends',
        'opcion_d' => 'super',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Junior',
        'explicacion' => 'La palabra reservada extends se utiliza para la herencia de clases, mientras que implements es para interfaces.'
    ],
    [
        'pregunta' => '¿Cuál es el punto de entrada estándar para ejecutar una aplicación Java?',
        'opcion_a' => 'public void main(String args[])',
        'opcion_b' => 'public static void main(String[] args)',
        'opcion_c' => 'static void start(String[] args)',
        'opcion_d' => 'public static int main(String[] args)',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => 'La firma estándar requerida por la JVM es public static void main(String[] args).'
    ],
    [
        'pregunta' => '¿Qué operador se utiliza para comparar la igualdad de valores entre dos tipos primitivos en Java?',
        'opcion_a' => 'equals()',
        'opcion_b' => '=',
        'opcion_c' => '==',
        'opcion_d' => '===',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Junior',
        'explicacion' => 'El operador == compara valores en tipos primitivos y referencias de memoria en objetos.'
    ],
    [
        'pregunta' => '¿Cuál es la diferencia principal entre float y double en Java?',
        'opcion_a' => 'float es de 64 bits y double es de 32 bits',
        'opcion_b' => 'float es de 32 bits y double es de 64 bits',
        'opcion_c' => 'float almacena solo números enteros y double decimales',
        'opcion_d' => 'No hay diferencia en tamaño de memoria',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => 'float es de precisión simple (32 bits) y double es de doble precisión (64 bits).'
    ],
    [
        'pregunta' => '¿Qué estructura de control se utiliza para iterar sobre los elementos de un array o colección en Java?',
        'opcion_a' => 'switch',
        'opcion_b' => 'try-catch',
        'opcion_c' => 'for-each / for extendido',
        'opcion_d' => 'synchronized',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Junior',
        'explicacion' => 'El bucle for (Tipo elem : coleccion) permite recorrer arrays y colecciones de manera limpia.'
    ],
    [
        'pregunta' => '¿Qué palabra reservada impide que una clase sea heredada o que un método sea sobrescrito?',
        'opcion_a' => 'static',
        'opcion_b' => 'abstract',
        'opcion_c' => 'final',
        'opcion_d' => 'const',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Junior',
        'explicacion' => 'final en una clase evita que sea extendida; en un método evita que sea sobrescrito; en una variable la hace constante.'
    ],
    [
        'pregunta' => '¿Cuál es el modificador de acceso más restrictivo en Java?',
        'opcion_a' => 'public',
        'opcion_b' => 'protected',
        'opcion_c' => 'default (package-private)',
        'opcion_d' => 'private',
        'respuesta_correcta' => 'D',
        'complejidad' => 'Junior',
        'explicacion' => 'private restringe la visibilidad exclusivamente al ámbito de la propia clase donde se declara.'
    ],
    [
        'pregunta' => '¿Cómo se manejan excepciones en tiempo de ejecución en Java?',
        'opcion_a' => 'Bloques if - else',
        'opcion_b' => 'Bloques try - catch - finally',
        'opcion_c' => 'Instrucción check - error',
        'opcion_d' => 'Palabra reservada handle',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => 'try captura código propenso a fallos, catch maneja la excepción y finally se ejecuta siempre.'
    ],
    [
        'pregunta' => '¿Qué clase base heredan implícitamente todas las clases en Java?',
        'opcion_a' => 'java.lang.Class',
        'opcion_b' => 'java.lang.Object',
        'opcion_c' => 'java.lang.System',
        'opcion_d' => 'java.util.Root',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => 'java.lang.Object es la raíz de la jerarquía de clases en Java.'
    ],
    [
        'pregunta' => '¿Qué método se usa para convertir un String numérico como "123" a int primitivo?',
        'opcion_a' => 'Integer.parseInt("123")',
        'opcion_b' => 'Integer.toString("123")',
        'opcion_c' => 'String.toInt("123")',
        'opcion_d' => '(int) "123"',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'Integer.parseInt() es el método estático que parsea una cadena a un entero primitivo.'
    ],
    [
        'pregunta' => '¿Qué sucede si intentas acceder al índice 5 en un array de 5 elementos en Java?',
        'opcion_a' => 'Retorna null',
        'opcion_b' => 'Retorna 0',
        'opcion_c' => 'Lanza ArrayIndexOutOfBoundsException',
        'opcion_d' => 'El array se expande automáticamente',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Junior',
        'explicacion' => 'Los arrays tienen base 0 (índices 0 a 4), por lo que el índice 5 está fuera de rango.'
    ],
    [
        'pregunta' => '¿Qué palabra clave se usa para crear una nueva instancia de una clase en Java?',
        'opcion_a' => 'create',
        'opcion_b' => 'alloc',
        'opcion_c' => 'new',
        'opcion_d' => 'make',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Junior',
        'explicacion' => 'El operador new reserva memoria dinámica e invoca al constructor de la clase.'
    ],
    [
        'pregunta' => '¿Cuál es la longitud fija de una variable de tipo byte en Java?',
        'opcion_a' => '4 bits',
        'opcion_b' => '8 bits (1 byte)',
        'opcion_c' => '16 bits',
        'opcion_d' => '32 bits',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => 'Un byte en Java es un entero con signo de 8 bits con rango de -128 a 127.'
    ],
    [
        'pregunta' => '¿Qué palabra reservada se usa para hacer referencia a la instancia actual de la clase?',
        'opcion_a' => 'self',
        'opcion_b' => 'this',
        'opcion_c' => 'current',
        'opcion_d' => 'base',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => 'this representa la referencia al objeto actual dentro de un método o constructor de instancia.'
    ],
    [
        'pregunta' => '¿Cuál de los siguientes métodos se invoca automáticamente al imprimir un objeto con System.out.println(obj)?',
        'opcion_a' => 'toPrint()',
        'opcion_b' => 'dump()',
        'opcion_c' => 'toString()',
        'opcion_d' => 'format()',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Junior',
        'explicacion' => 'System.out.println invoca internamente String.valueOf(obj), que a su vez llama al método toString().'
    ],
    [
        'pregunta' => '¿Qué palabra clave se usa para invocar el constructor de la clase padre en una subclase?',
        'opcion_a' => 'parent()',
        'opcion_b' => 'super()',
        'opcion_c' => 'base()',
        'opcion_d' => 'this()',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => 'super() invoca al constructor de la superclase directa y debe ser la primera sentencia en el constructor.'
    ],
    [
        'pregunta' => '¿Cuál es el resultado de la expresión: 5 + 3 * 2 en Java?',
        'opcion_a' => '16',
        'opcion_b' => '11',
        'opcion_c' => '10',
        'opcion_d' => '13',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => 'Por precedencia de operadores, la multiplicación se evalúa primero: 3 * 2 = 6, luego 5 + 6 = 11.'
    ],
    [
        'pregunta' => '¿Qué característica define a una clase abstracta en Java?',
        'opcion_a' => 'No puede tener métodos implementados',
        'opcion_b' => 'No puede ser instanciada directamente con new',
        'opcion_c' => 'Solo puede tener variables estáticas',
        'opcion_d' => 'Todos sus métodos deben ser públicos',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => 'Una clase abstracta no se puede instanciar directamente; está diseñada para ser extendida por subclases.'
    ],
    [
        'pregunta' => '¿Cuál es la función del recolector de basura (Garbage Collector) en Java?',
        'opcion_a' => 'Eliminar código compilado obsoleto',
        'opcion_b' => 'Liberar memoria ocupada por objetos sin referencias activas',
        'opcion_c' => 'Verificar errores de sintaxis en tiempo de ejecución',
        'opcion_d' => 'Optimizar consultas a bases de datos',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => 'El Garbage Collector gestiona automáticamente la memoria heap recuperando espacio de objetos inalcanzables.'
    ],
    [
        'pregunta' => '¿Qué paquete de Java se importa automáticamente en todos los archivos sin necesidad de declaración import?',
        'opcion_a' => 'java.util',
        'opcion_b' => 'java.io',
        'opcion_c' => 'java.lang',
        'opcion_d' => 'java.net',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Junior',
        'explicacion' => 'java.lang contiene las clases fundamentales (Object, String, System, Math, etc.) y se importa por defecto.'
    ],
    [
        'pregunta' => '¿Qué palabra reservada se usa para definir un método que pertenece a la clase y no a instancias individuales?',
        'opcion_a' => 'global',
        'opcion_b' => 'static',
        'opcion_c' => 'shared',
        'opcion_d' => 'const',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => 'static asocia el miembro (método o variable) a la clase en lugar de requerir una instancia.'
    ],
    [
        'pregunta' => '¿Qué operador lógico representa el "O" (OR) de cortocircuito en Java?',
        'opcion_a' => '|',
        'opcion_b' => '||',
        'opcion_c' => 'or',
        'opcion_d' => '&&',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Junior',
        'explicacion' => '|| no evalúa la segunda expresión si la primera es verdadera (cortocircuito).'
    ],
    [
        'pregunta' => '¿Cómo se comenta una sola línea en código Java?',
        'opcion_a' => '# Comentario',
        'opcion_b' => '<!-- Comentario -->',
        'opcion_c' => '// Comentario',
        'opcion_d' => '-- Comentario',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Junior',
        'explicacion' => '// se utiliza para comentarios de una sola línea en Java.'
    ],

    // ==========================================
    // NIVEL SEMI-SENIOR (25 PREGUNTAS)
    // ==========================================
    [
        'pregunta' => '¿Cuál es la diferencia entre StringBuilder y StringBuffer en Java?',
        'opcion_a' => 'StringBuilder es inmutable y StringBuffer es mutable',
        'opcion_b' => 'StringBuffer es thread-safe (sincronizado) y StringBuilder no lo es',
        'opcion_c' => 'StringBuilder solo soporta caracteres ASCII',
        'opcion_d' => 'No hay ninguna diferencia técnica',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'StringBuffer tiene métodos sincronizados para seguridad en múltiples hilos, mientras que StringBuilder es más rápido en entornos mono-hilo.'
    ],
    [
        'pregunta' => '¿Cuál es la diferencia clave entre ArrayList y LinkedList en Java al insertar al inicio frecuentemente?',
        'opcion_a' => 'ArrayList es O(1) y LinkedList es O(N)',
        'opcion_b' => 'LinkedList es O(1) para insertar al inicio y ArrayList requiere desplazar elementos O(N)',
        'opcion_c' => 'ArrayList no permite inserción al inicio',
        'opcion_d' => 'Ambas tienen complejidad idéntica O(N)',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'LinkedList actualiza punteros de nodos en O(1), mientras que ArrayList debe desplazar todos los elementos hacia la derecha.'
    ],
    [
        'pregunta' => '¿Qué contrato debe cumplirse siempre al sobrescribir el método equals() en una clase en Java?',
        'opcion_a' => 'Sobrescribir también el método clone()',
        'opcion_b' => 'Sobrescribir también hashCode() de manera coherente',
        'opcion_c' => 'Hacer la clase Serializable',
        'opcion_d' => 'Declarar todos los atributos como final',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Si dos objetos son iguales según equals(), deben devolver obligatoriamente el mismo hashCode para no romper HashMap y HashSet.'
    ],
    [
        'pregunta' => '¿Qué tipo de excepción es NullPointerException en Java?',
        'opcion_a' => 'Checked Exception (verificada)',
        'opcion_b' => 'Unchecked Exception (hereda de RuntimeException)',
        'opcion_c' => 'Error de máquina virtual (hereda de Error)',
        'opcion_d' => 'Excepción fatal de compilación',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'NullPointerException hereda de RuntimeException, por lo que no es obligatorio declararla con throws ni capturarla en tiempo de compilación.'
    ],
    [
        'pregunta' => 'En la API de Streams de Java 8+, ¿cuál de las siguientes operaciones es una operación TERMINAL?',
        'opcion_a' => 'filter()',
        'opcion_b' => 'map()',
        'opcion_c' => 'collect()',
        'opcion_d' => 'distinct()',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'collect(), forEach(), reduce() y count() son terminales; filter(), map() y distinct() son intermedias perezosas (lazy).'
    ],
    [
        'pregunta' => '¿Qué es y para qué sirve una Interfaz Funcional (@FunctionalInterface) en Java?',
        'opcion_a' => 'Una interfaz que no tiene ningún método',
        'opcion_b' => 'Una interfaz que tiene exactamente un método abstracto, permitiendo expresiones Lambda',
        'opcion_c' => 'Una clase abstracta con métodos matemáticos',
        'opcion_d' => 'Una interfaz que solo contiene constantes estáticas',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Las interfaces funcionales tienen exactamente un método abstracto (SAM) y son la base de las expresiones Lambda en Java.'
    ],
    [
        'pregunta' => '¿Cuál es la función del bloque try-with-resources introducido en Java 7?',
        'opcion_a' => 'Mejorar la velocidad del procesador',
        'opcion_b' => 'Cerrar automáticamente recursos que implementen java.lang.AutoCloseable',
        'opcion_c' => 'Evitar el uso de bloques catch',
        'opcion_d' => 'Duplicar la memoria disponible en el Heap',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'try-with-resources garantiza que recursos como Streams o conexiones JDBC se cierren automáticamente al terminar el bloque.'
    ],
    [
        'pregunta' => '¿Qué colección garantiza que no haya elementos duplicados y mantiene el orden natural o mediante un Comparator?',
        'opcion_a' => 'HashSet',
        'opcion_b' => 'LinkedHashSet',
        'opcion_c' => 'TreeSet',
        'opcion_d' => 'Vector',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'TreeSet almacena elementos únicos ordenados según orden natural o un Comparator mediante un árbol rojo-negro.'
    ],
    [
        'pregunta' => '¿Qué ventaja tiene PreparedStatement sobre Statement estándar en JDBC?',
        'opcion_a' => 'Soporta consultas no relacionales NoSQL',
        'opcion_b' => 'Previene ataques de inyección SQL y permite precompilación para mayor rendimiento',
        'opcion_c' => 'No requiere conexión a la base de datos',
        'opcion_d' => 'Guarda automáticamente los datos en un archivo JSON',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'PreparedStatement parametriza las consultas evitando inyecciones SQL y el motor de BD puede reutilizar su plan de ejecución.'
    ],
    [
        'pregunta' => '¿Qué anotación de Spring Framework se utiliza para marcar una clase como un componente de servicio de lógica de negocio?',
        'opcion_a' => '@Repository',
        'opcion_b' => '@Controller',
        'opcion_c' => '@Service',
        'opcion_d' => '@Entity',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Semi-Senior',
        'explicacion' => '@Service es una especialización de @Component pensada para la capa de servicios de negocio.'
    ],
    [
        'pregunta' => '¿Qué hace la palabra clave volatile en una variable compartida entre hilos en Java?',
        'opcion_a' => 'Bloquea la variable para que solo un hilo la lea a la vez',
        'opcion_b' => 'Garantiza que las lecturas y escrituras ocurran directamente en memoria principal (visibilidad entre hilos)',
        'opcion_c' => 'Convierte la variable en inmutable',
        'opcion_d' => 'Almacena la variable en disco duro',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'volatile asegura visibilidad inmediata de los cambios entre hilos evitando que queden en cachés de CPU locales.'
    ],
    [
        'pregunta' => '¿Cuál es la diferencia entre los métodos wait() y sleep() en el manejo de hilos en Java?',
        'opcion_a' => 'wait() libera el monitor/lock del objeto y sleep() conserva el lock',
        'opcion_b' => 'sleep() solo funciona en hilos daemon y wait() en normales',
        'opcion_c' => 'wait() pertenece a Thread y sleep() a Object',
        'opcion_d' => 'Son idénticos en comportamiento',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'wait() (de Object) libera el lock y espera notify(); sleep() (de Thread) pausa la ejecución sin soltar los locks obtenidos.'
    ],
    [
        'pregunta' => '¿Qué ocurre si se llama al método start() dos veces sobre la misma instancia de Thread en Java?',
        'opcion_a' => 'Reinicia el hilo desde el principio',
        'opcion_b' => 'Lanza IllegalThreadStateException',
        'opcion_c' => 'Crea un subproceso hijo',
        'opcion_d' => 'No hace nada y continúa normalmente',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Un hilo en Java no puede ser reiniciado una vez comenzado; invocar start() nuevamente arroja IllegalThreadStateException.'
    ],
    [
        'pregunta' => '¿Qué método de Optional en Java 8 permite devolver un valor por defecto si el contenido está vacío?',
        'opcion_a' => 'orElse()',
        'opcion_b' => 'ifEmpty()',
        'opcion_c' => 'defaultVal()',
        'opcion_d' => 'fallback()',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'orElse(T other) y orElseGet(Supplier) devuelven el valor contenido o el valor por defecto si el Optional está vacío.'
    ],
    [
        'pregunta' => '¿Cuál es el propósito del operador diamante <> introducido en Java 7 con Generics?',
        'opcion_a' => 'Inferencia de tipos en la instanciación de clases genéricas',
        'opcion_b' => 'Comparación ternaria avanzada',
        'opcion_c' => 'Inyección de dependencias estática',
        'opcion_d' => 'Definir punteros a memoria',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Permite omitir el tipo en el lado derecho: List<String> list = new ArrayList<>(); inferido por el compilador.'
    ],
    [
        'pregunta' => '¿Qué patrón de diseño representa java.sql.DriverManager.getConnection(...) al crear conexiones?',
        'opcion_a' => 'Observer',
        'opcion_b' => 'Factory Method / Abstract Factory',
        'opcion_c' => 'Decorator',
        'opcion_d' => 'Command',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'DriverManager delega la creación de instancias de Connection específicas del driver correspondiente (Factory).'
    ],
    [
        'pregunta' => '¿Qué diferencia hay entre HashMap y ConcurrentHashMap?',
        'opcion_a' => 'HashMap es seguro para hilos y ConcurrentHashMap no',
        'opcion_b' => 'ConcurrentHashMap permite operaciones concurrentes thread-safe sin bloquear todo el mapa',
        'opcion_c' => 'ConcurrentHashMap no permite valores nulos ni llaves nulas',
        'opcion_d' => 'Tanto B como C son correctas',
        'respuesta_correcta' => 'D',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'ConcurrentHashMap es thread-safe con bloqueos granulares a nivel de bucket y no permite llaves ni valores null.'
    ],
    [
        'pregunta' => '¿Qué anotación en JPA se usa para indicar que un campo no debe ser persistido en la base de datos?',
        'opcion_a' => '@Ignore',
        'opcion_b' => '@Transient',
        'opcion_c' => '@Skip',
        'opcion_d' => '@Exclude',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => '@Transient en JPA / Hibernate le indica al motor de persistencia que ignore ese atributo en el mapeo de tablas.'
    ],
    [
        'pregunta' => '¿Cuál es el resultado de usar "==" para comparar dos objetos Integer con valor 200?',
        'opcion_a' => 'Siempre devuelve true',
        'opcion_b' => 'Devuelve false porque excede el rango de caché de enteros (-128 a 127)',
        'opcion_c' => 'Lanza ClassCastException',
        'opcion_d' => 'Provoca error de compilación',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'IntegerCache almacena de -128 a 127. Valores fuera de ese rango generan nuevas referencias de objetos, por lo que == da false.'
    ],
    [
        'pregunta' => '¿Qué método de la clase String divide una cadena en subcadenas según una expresión regular?',
        'opcion_a' => 'substring()',
        'opcion_b' => 'divide()',
        'opcion_c' => 'split()',
        'opcion_d' => 'tokenize()',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'String.split(regex) compila la expresión regular y devuelve un array String[] con las partes resultantes.'
    ],
    [
        'pregunta' => '¿Cuál de los siguientes es el ciclo de vida de un Bean en Spring por defecto?',
        'opcion_a' => 'Prototype',
        'opcion_b' => 'Singleton',
        'opcion_c' => 'Session',
        'opcion_d' => 'Request',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'El scope predeterminado de un Bean en el contenedor IoC de Spring es Singleton (una sola instancia por ApplicationContext).'
    ],
    [
        'pregunta' => '¿Qué es el "Auto-boxing" en Java?',
        'opcion_a' => 'La conversión automática entre tipos primitivos y sus correspondientes clases envoltorio (wrapper)',
        'opcion_b' => 'La serialización automática de objetos a JSON',
        'opcion_c' => 'El empaquetado de archivos en formato .jar',
        'opcion_d' => 'La compilación automática de código fuente',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'El compilador de Java convierte automáticamente primitivos como int a su clase Wrapper Integer (boxing) y viceversa (unboxing).'
    ],
    [
        'pregunta' => '¿Cómo se define un método con implementación por defecto dentro de una interfaz en Java 8+?',
        'opcion_a' => 'Usando la palabra clave default',
        'opcion_b' => 'Declarándolo abstract final',
        'opcion_c' => 'No es posible implementar métodos en interfaces',
        'opcion_d' => 'Usando la palabra clave virtual',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Java 8 introdujo default methods en interfaces para permitir evolución de APIs sin romper clases implementadoras existentes.'
    ],
    [
        'pregunta' => '¿Qué clase de java.time representa una fecha y hora sin zona horaria en Java 8+?',
        'opcion_a' => 'ZonedDateTime',
        'opcion_b' => 'LocalDateTime',
        'opcion_c' => 'Instant',
        'opcion_d' => 'Timestamp',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'LocalDateTime describe fecha y hora ISO-8601 (año, mes, día, hora, minutos) sin referencia a zona horaria.'
    ],
    [
        'pregunta' => '¿Cuál es la diferencia principal entre @RequestParam y @PathVariable en Spring MVC / REST?',
        'opcion_a' => '@PathVariable obtiene datos de la query string y @RequestParam de la URL path',
        'opcion_b' => '@PathVariable extrae valores embebidos en el template de la URI (/users/{id}) y @RequestParam de query params (?name=value)',
        'opcion_c' => 'No existe @PathVariable en Spring',
        'opcion_d' => 'Ambas anotaciones son sinónimos exactos',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => '@PathVariable extrae valores de los segmentos dinámicos de la URI, mientras que @RequestParam extrae parámetros de consulta o form data.'
    ],

    // ==========================================
    // NIVEL SENIOR (25 PREGUNTAS)
    // ==========================================
    [
        'pregunta' => '¿Qué regiones de memoria componen la arquitectura de la JVM en tiempo de ejecución?',
        'opcion_a' => 'Solo Stack y Heap',
        'opcion_b' => 'Heap, Method Area (Metaspace), JVM Stacks, PC Registers y Native Method Stacks',
        'opcion_c' => 'RAM virtual y Paginación',
        'opcion_d' => 'L1 Cache, L2 Cache y Main Memory',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'La especificación de la JVM divide la memoria en Heap (Young/Old gen), Metaspace, Stacks por hilo, PC registers y Native Stacks.'
    ],
    [
        'pregunta' => '¿Cuál fue el cambio principal respecto a la memoria PermGen introducido en Java 8?',
        'opcion_a' => 'PermGen se triplicó en tamaño por defecto',
        'opcion_b' => 'PermGen fue eliminada y reemplazada por Metaspace, que utiliza memoria nativa del sistema operativo',
        'opcion_c' => 'Los metadatos de clases se movieron a la memoria Stack',
        'opcion_d' => 'No hubo cambios de memoria en Java 8',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'PermGen causaba frecuentes OutOfMemoryError; en Java 8 fue reemplazado por Metaspace que escala dinámicamente en memoria nativa.'
    ],
    [
        'pregunta' => '¿Cuál es el problema que surge al usar "Double-Checked Locking" para un Singleton sin declarar la instancia como volatile?',
        'opcion_a' => 'Lanza NullPointerException al compilar',
        'opcion_b' => 'Reordenamiento de instrucciones de la CPU puede exponer una instancia parcialmente inicializada a otro hilo',
        'opcion_c' => 'La JVM bloquea todos los hilos indefinidamente (Deadlock)',
        'opcion_d' => 'El Garbage Collector destruye la instancia inmediatamente',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'Sin volatile, la creación del objeto puede reordenarse (asignar referencia antes de inicializar campos), exponiendo un objeto roto.'
    ],
    [
        'pregunta' => '¿En qué consiste el recolector de basura G1 (Garbage-First) de la JVM?',
        'opcion_a' => 'Un recolector que detiene el sistema por completo (Full Stop-The-World) durante todo el proceso',
        'opcion_b' => 'Divide el Heap en regiones de igual tamaño y prioriza recolectar las regiones con más espacio recuperable con pausas predecibles',
        'opcion_c' => 'Solo limpia memoria en servidores de 32 bits',
        'opcion_d' => 'Un recolector que nunca libera memoria de objetos antiguos',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'G1 particiona el heap en regiones y planifica pausas cortas compactando primero las regiones con más basura (Garbage First).'
    ],
    [
        'pregunta' => 'En el contexto de JPA e Hibernate, ¿qué es el problema de consultas N+1?',
        'opcion_a' => 'Un error que ocurre cuando una tabla tiene más de N columnas',
        'opcion_b' => 'Cuando al consultar N entidades, Hibernate ejecuta 1 consulta inicial y luego N consultas adicionales para cargar relaciones lazy',
        'opcion_c' => 'Un error de sintaxis en consultas nativas SQL',
        'opcion_d' => 'Una excepción de timeout de conexión en el pool HikariCP',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'N+1 ocurre al iterar una lista cargada con fetch lazy, disparando una consulta extra por cada fila. Se mitiga con JOIN FETCH o EntityGraph.'
    ],
    [
        'pregunta' => '¿Cuál es la diferencia entre optimistic locking (@Version) y pessimistic locking en JPA?',
        'opcion_a' => 'Optimistic bloquea la fila en la BD con SELECT FOR UPDATE; Pessimistic no bloquea',
        'opcion_b' => 'Optimistic no bloquea la fila en la BD sino que verifica un número de versión al hacer UPDATE; Pessimistic bloquea físicamente la fila en la BD',
        'opcion_c' => 'Optimistic solo funciona en PostgreSQL',
        'opcion_d' => 'No existe pessimistic locking en JPA',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'Optimistic usa un campo de versión para detectar colisiones al commitear; Pessimistic bloquea el registro en el motor de base de datos.'
    ],
    [
        'pregunta' => '¿Cómo gestiona Spring las transacciones declarativas mediante la anotación @Transactional?',
        'opcion_a' => 'Reescribiendo el bytecode de la máquina virtual',
        'opcion_b' => 'Mediante Proxies AOP (dinámicos de JDK o CGLIB) que interceptan la llamada al método para abrir y confirmar/revertir la transacción',
        'opcion_c' => 'Ejecutando un hilo separado en segundo plano',
        'opcion_d' => 'Compilando consultas SQL en tiempo de ejecución',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'Spring usa proxies AOP. Si se invoca un método @Transactional desde dentro de la misma clase (self-invocation), el proxy se omite y la transacción no se abre.'
    ],
    [
        'pregunta' => '¿Cuál es la principal limitación de los proxies dinámicos estándar de JDK frente a CGLIB en Spring?',
        'opcion_a' => 'Los proxies JDK solo pueden interceptar clases que implementen interfaces',
        'opcion_b' => 'Los proxies JDK no admiten métodos públicos',
        'opcion_c' => 'CGLIB es más lento en tiempo de ejecución',
        'opcion_d' => 'Los proxies JDK consumen memoria Heap ilimitada',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'java.lang.reflect.Proxy requiere interfaces. CGLIB genera subclases en bytecode al vuelo, por lo que puede proxificar clases concretas no-final.'
    ],
    [
        'pregunta' => '¿Qué garantiza la propiedad "happens-before" en el Modelo de Memoria de Java (JMM)?',
        'opcion_a' => 'Que el compilador optimizará todo el código a código máquina en menos de 1 segundo',
        'opcion_b' => 'Que las escrituras realizadas por un hilo sean visibles de forma ordenada y predecible para lecturas de otro hilo',
        'opcion_c' => 'Que los hilos nunca entrarán en deadlock',
        'opcion_d' => 'Que el recolector de basura se ejecutará antes de cualquier método main',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'La relación happens-before es el pilar del JMM que define cuándo una acción de memoria es visible para otra operación concurrente.'
    ],
    [
        'pregunta' => '¿Qué clase del paquete java.util.concurrent se utiliza para coordinar hilos haciendo que uno o varios esperen hasta que un conjunto de operaciones termine?',
        'opcion_a' => 'CountDownLatch',
        'opcion_b' => 'AtomicInteger',
        'opcion_c' => 'ThreadLocal',
        'opcion_d' => 'ForkJoinPool',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'CountDownLatch permite a uno o más hilos esperar con await() hasta que una cuenta regresiva llegue a cero mediante countDown().'
    ],
    [
        'pregunta' => '¿Qué riesgo crítico presenta el uso indebido de ThreadLocal en aplicaciones que utilizan Thread Pools (como servidores Tomcat)?',
        'opcion_a' => 'Corrupción física de datos en disco',
        'opcion_b' => 'Fugas de memoria (Memory Leaks) y filtración de datos de un usuario a otro debido a la reutilización de hilos',
        'opcion_c' => 'Cierre inesperado de la JVM sin logs',
        'opcion_d' => 'Bloqueo del puerto HTTP',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'Los hilos de un pool no mueren; si no se llama a ThreadLocal.remove(), la referencia persiste causando fugas y datos residuales cruzados.'
    ],
    [
        'pregunta' => '¿Cuál es la diferencia entre CompletableFuture y Future clásico en Java?',
        'opcion_a' => 'CompletableFuture es síncrono y bloqueante',
        'opcion_b' => 'CompletableFuture permite encadenar callbacks no bloqueantes (thenApply, thenCompose), composición funcional y completado manual',
        'opcion_c' => 'Future clásico soporta programación reactiva',
        'opcion_d' => 'Future clásico permite manejo de excepciones asíncronas de forma nativa',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'CompletableFuture implementa CompletionStage, permitiendo pipelines asíncronos y reactivos sin bloquear hilos con get().'
    ],
    [
        'pregunta' => '¿Qué patrón estructural resuelve la adaptación de interfaces incompatibles sin alterar el código cliente ni el servicio original?',
        'opcion_a' => 'Adapter',
        'opcion_b' => 'Observer',
        'opcion_c' => 'Singleton',
        'opcion_d' => 'Memento',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'El patrón Adapter envuelve un objeto existente con una interfaz compatible requerida por el cliente.'
    ],
    [
        'pregunta' => '¿Cómo funciona la propagación transaccional REQUIRES_NEW en Spring Framework?',
        'opcion_a' => 'Se une a la transacción existente si existe',
        'opcion_b' => 'Suspende la transacción actual (si existe) y crea una transacción independiente con su propio commit/rollback',
        'opcion_c' => 'Ejecuta el método sin ninguna transacción',
        'opcion_d' => 'Lanza una excepción si ya existe una transacción activa',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'REQUIRES_NEW suspende la transacción externa y ejecuta el método en una transacción autónoma desacoplada.'
    ],
    [
        'pregunta' => '¿Qué algoritmo utiliza internamente HashMap de Java 8+ cuando un bucket tiene más de 8 elementos colisionados (TREEIFY_THRESHOLD)?',
        'opcion_a' => 'Cambia la lista enlazada interna a un árbol rojo-negro autobalanceado (Red-Black Tree)',
        'opcion_b' => 'Descarta los elementos duplicados',
        'opcion_c' => 'Convierte el mapa en un array estático',
        'opcion_d' => 'Lanza HashCollisionException',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Para evitar degradación de O(N) por ataques de colisión de hash, Java 8 convierte el bucket a Red-Black Tree garantizando O(log N).'
    ],
    [
        'pregunta' => '¿Cuál es la función del pool de conexiones HikariCP, el predeterminado en Spring Boot 2+?',
        'opcion_a' => 'Proveer una base de datos embebida en memoria',
        'opcion_b' => 'Administrar conexiones JDBC de manera ultraligera, optimizada a nivel de bytecode y de latencia extremadamente baja',
        'opcion_c' => 'Compilar código Java en tiempo real',
        'opcion_d' => 'Encriptar el tráfico TCP entre microservicios',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'HikariCP es reconocido por su rendimiento récord eliminando sobrecarga en la gestión de pools de conexiones JDBC.'
    ],
    [
        'pregunta' => '¿Qué principio de SOLID se viola si una subclase sobreescribe un método de la superclase lanzando UnsupportedOperationException?',
        'opcion_a' => 'Single Responsibility Principle (SRP)',
        'opcion_b' => 'Liskov Substitution Principle (LSP)',
        'opcion_c' => 'Open/Closed Principle (OCP)',
        'opcion_d' => 'Dependency Inversion Principle (DIP)',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'LSP estipula que los objetos de una subclase deben poder sustituir a los de la superclase sin alterar la corrección del programa.'
    ],
    [
        'pregunta' => '¿Cuál es el beneficio de los registros (Records) introducidos de forma definitiva en Java 16?',
        'opcion_a' => 'Son clases mutables diseñadas para entidades JPA complejas',
        'opcion_b' => 'Clases portadoras de datos inmutables y concisas con equals, hashCode, toString y getters generados automáticamente',
        'opcion_c' => 'Permiten herencia múltiple de clases',
        'opcion_d' => 'Reemplazan por completo a los hilos de ejecución',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'record define un contenedor inmutable de datos libre de código boilerplate con semántica transparente.'
    ],
    [
        'pregunta' => '¿Qué técnica de optimización en la JVM se encarga de reemplazar la llamada a un método por el cuerpo del mismo método en tiempo de compilación JIT?',
        'opcion_a' => 'Method Inlining',
        'opcion_b' => 'Escape Analysis',
        'opcion_c' => 'Dead Code Elimination',
        'opcion_d' => 'Loop Unrolling',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Method Inlining elimina la sobrecarga de saltos de pila y llamada de método colocando el código directamente en el punto de invocación.'
    ],
    [
        'pregunta' => '¿Qué realiza el análisis de escape (Escape Analysis) en el compilador C2 de HotSpot?',
        'opcion_a' => 'Detecta fugas de memoria en tiempo de compilación',
        'opcion_b' => 'Determina si un objeto no escapa del método para asignarlo en la pila (Stack Allocation) o eliminar sincronizaciones innecesarias',
        'opcion_c' => 'Escapa caracteres especiales en consultas SQL',
        'opcion_d' => 'Termina la JVM si hay un fallo de hardware',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'Si un objeto no escapa de un hilo o método, HotSpot puede evitar crear el objeto en el Heap (Scalar Replacement) y saltarse el GC.'
    ],
    [
        'pregunta' => '¿Para qué sirve la anotación @ControllerAdvice en Spring Boot?',
        'opcion_a' => 'Para registrar controladores en el log del sistema',
        'opcion_b' => 'Para manejar excepciones de forma global y centralizada en toda la aplicación con @ExceptionHandler',
        'opcion_c' => 'Para forzar autenticación básica HTTP',
        'opcion_d' => 'Para convertir todos los endpoints en SOAP',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => '@ControllerAdvice permite interceptar y transformar excepciones lanzadas por cualquier controlador en respuestas HTTP estandarizadas.'
    ],
    [
        'pregunta' => '¿Qué diferencia existe entre un Semaphore y un ReentrantLock en Java Concurrency?',
        'opcion_a' => 'ReentrantLock permite múltiples permisos simultáneos y Semaphore solo uno',
        'opcion_b' => 'ReentrantLock permite acceso exclusivo de un solo hilo con reentrancia, mientras Semaphore administra N permisos simultáneos',
        'opcion_c' => 'Semaphore no se puede usar con múltiples hilos',
        'opcion_d' => 'No hay diferencia funcional',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'ReentrantLock es un mutex de exclusión mutua de 1 hilo; Semaphore gestiona un pool de permisos (conteo) para recursos limitados.'
    ],
    [
        'pregunta' => '¿Qué característica define a una clase sellada (Sealed Class) en Java 17+?',
        'opcion_a' => 'Una clase que no puede ser leída por herramientas de reflection',
        'opcion_b' => 'Una clase que restringe explícitamente qué otras clases o interfaces tienen permitido extenderla o implementarla (permits)',
        'opcion_c' => 'Una clase encriptada en el archivo JAR',
        'opcion_d' => 'Una clase que solo tiene métodos privados',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'Las sealed classes permiten modelar jerarquías cerradas y exhaustivas con la cláusula permits.'
    ],
    [
        'pregunta' => '¿Cómo funciona la caché de primer nivel (First-Level Cache) en Hibernate?',
        'opcion_a' => 'Es compartida globalmente por toda la aplicación en Redis',
        'opcion_b' => 'Está asociada exclusivamente a la Session (EntityManager) activa; almacena entidades leídas para evitar SELECTs repetidos en la misma transacción',
        'opcion_c' => 'Se guarda en el disco local del servidor',
        'opcion_d' => 'Solo funciona si se activa explícitamente en application.properties',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'La caché L1 es obligatoria y scoped a la Session actual, garantizando identidad de objetos y reduciendo viajes a la base de datos.'
    ],
    [
        'pregunta' => '¿Cuál es el propósito del recolector ZGC (Z Garbage Collector) en Java moderno?',
        'opcion_a' => 'Optimizar únicamente programas de consola pequeños',
        'opcion_b' => 'Lograr pausas de recolector de basura inferiores a 1 milisegundo en heaps de gigabytes o terabytes con pausas constantes independientes del tamaño',
        'opcion_c' => 'Eliminar la necesidad de memoria RAM',
        'opcion_d' => 'Desactivar la recolección automática de memoria',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'ZGC es un recolector escalable de latencia ultrabaja que realiza casi todo su trabajo de forma concurrente con punteros coloreados.'
    ],

    // ==========================================
    // NIVEL EXPERTO (25 PREGUNTAS)
    // ==========================================
    [
        'pregunta' => '¿En qué consisten los Hilos Virtuales (Virtual Threads / Proyecto Loom) introducidos formalmente en Java 21?',
        'opcion_a' => 'Son hilos administrados por el sistema operativo nativo (1 a 1 con hilos del kernel)',
        'opcion_b' => 'Son hilos ligeros administrados directamente por la JVM que se mapean M:N sobre hilos de plataforma, permitiendo millones de hilos concurrentes con mínimo costo',
        'opcion_c' => 'Hilos ejecutados en emuladores gráficos',
        'opcion_d' => 'Un reemplazo de los contenedores Docker',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Experto',
        'explicacion' => 'Virtual Threads desacoplan los hilos lógicos de los hilos de kernel, permitiendo código de estilo imperativo síncrono con throughput masivo no bloqueante.'
    ],
    [
        'pregunta' => '¿Qué ocurre con un Virtual Thread en Java 21 si se bloquea dentro de un bloque synchronized (Thread Pinning)?',
        'opcion_a' => 'La JVM arroja inmediatamente VirtualMachineError',
        'opcion_b' => 'El hilo virtual queda "fijado" (pinned) a su hilo de plataforma (Carrier Thread), impidiendo que otros hilos virtuales lo utilicen mientras dura el bloqueo',
        'opcion_c' => 'El hilo virtual se destruye y se pierde la transacción',
        'opcion_d' => 'El bloqueo se ignora y continúa la ejecución de manera no segura',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Experto',
        'explicacion' => 'Thread pinning ocurre en bloques synchronized o llamadas nativas JNI; para mitigar esto se recomienda migrar locks a ReentrantLock.'
    ],
    [
        'pregunta' => '¿Cómo funciona la técnica de "Colored Pointers" y "Load Barriers" en el recolector ZGC?',
        'opcion_a' => 'Guarda metadatos de recolección en los bits no utilizados de los punteros de 64 bits y corrige referencias concurrentemente al momento de cargarlas',
        'opcion_b' => 'Colorea las instrucciones de bytecode en el archivo .class',
        'opcion_c' => 'Asigna colores a los logs de consola para diagnóstico',
        'opcion_d' => 'Requiere una tarjeta gráfica con soporte OpenGL',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'ZGC almacena estado (Marked0, Marked1, Remapped) en los bits de referencia y usa barreras de lectura de CPU para compactar memoria concurrentemente.'
    ],
    [
        'pregunta' => '¿Qué patrón de arquitectura resuelve la consistencia eventual entre microservicios transaccionales sin utilizar Two-Phase Commit (2PC)?',
        'opcion_a' => 'Saga Pattern (Coreografía u Orquestación)',
        'opcion_b' => 'Active Record',
        'opcion_c' => 'Model-View-Presenter',
        'opcion_d' => 'Singleton Cluster',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'El patrón Saga divide la transacción distribuida en transacciones locales coordinadas con transacciones compensatorias en caso de fallo.'
    ],
    [
        'pregunta' => '¿Cómo garantiza el patrón Transactional Outbox que un evento de Kafka/RabbitMQ se publique solo si la transacción en la base de datos se confirma exitosamente?',
        'opcion_a' => 'Enviando el mensaje primero y luego haciendo el INSERT en la base de datos',
        'opcion_b' => 'Guardando el evento en una tabla "outbox" dentro de la misma transacción ACID de la BD y leyéndolo con un proceso independiente (CDC o Debezium)',
        'opcion_c' => 'Usando HTTP síncrono con timeout de 60 segundos',
        'opcion_d' => 'Bloqueando la red con un firewall dinámico',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Experto',
        'explicacion' => 'Al guardar el evento en la misma transacción de BD que los datos de negocio, se elimina la falla de doble escritura (Dual-Write Problem).'
    ],
    [
        'pregunta' => '¿Qué efecto causa el fenómeno "False Sharing" en aplicaciones Java multihilo de ultra-alta frecuencia?',
        'opcion_a' => 'Hilos que acceden a variables independientes situadas en la misma línea de caché de CPU (Cache Line de 64 bytes) invalidan continuamente la caché de otros núcleos',
        'opcion_b' => 'Vulnerabilidad de inyección de código entre diferentes JVMs',
        'opcion_c' => 'Un error en la resolución de DNS de sockets TCP',
        'opcion_d' => 'Simulación de hardware virtual defectuoso',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'False sharing penaliza el bus de memoria degradando el throughput. Java provee @jdk.internal.vm.annotation.Contended para agregar padding.'
    ],
    [
        'pregunta' => '¿Cuál es el mecanismo de "Safepoints" en la JVM HotSpot?',
        'opcion_a' => 'Puntos de control donde todos los hilos de aplicación deben pausarse voluntariamente para que la JVM ejecute tareas críticas como GC o desoptimización JIT',
        'opcion_b' => 'Puntos de restauración de la base de datos en memoria',
        'opcion_c' => 'Copias de seguridad automáticas del código fuente en Git',
        'opcion_d' => 'Reglas de firewall que restringen accesos no autorizados',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'Los hilos inspeccionan periódicamente páginas de safepoint. Si un hilo ejecuta un bucle no contado sin safepoint poll, puede retrasar pausas de GC (TTSP).'
    ],
    [
        'pregunta' => '¿En qué se diferencian el compilador C1 (Client) y el compilador C2 (Server) en la compilación por niveles (Tiered Compilation) de HotSpot?',
        'opcion_a' => 'C1 compila rápido con optimizaciones básicas; C2 analiza perfiles en tiempo de ejecución (profiling) y genera código máquina altamente optimizado y agresivo',
        'opcion_b' => 'C1 solo corre en Windows y C2 en Linux',
        'opcion_c' => 'C2 fue descontinuado en Java 11',
        'opcion_d' => 'C1 no genera código máquina nativo',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'HotSpot usa Tiered Compilation: el código empieza interpretado, pasa a C1 para arranque rápido y si se vuelve "hot", C2 aplica optimizaciones profundas.'
    ],
    [
        'pregunta' => '¿Qué es y para qué se utiliza Java Flight Recorder (JFR) junto con JDK Mission Control (JMC)?',
        'opcion_a' => 'Un framework de testing unitario para simular vuelos de drones',
        'opcion_b' => 'Una herramienta de profiling y diagnóstico de eventos embebida en la JVM con una sobrecarga mínima (< 1%), segura para entornos de producción de misión crítica',
        'opcion_c' => 'Un servidor proxy inverso para balancear carga HTTP',
        'opcion_d' => 'Un sistema de gestión de dependencias alternativo a Maven',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Experto',
        'explicacion' => 'JFR captura métricas de CPU, latencias de hilos, asignaciones de memoria y pausas de GC sin degradar el rendimiento en producción.'
    ],
    [
        'pregunta' => '¿Qué riesgo arquitectónico introduce el antipatrón "Distributed Monolith" en sistemas basados en microservicios?',
        'opcion_a' => 'Falta de balanceo de carga en Nginx',
        'opcion_b' => 'Servicios acoplados que deben desplegarse juntos, comparten bases de datos o dependen de llamadas síncronas en cascada, perdiendo las ventajas de escalabilidad e independencia',
        'opcion_c' => 'Incompatibilidad entre sistemas operativos',
        'opcion_d' => 'Imposibilidad de usar Java en el backend',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Experto',
        'explicacion' => 'Un monolito distribuido combina la complejidad operacional de los microservicios con el acoplamiento rígido de un monolito.'
    ],
    [
        'pregunta' => '¿Cuál es la función del algoritmo Raft en sistemas distribuidos como etcd, Apache Kafka (KRaft) o Consul?',
        'opcion_a' => 'Comprimir imágenes JPEG en el servidor',
        'opcion_b' => 'Consenso distribuido para acordar el estado de un log replicado entre un clúster de nodos tolerante a particiones de red',
        'opcion_c' => 'Cifrado asimétrico de contraseñas de usuarios',
        'opcion_d' => 'Asignar IPs fijas a contenedores Kubernetes',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Experto',
        'explicacion' => 'Raft resuelve el consenso distribuido mediante elección de líder, replicación de log y seguridad de estado, reemplazando a ZooKeeper en sistemas modernos.'
    ],
    [
        'pregunta' => '¿Qué es GraalVM Native Image y cuál es su principal ventaja y desventaja frente a la JVM estándar?',
        'opcion_a' => 'Compila Java AOT (Ahead-Of-Time) a binario nativo: arranque en milisegundos y mínimo consumo de memoria, pero sacrifica optimización dinámica JIT y uso dinámico de reflection',
        'opcion_b' => 'Permite correr Java en el navegador sin WebAssembly',
        'opcion_c' => 'Es un emulador de Java para microcontroladores sin memoria RAM',
        'opcion_d' => 'Aumenta el tiempo de arranque de la aplicación a cambio de mayor seguridad',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'GraalVM compila bajo la hipótesis del mundo cerrado (Closed-World Assumption), ideal para funciones Serverless y contenedores rápidos.'
    ],
    [
        'pregunta' => '¿Qué ocurre durante una "desoptimización" (Deoptimization) en HotSpot JVM?',
        'opcion_a' => 'La aplicación se detiene y reinicia el proceso de Linux',
        'opcion_b' => 'La JVM invalida código compilado por C2 que asumía condiciones optimistas (ej. bimorfismo de llamadas) y retrocede la ejecución al intérprete de forma transparente',
        'opcion_c' => 'El Garbage Collector vacía por completo el Heap',
        'opcion_d' => 'Se deshabilitan todas las conexiones de base de datos',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Experto',
        'explicacion' => 'Si una suposición optimista (Class Hierarchy Analysis) se rompe al cargar una nueva clase, HotSpot descarta el código nativo y reconstruye la pila interpretada (uncommon trap).'
    ],
    [
        'pregunta' => '¿Qué diferencia a los algoritmos de hashing consistentes (Consistent Hashing) en cachés y bases de datos distribuidas (ej. Cassandra, DynamoDB)?',
        'opcion_a' => 'Garantizan que un cambio en el número de nodos solo obligue a reubicar una fracción mínima de claves (K/N), evitando reasignación total',
        'opcion_b' => 'Encriptan las claves con SHA-512',
        'opcion_c' => 'Evitan el uso de memoria RAM en los servidores',
        'opcion_d' => 'Duplican los datos en todos los servidores sin excepción',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'Consistent Hashing organiza los nodos en un anillo circular de hashes permitiendo agregar o quitar servidores con mínima redistribución de datos.'
    ],
    [
        'pregunta' => '¿Cuál es la función del patrón Circuit Breaker (ej. Resilience4j) en arquitecturas de microservicios?',
        'opcion_a' => 'Prevenir ataques DDoS bloqueando IPs externas',
        'opcion_b' => 'Detectar fallos continuos en llamadas remotas y abrir el circuito para fallar rápido de inmediato, protegiendo al llamador y permitiendo la recuperación del servicio degradado',
        'opcion_c' => 'Limpiar conexiones de sockets huérfanas',
        'opcion_d' => 'Cortar la energía eléctrica del servidor en caso de sobrecalentamiento',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Experto',
        'explicacion' => 'El Circuit Breaker transita entre CLOSED, OPEN y HALF-OPEN para evitar caídas en cascada y agotamiento de hilos del cliente.'
    ],
    [
        'pregunta' => '¿Cómo mitiga el algoritmo de Concurrencia No Bloqueante (Non-blocking / Lock-free) los problemas de contención en clases atómicas (AtomicLong, LongAdder)?',
        'opcion_a' => 'Utiliza instrucciones de hardware CAS (Compare-And-Swap) atómicas a nivel de CPU en lugar de locks de sistema operativo',
        'opcion_b' => 'Asigna un hilo por cada variable atómica',
        'opcion_c' => 'Convierte las variables en cadenas inmutables',
        'opcion_d' => 'Escribe las variables en una cola de mensajes en disco',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'CAS es una instrucción de CPU (ej. CMPXCHG en x86) que actualiza el valor solo si coincide con el esperado, reintentando sin poner hilos a dormir.'
    ],
    [
        'pregunta' => '¿Por qué LongAdder es preferible a AtomicLong bajo contención extremadamente alta de múltiples hilos en Java?',
        'opcion_a' => 'LongAdder consume menos memoria estática',
        'opcion_b' => 'LongAdder divide la cuenta en múltiples celdas (Cell[]) reduciendo la contención de CAS entre hilos, sumando el total solo al llamar sum()',
        'opcion_c' => 'LongAdder funciona con tipos String',
        'opcion_d' => 'AtomicLong fue deprecado en Java 9',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Experto',
        'explicacion' => 'LongAdder distribuye las escrituras entre diferentes celdas de memoria, evitando que decenas de núcleos compitan por la misma línea de caché.'
    ],
    [
        'pregunta' => '¿Qué es el aislamiento transaccional "Snapshot Isolation" / MVCC (Multi-Version Concurrency Control) en motores como PostgreSQL o MySQL InnoDB?',
        'opcion_a' => 'Las lecturas nunca bloquean las escrituras y las escrituras nunca bloquean las lecturas, ya que cada transacción lee una instantánea coherente del pasado de la fila',
        'opcion_b' => 'Las transacciones se ejecutan una por una en estricto orden secuencial',
        'opcion_c' => 'Se guarda una captura fotográfica de la pantalla del servidor',
        'opcion_d' => 'Bloquea la tabla completa en cada sentencia SELECT',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'MVCC mantiene versiones históricas de filas (undo logs) para ofrecer consistencia sin requerir locks compartidos de lectura.'
    ],
    [
        'pregunta' => '¿Cuál es el propósito de las Foreign Function & Memory API (Project Panama) formalizadas en Java 22?',
        'opcion_a' => 'Reemplazar completamente a JNI con una interfaz segura y de alto rendimiento para invocar código nativo (C/C++) y acceder a memoria fuera del Heap (Off-Heap)',
        'opcion_b' => 'Permitir que Java se compile a código fuente PHP',
        'opcion_c' => 'Crear interfaces de usuario en 3D',
        'opcion_d' => 'Administrar bases de datos en la nube',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'Panama elimina la fragilidad y sobrecarga de JNI con Arena, MemorySegment y Linker para interactuar eficientemente con librerías nativas.'
    ],
    [
        'pregunta' => '¿Qué garantiza la propiedad Linearizability en sistemas de datos concurrentes y distribuidos?',
        'opcion_a' => 'Que los datos se guardan en un archivo de texto secuencial',
        'opcion_b' => 'Que cada operación parece tener efecto de manera instantánea en algún punto temporal entre su invocación y su respuesta, simulando un único sistema atómico global',
        'opcion_c' => 'Que el sistema nunca puede fallar',
        'opcion_d' => 'Que el consumo de memoria crece de forma estrictamente lineal O(N)',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Experto',
        'explicacion' => 'Linearizability es el modelo de consistencia fuerte más estricto para registros individuales, asegurando orden temporal global.'
    ],
    [
        'pregunta' => '¿Qué problema resuelve el patrón Backpressure en Reactive Streams (Project Reactor / RxJava)?',
        'opcion_a' => 'Evita que un publicador rápido desborde y agote la memoria de un suscriptor que procesa a menor velocidad, permitiendo al suscriptor solicitar demanda (request(n))',
        'opcion_b' => 'Controla la presión física del aire en el rack del servidor',
        'opcion_c' => 'Elimina las excepciones de red automáticamente',
        'opcion_d' => 'Convierte código reactivo en hilos tradicionales bloqueantes',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'Sin backpressure, flujos asíncronos rápidos provocan colas infinitas y OutOfMemoryError; Reactive Streams estandariza la señalización de demanda de consumo.'
    ],
    [
        'pregunta' => '¿Cuál es el rol del bytecode instrumentado por Java Agents mediante java.lang.instrument?',
        'opcion_a' => 'Permite interceptar, modificar o inyectar código en las clases de Java en tiempo de carga para profiling, APMs (NewRelic, Datadog) y tracing distribuido',
        'opcion_b' => 'Detecta y destruye virus informáticos',
        'opcion_c' => 'Reemplaza el compilador javac',
        'opcion_d' => 'Desactiva el recolector de basura',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'Los Java Agents usan ClassFileTransformer y librerías como ByteBuddy para instrumentar métricas sin tocar el código fuente del proyecto.'
    ],
    [
        'pregunta' => '¿Cómo previene el patrón CQRS (Command Query Responsibility Segregation) cuellos de botella en sistemas con alta disparidad entre lecturas y escrituras?',
        'opcion_a' => 'Separa los modelos de datos y endpoints de mutación (Commands) de los modelos de consulta (Queries), permitiendo escalar y optimizar cada lado de forma independiente',
        'opcion_b' => 'Obliga a que todas las consultas sean sincrónicas y las escrituras manuales',
        'opcion_c' => 'Combina la base de datos relacional y el frontend en un solo archivo',
        'opcion_d' => 'Elimina la necesidad de índices en las bases de datos',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'CQRS desacopla escrituras con consistencia transaccional y lecturas con vistas desnormalizadas optimizadas para visualización rápida.'
    ],
    [
        'pregunta' => '¿Qué es el "Split-Brain" en un clúster distribuido de alta disponibilidad y cómo se previene?',
        'opcion_a' => 'Una partición de red que divide el clúster en dos grupos aislados, donde ambos creen ser el líder y aceptan escrituras independientes corrompiendo datos; se previene con quórum (N/2 + 1)',
        'opcion_b' => 'Un error de hardware que daña la CPU principal',
        'opcion_c' => 'La pérdida de conexión a internet del cliente',
        'opcion_d' => 'La duplicación de hilos en la JVM',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'Para evitar dos líderes simultáneos en particiones de red, los protocolos de consenso exigen mayoría estricta (quórum > 50%) para operar.'
    ],
    [
        'pregunta' => '¿Qué técnica permite a Netty lograr un rendimiento de I/O de red extremo en Java con mínimo uso de CPU?',
        'opcion_a' => 'Arquitectura orientada a eventos no bloqueante (NIO / Epoll), pooling de buffers de bytes (ByteBuf) y "Zero-Copy" para transferir datos sin duplicar memoria en el espacio de usuario',
        'opcion_b' => 'Crear un hilo nuevo del sistema operativo por cada paquete TCP recibido',
        'opcion_c' => 'Guardar cada petición HTTP en un archivo temporal de disco',
        'opcion_d' => 'Desactivar el protocolo TCP y forzar UDP en toda la red',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Experto',
        'explicacion' => 'Netty aprovecha selector loops epoll nativos, buffers de memoria directos y zero-copy (FileRegion.transferTo) para transferencias directas kernel-to-NIC.'
    ]
];
