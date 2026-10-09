<?php

$new_42 = [
    606 => [
        'pregunta' => '¿Qué diferencia existe entre el operador == y equals() al comparar objetos?',
        'opcion_a' => '== compara referencias de memoria y equals() compara contenido o estado.',
        'opcion_b' => '== compara valores primitivos y equals() solo compara cadenas String.',
        'opcion_c' => 'equals() es más rápido porque omite la validación de tipos.',
        'opcion_d' => 'No existe ninguna diferencia funcional entre ambos en Java.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => '== valida si apuntan al mismo objeto en memoria; equals() compara equivalencia.'
    ],
    614 => [
        'pregunta' => '¿Por qué se desaconseja concatenar String con el operador + dentro de bucles?',
        'opcion_a' => 'Crea múltiples objetos intermedios en memoria degradando el rendimiento.',
        'opcion_b' => 'Provoca un error de compilación en versiones modernas de Java.',
        'opcion_c' => 'Sobrescribe el valor de las variables locales en el stack.',
        'opcion_d' => 'Impide la ejecución del recolector de basura en el heap.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'Cada concatenación genera un nuevo String; se recomienda usar StringBuilder.'
    ],
    636 => [
        'pregunta' => '¿Qué garantiza declarar una variable compartida como volatile en Java?',
        'opcion_a' => 'Garantiza atomicidad completa en operaciones de incremento.',
        'opcion_b' => 'Bloquea el hilo actual durante la lectura de la variable.',
        'opcion_c' => 'Garantiza visibilidad directa de cambios entre hilos en memoria.',
        'opcion_d' => 'Almacena la variable permanentemente en el pool de constantes.',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'volatile asegura que las lecturas y escrituras vayan a memoria principal.'
    ],
    638 => [
        'pregunta' => '¿Por qué se prefiere la inyección por constructor sobre la inyección por campo?',
        'opcion_a' => 'Facilita la inmutabilidad, el testing unitario y evita dependencias nulas.',
        'opcion_b' => 'Incrementa la velocidad de compilación de los controladores web.',
        'opcion_c' => 'Elimina la necesidad de definir anotaciones en clases de configuración.',
        'opcion_d' => 'Permite crear beans sin necesidad de instanciar la clase en el heap.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'La inyección por constructor promueve beans inmutables y tests sin reflection.'
    ],
    644 => [
        'pregunta' => '¿Cuál es la diferencia principal entre map() y flatMap() en Java Streams?',
        'opcion_a' => 'map() es una operación terminal y flatMap() es intermedia.',
        'opcion_b' => 'flatMap() filtra elementos mientras que map() los ordena de forma natural.',
        'opcion_c' => 'map() transforma elementos 1 a 1 y flatMap() aplana streams anidados.',
        'opcion_d' => 'flatMap() solo funciona sobre colecciones inmutables de tipo Set.',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'flatMap transforma cada elemento en un stream y luego aplana los resultados.'
    ],
    646 => [
        'pregunta' => '¿Cuál es el propósito principal de Optional<T> como retorno en Java?',
        'opcion_a' => 'Expresar explícitamente la posible ausencia de un valor y evitar NPE.',
        'opcion_b' => 'Reemplazar el uso de colecciones vacías como listas y conjuntos.',
        'opcion_c' => 'Serializar objetos de forma binaria en sistemas distribuidos.',
        'opcion_d' => 'Optimizar el uso de memoria RAM reduciendo el tamaño del objeto.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Optional comunica a quien invoca que el resultado puede no estar presente.'
    ],
    650 => [
        'pregunta' => '¿Cómo utiliza Spring los Proxies dinámicos en clases con anotaciones como @Transactional?',
        'opcion_a' => 'Intercepta llamadas a métodos para aplicar lógica transversal como transacciones.',
        'opcion_b' => 'Compila el código Java directamente a lenguaje ensamblador de la máquina.',
        'opcion_c' => 'Sustituye la máquina virtual por un contenedor nativo en memoria.',
        'opcion_d' => 'Desactiva el recolector de basura durante la ejecución del método.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Los proxies interceptan la invocación para iniciar y confirmar transacciones.'
    ],
    651 => [
        'pregunta' => '¿Qué estrategia de @GeneratedValue delega el ID a una columna AUTO_INCREMENT de MySQL?',
        'opcion_a' => 'GenerationType.SEQUENCE',
        'opcion_b' => 'GenerationType.IDENTITY',
        'opcion_c' => 'GenerationType.AUTO',
        'opcion_d' => 'GenerationType.TABLE',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'IDENTITY utiliza columnas autonuméricas nativas del motor relacional.'
    ],
    652 => [
        'pregunta' => '¿Qué excepción lanza un Iterator fail-fast si se modifica la colección concurrentemente?',
        'opcion_a' => 'IllegalStateException',
        'opcion_b' => 'UnsupportedOperationException',
        'opcion_c' => 'ConcurrentModificationException',
        'opcion_d' => 'IndexOutOfBoundsException',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Los iteradores fail-fast detectan cambios estructurales y lanzan la excepción.'
    ],
    659 => [
        'pregunta' => '¿Cómo resuelve Java el conflicto si dos interfaces definen el mismo método default?',
        'opcion_a' => 'Ejecuta aleatoriamente la implementación de cualquiera de las interfaces.',
        'opcion_b' => 'Obliga a la clase implementadora a sobrescribir el método en conflicto.',
        'opcion_c' => 'Ignora ambos métodos y genera un error silencioso en tiempo de ejecución.',
        'opcion_d' => 'Hereda siempre el método de la interfaz declarada en primer lugar.',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'El compilador exige desambiguar implementando explícitamente el método.'
    ],
    663 => [
        'pregunta' => '¿Qué retorna el método add() de un Set cuando se intenta agregar un elemento repetido?',
        'opcion_a' => 'Lanza un DuplicateKeyException al detectar la colisión.',
        'opcion_b' => 'Retorna false y el conjunto permanece sin modificaciones.',
        'opcion_c' => 'Retorna true y sobrescribe el elemento ya existente.',
        'opcion_d' => 'Elimina todos los elementos previos del conjunto.',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Set.add() retorna false si el elemento ya existe según equals() y hashCode().'
    ],
    667 => [
        'pregunta' => '¿Cuál es la forma idónea de manejar checked exceptions dentro de un map() en Streams?',
        'opcion_a' => 'Usar throws directamente en la expresión lambda del stream.',
        'opcion_b' => 'Envolver la lógica en un try-catch o una función envolvente de tipo wrapper.',
        'opcion_c' => 'Desactivar el chequeo de excepciones con la directiva @IgnoreException.',
        'opcion_d' => 'Castear el Stream a un objeto de tipo ParallelStream.',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Las lambdas funcionales de Streams no admiten checked exceptions sin manejo.'
    ],
    669 => [
        'pregunta' => '¿Cómo divide la memoria del Heap el recolector de basura G1 de la JVM?',
        'opcion_a' => 'En dos únicas áreas monolíticas contiguas de tamaño fijo e inalterable.',
        'opcion_b' => 'En pilas dinámicas asignadas exclusivamente a cada hilo del sistema.',
        'opcion_c' => 'En una única región continua sin división generacional.',
        'opcion_d' => 'En múltiples regiones independientes de igual tamaño asignadas por roles.',
        'respuesta_correcta' => 'D',
        'complejidad' => 'Senior',
        'explicacion' => 'G1 divide el heap en regiones iguales (1MB a 32MB) que actúan como Eden/Old.'
    ],
    670 => [
        'pregunta' => '¿Por qué @Transactional falla al invocarse desde otro método de la misma clase?',
        'opcion_a' => 'La llamada interna a this omite el proxy transaccional de Spring.',
        'opcion_b' => 'Spring bloquea las transacciones recursivas por motivos de seguridad.',
        'opcion_c' => 'La conexión a la base de datos se cierra automáticamente al primer paso.',
        'opcion_d' => 'Los métodos públicos de la misma clase comparten el mismo hilo JDBC.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Al invocar internamente a this, la llamada no pasa por el proxy interceptor.'
    ],
    671 => [
        'pregunta' => '¿Qué solución resuelve eficazmente el problema de N+1 queries en JPA?',
        'opcion_a' => 'Cambiar la estrategia de carga de relaciones de EAGER a LAZY.',
        'opcion_b' => 'Utilizar JOIN FETCH en consultas JPQL o definir Entity Graphs.',
        'opcion_c' => 'Desactivar el contexto de persistencia en cada consulta SELECT.',
        'opcion_d' => 'Configurar la base de datos con aislamiento TRANSACTION_NONE.',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'JOIN FETCH carga la entidad y sus asociaciones en una única consulta SQL.'
    ],
    672 => [
        'pregunta' => '¿Qué asegura la regla Happens-Before en el modelo de memoria de Java (JMM)?',
        'opcion_a' => 'Que los hilos finalicen su ejecución en el orden en que fueron creados.',
        'opcion_b' => 'Que la memoria no sufra nunca errores de desbordamiento OutOfMemoryError.',
        'opcion_c' => 'Que la escritura de un hilo sea visible de forma predecible por otro hilo.',
        'opcion_d' => 'Que la recolección de basura ocurra antes de instanciar nuevos objetos.',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Senior',
        'explicacion' => 'Happens-before garantiza coherencia y visibilidad entre operaciones multihilo.'
    ],
    673 => [
        'pregunta' => '¿Cuál es el rol de SecurityFilterChain en Spring Security 6?',
        'opcion_a' => 'Conectarse directamente al servidor LDAP para validar usuarios.',
        'opcion_b' => 'Generar tablas de roles y permisos automáticamente en la base.',
        'opcion_c' => 'Compilar reglas de seguridad a nivel de bytecode en el arranque.',
        'opcion_d' => 'Definir y ordenar la cadena de filtros de autenticación y autorización.',
        'respuesta_correcta' => 'D',
        'complejidad' => 'Senior',
        'explicacion' => 'SecurityFilterChain especifica los filtros HTTP aplicados a cada endpoint.'
    ],
    674 => [
        'pregunta' => '¿Qué optimización permite el Escape Analysis en el compilador JIT de Java?',
        'opcion_a' => 'Asignar objetos en el Stack en lugar del Heap y eliminar sincronizaciones.',
        'opcion_b' => 'Comprimir el código fuente para reducir el tamaño del archivo JAR.',
        'opcion_c' => 'Cerrar sockets de red que no se utilicen tras un periodo de inactividad.',
        'opcion_d' => 'Descargar clases no utilizadas para liberar el Metaspace de la JVM.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Si un objeto no escapa del método, se puede scalarizar o ubicar en el stack.'
    ],
    675 => [
        'pregunta' => '¿Qué excepción lanza JPA cuando falla un bloqueo optimista con @Version?',
        'opcion_a' => 'ConcurrentUpdateException',
        'opcion_b' => 'OptimisticLockException',
        'opcion_c' => 'StaleDataSQLException',
        'opcion_d' => 'TransactionRolledBackException',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'Se lanza OptimisticLockException si la versión en DB difiere de la cargada.'
    ],
    676 => [
        'pregunta' => '¿Cuál es la principal ventaja de los Virtual Threads en Java 21?',
        'opcion_a' => 'Multiplican la velocidad de cálculo intensivo de la CPU por diez.',
        'opcion_b' => 'Reemplazan el recolector de basura tradicional por uno en tiempo real.',
        'opcion_c' => 'Permiten millones de hilos ligeros bloqueantes en I/O con mínimo consumo.',
        'opcion_d' => 'Eliminan la necesidad de sincronizar variables compartidas entre hilos.',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Senior',
        'explicacion' => 'Los hilos virtuales se montan en carrier threads al bloquearse por I/O.'
    ],
    677 => [
        'pregunta' => '¿Por qué una colección estática no limpiada provoca fuga de memoria en Java?',
        'opcion_a' => 'Porque el compilador javac prohíbe liberar memoria estática.',
        'opcion_b' => 'Porque la JVM bloquea la recolección en variables final.',
        'opcion_c' => 'Porque las variables estáticas se almacenan en el registro del CPU.',
        'opcion_d' => 'Porque sus objetos permanecen alcanzables desde la raíz GC Root.',
        'respuesta_correcta' => 'D',
        'complejidad' => 'Senior',
        'explicacion' => 'Los objetos referenciados por clases cargadas (GC roots) nunca son recolectados.'
    ],
    678 => [
        'pregunta' => '¿Qué estado adopta un Circuit Breaker cuando detecta una alta tasa de fallos?',
        'opcion_a' => 'OPEN: rechaza llamadas inmediatas sin consultar al servicio remoto.',
        'opcion_b' => 'CLOSED: duplica el ancho de banda para compensar la latencia.',
        'opcion_c' => 'HALF-OPEN: apaga el contenedor de Spring Boot para reiniciarlo.',
        'opcion_d' => 'LOCKED: bloquea el hilo principal hasta recibir una respuesta HTTP.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'El estado OPEN corta el flujo para dar tiempo de recuperación al servicio.'
    ],
    679 => [
        'pregunta' => '¿Cuál es el objetivo principal del recolector ZGC en la JVM de Java?',
        'opcion_a' => 'Minimizar el uso de memoria RAM a expensas de pausas prolongadas.',
        'opcion_b' => 'Garantizar tiempos de pausa sub-milisegundos en heaps de hasta 16TB.',
        'opcion_c' => 'Desactivar la compilación JIT para mejorar el arranque en frío.',
        'opcion_d' => 'Evitar la fragmentación ejecutando la recolección de noche.',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'ZGC realiza casi todo el trabajo de forma concurrente con pausas < 1 ms.'
    ],
    680 => [
        'pregunta' => '¿Cuál es la mejor práctica de arquitectura para resolver dependencias circulares?',
        'opcion_a' => 'Habilitar spring.main.allow-circular-references=true en producción.',
        'opcion_b' => 'Usar anotaciones @Lazy en todos los atributos de cada componente.',
        'opcion_c' => 'Refactorizar extrayendo la responsabilidad común a un tercer servicio.',
        'opcion_d' => 'Convertir los beans en clases abstractas con métodos estáticos.',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Senior',
        'explicacion' => 'Extraer un servicio mediador o usar eventos elimina el acoplamiento cíclico.'
    ],
    681 => [
        'pregunta' => '¿Qué controla el parámetro -XX:MaxDirectMemorySize en la JVM?',
        'opcion_a' => 'El tamaño máximo de memoria asignado a la pila de cada hilo.',
        'opcion_b' => 'La memoria reservada para el almacenamiento de código del JIT.',
        'opcion_c' => 'El espacio máximo del área Metaspace para metadatos de clases.',
        'opcion_d' => 'El límite de memoria fuera del Heap asignada vía NIO DirectByteBuffer.',
        'respuesta_correcta' => 'D',
        'complejidad' => 'Senior',
        'explicacion' => 'Limita la memoria off-heap que librerías como Netty usan para buffers directos.'
    ],
    683 => [
        'pregunta' => '¿Qué anomalía de concurrencia previene el nivel de aislamiento SERIALIZABLE?',
        'opcion_a' => 'Solo lecturas sucias (Dirty Reads).',
        'opcion_b' => 'Lecturas fantasma, lecturas no repetibles y lecturas sucias.',
        'opcion_c' => 'Exclusivamente la pérdida de actualizaciones concurrentes.',
        'opcion_d' => 'Ninguna, solo optimiza la velocidad de las consultas SELECT.',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'SERIALIZABLE es el nivel más estricto y previene lecturas fantasma (Phantom).'
    ],
    684 => [
        'pregunta' => '¿Qué principio rige la delegación de carga en los ClassLoaders clásicos de Java?',
        'opcion_a' => 'Primero en entrar, primero en salir (FIFO) en memoria.',
        'opcion_b' => 'Carga directa en memoria sin consultar a ninguna clase previa.',
        'opcion_c' => 'Delegación hacia el ClassLoader padre antes de intentar cargar.',
        'opcion_d' => 'Inversión de dependencias basada exclusivamente en anotaciones.',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Senior',
        'explicacion' => 'Un ClassLoader delega la búsqueda a su padre antes de buscar la clase él mismo.'
    ],
    685 => [
        'pregunta' => '¿Qué tipo de ataque mitiga la inclusión de tokens CSRF en aplicaciones web?',
        'opcion_a' => 'Inyección de código SQL malicioso en formularios de búsqueda.',
        'opcion_b' => 'Ataques de denegación de servicio distribuido (DDoS) masivo.',
        'opcion_c' => 'Robo de contraseñas mediante fuerza bruta en el endpoint de login.',
        'opcion_d' => 'Peticiones no autorizadas enviadas desde un sitio externo de confianza.',
        'respuesta_correcta' => 'D',
        'complejidad' => 'Senior',
        'explicacion' => 'CSRF previene que un sitio malicioso ejecute acciones en nombre del usuario.'
    ],
    686 => [
        'pregunta' => '¿Por qué LongAdder ofrece mejor rendimiento que AtomicLong bajo alta contención?',
        'opcion_a' => 'Distribuye la cuenta en celdas internas reduciendo colisiones de CAS.',
        'opcion_b' => 'Evita el uso de memoria RAM delegando los conteos a la tarjeta gráfica.',
        'opcion_c' => 'Utiliza bloqueos sincronizados a nivel de kernel del sistema operativo.',
        'opcion_d' => 'Descarta operaciones duplicadas mediante compresión de datos en memoria.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'LongAdder mantiene un arreglo de celdas que hilos concurrentes actualizan.'
    ],
    687 => [
        'pregunta' => '¿Qué servidor embebido utiliza por defecto Spring WebFlux para I/O no bloqueante?',
        'opcion_a' => 'Apache Tomcat con hilos síncronos clásicos.',
        'opcion_b' => 'Reactor Netty basado en bucles de eventos no bloqueantes.',
        'opcion_c' => 'GlassFish Application Server.',
        'opcion_d' => 'Red Hat WildFly Server.',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'WebFlux utiliza Reactor Netty con event-loops para alta concurrencia no bloqueante.'
    ],
    688 => [
        'pregunta' => '¿En qué momento recolecta el GC los objetos apuntados por una SoftReference?',
        'opcion_a' => 'Inmediatamente en el siguiente ciclo de recolección menor.',
        'opcion_b' => 'Nunca son recolectados mientras la JVM permanezca encendida.',
        'opcion_c' => 'Solo cuando la JVM experimenta escasez crítica de memoria disponible.',
        'opcion_d' => 'Cuando el hilo que creó la referencia finaliza su ejecución.',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Senior',
        'explicacion' => 'SoftReference se conserva hasta que la memoria es escasa (ideal para cachés).'
    ],
    690 => [
        'pregunta' => '¿En qué consiste el algoritmo Work-Stealing en el pool Fork/Join de Java?',
        'opcion_a' => 'Hilos desocupados roban tareas del final de la cola de hilos ocupados.',
        'opcion_b' => 'El hilo principal roba memoria de otros procesos del sistema operativo.',
        'opcion_c' => 'Las tareas pendientes se envían a un nodo externo en la nube.',
        'opcion_d' => 'Cancela las tareas más lentas para priorizar las más rápidas.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Work-stealing maximiza el uso de CPU permitiendo robar subtareas pendientes.'
    ],
    691 => [
        'pregunta' => '¿Cuál es el beneficio de integrar Flyway o Liquibase en proyectos Spring Boot?',
        'opcion_a' => 'Generar controladores REST a partir de esquemas de bases de datos.',
        'opcion_b' => 'Versionar y aplicar migraciones de esquema de base de datos ordenadamente.',
        'opcion_c' => 'Reemplazar el uso de drivers JDBC por conexiones directas de red.',
        'opcion_d' => 'Monitorear el rendimiento de consultas lentas en tiempo real.',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'Garantiza migraciones reproducibles y versionadas entre distintos ambientes.'
    ],
    693 => [
        'pregunta' => '¿Qué ventaja ofrece usar ApplicationEventPublisher para la comunicación interna?',
        'opcion_a' => 'Reemplaza el uso de HTTP para comunicación externa con clientes.',
        'opcion_b' => 'Elimina la necesidad de utilizar bases de datos relacionales.',
        'opcion_c' => 'Obliga a que todos los métodos se ejecuten de forma asíncrona.',
        'opcion_d' => 'Desacopla componentes emisores de receptores mediante publicación de eventos.',
        'respuesta_correcta' => 'D',
        'complejidad' => 'Senior',
        'explicacion' => 'Promueve bajo acoplamiento al emitir eventos sin conocer a los listeners.'
    ],
    694 => [
        'pregunta' => '¿Por qué se prefiere el patrón Saga sobre 2PC en arquitecturas de microservicios?',
        'opcion_a' => 'Evita bloqueos síncronos distribuidos mediante transacciones compensatorias.',
        'opcion_b' => 'Permite usar SQL en bases de datos NoSQL sin configuración adicional.',
        'opcion_c' => 'Garantiza consistencia estricta instantánea en toda la red.',
        'opcion_d' => 'Reduce el costo de almacenamiento en discos SSD del servidor.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Saga divide la transacción en pasos locales con acciones compensatorias si falla.'
    ],
    695 => [
        'pregunta' => '¿Cómo funciona el mecanismo de Dirty Checking en Hibernate?',
        'opcion_a' => 'Escanea tablas en segundo plano para borrar registros obsoletos.',
        'opcion_b' => 'Compara el estado actual con la instantánea original para emitir UPDATEs.',
        'opcion_c' => 'Verifica sintaxis SQL antes de enviar sentencias a la base de datos.',
        'opcion_d' => 'Limpia la memoria del pool de conexiones tras cada petición web.',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'Hibernate detecta cambios comparando con el snapshot al hacer flush.'
    ],
    696 => [
        'pregunta' => '¿Qué efecto tiene activar el flag -XX:+UseStringDeduplication en la JVM?',
        'opcion_a' => 'Impide registrar usuarios con nombres duplicados en formularios.',
        'opcion_b' => 'Elimina cadenas repetidas en archivos de log en disco duro.',
        'opcion_c' => 'Hace que cadenas String idénticas compartan el mismo arreglo de bytes.',
        'opcion_d' => 'Convierte todas las cadenas a formato minúsculas en el heap.',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Senior',
        'explicacion' => 'Reduce el uso de memoria haciendo que cadenas iguales compartan char[]/byte[].'
    ],
    697 => [
        'pregunta' => '¿Qué optimización aporta @Transactional(readOnly = true) con Hibernate?',
        'opcion_a' => 'Bloquea el motor impidiendo escrituras de cualquier otra sesión.',
        'opcion_b' => 'Envía consultas exclusivamente a réplicas de lectura de la base.',
        'opcion_c' => 'Desactiva la necesidad de abrir transacciones JDBC con el driver.',
        'opcion_d' => 'Evita guardar snapshots para Dirty Checking reduciendo consumo de CPU.',
        'respuesta_correcta' => 'D',
        'complejidad' => 'Senior',
        'explicacion' => 'Al desactivar dirty checking y flushes innecesarios, ahorra memoria y cómputo.'
    ],
    698 => [
        'pregunta' => '¿Qué es el fenómeno de False Sharing en arquitecturas multiprocesador en Java?',
        'opcion_a' => 'Hilos en núcleos distintos invalidan cachés al modificar la misma línea.',
        'opcion_b' => 'Dos procesos comparten el mismo puerto TCP causando conflicto de red.',
        'opcion_c' => 'Variables estáticas son sobrescritas por librerías externas en la JVM.',
        'opcion_d' => 'El recolector de basura suspende hilos que no tienen referencias activas.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Ocurre cuando variables distintas residen en la misma línea de caché (64 bytes).'
    ],
    699 => [
        'pregunta' => '¿Cuál es el beneficio de compilar una aplicación Java con GraalVM Native Image?',
        'opcion_a' => 'Permite ejecutar la aplicación sin compilar el código fuente.',
        'opcion_b' => 'Arranque casi instantáneo y menor consumo de memoria RAM sin JIT.',
        'opcion_c' => 'Compatibilidad total con reflection sin necesidad de configuración.',
        'opcion_d' => 'Permite modificar el código en caliente sin detener el contenedor.',
        'respuesta_correcta' => 'B',
        'complejidad' => 'Senior',
        'explicacion' => 'La compilación AOT genera binarios ultrarrápidos ideales para Serverless.'
    ],
    700 => [
        'pregunta' => '¿Por qué se especifica rollbackFor = Exception.class en @Transactional?',
        'opcion_a' => 'Para forzar el reinicio del servidor web ante cualquier excepción.',
        'opcion_b' => 'Para ignorar excepciones no verificadas y confirmar los cambios.',
        'opcion_c' => 'Para revertir la transacción también ante excepciones verificadas (checked).',
        'opcion_d' => 'Para registrar errores en un archivo de bitácora independiente en disco.',
        'respuesta_correcta' => 'C',
        'complejidad' => 'Senior',
        'explicacion' => 'Por defecto Spring solo revierte ante RuntimeException y Error, no checked.'
    ],
    701 => [
        'pregunta' => '¿Cómo funciona la instrucción atómica Compare-And-Swap (CAS) en Java?',
        'opcion_a' => 'Bloquea todos los hilos del sistema operativo mientras actualiza.',
        'opcion_b' => 'Compara dos objetos y elimina el más antiguo para liberar memoria.',
        'opcion_c' => 'Copia el valor en disco duro antes de actualizar la variable en RAM.',
        'opcion_d' => 'Actualiza el valor en memoria solo si coincide con el valor esperado.',
        'respuesta_correcta' => 'D',
        'complejidad' => 'Senior',
        'explicacion' => 'CAS actualiza a nivel de CPU sin bloqueos si el valor actual coincide.'
    ]
];

$errors = [];
foreach ($new_42 as $id => $q) {
    $q_len = mb_strlen($q['pregunta'], 'UTF-8');
    $a_len = mb_strlen($q['opcion_a'], 'UTF-8');
    $b_len = mb_strlen($q['opcion_b'], 'UTF-8');
    $c_len = mb_strlen($q['opcion_c'], 'UTF-8');
    $d_len = mb_strlen($q['opcion_d'], 'UTF-8');
    $exp_len = mb_strlen($q['explicacion'], 'UTF-8');
    
    if ($q_len > 100) $errors[] = "ID $id: pregunta > 100 ($q_len)";
    if ($a_len > 90) $errors[] = "ID $id: opcion_a > 90 ($a_len)";
    if ($b_len > 90) $errors[] = "ID $id: opcion_b > 90 ($b_len)";
    if ($c_len > 90) $errors[] = "ID $id: opcion_c > 90 ($c_len)";
    if ($d_len > 90) $errors[] = "ID $id: opcion_d > 90 ($d_len)";
    if ($exp_len > 90) $errors[] = "ID $id: explicacion > 90 ($exp_len)";
}

echo "Total preguntas probadas: " . count($new_42) . "\n";
if (empty($errors)) {
    echo "¡TODAS LAS 42 PREGUNTAS CUMPLEN ESTRICTAMENTE PREGUNTA <= 100 Y OPCIONES/EXPLICACION <= 90!\n";
} else {
    echo "ERRORES ENCONTRADOS:\n" . implode("\n", $errors) . "\n";
}
