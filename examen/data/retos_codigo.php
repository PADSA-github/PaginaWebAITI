<?php
// Banco de Retos de Código para Evaluación Técnica (2 puntos máx)
// Cada reto contiene código, la funcionalidad esperada y los conceptos clave para evaluación semántica

return [
    'java' => [
        [
            'titulo' => 'Procesamiento de Colecciones con Streams y Agrupación',
            'codigo' => <<<'JAVA'
public Map<String, Double> obtenerSalarioPromedioPorDepto(List<Empleado> empleados) {
    return empleados.stream()
        .filter(e -> e.isActivo() && e.getSalario() > 0)
        .collect(Collectors.groupingBy(
            Empleado::getDepartamento,
            Collectors.averagingDouble(Empleado::getSalario)
        ));
}
JAVA
            ,
            'funcionalidad_esperada' => 'Filtra los empleados que están activos y tienen salario mayor a cero, los agrupa por departamento y calcula el salario promedio de cada departamento, retornando un Map con el departamento como clave y el promedio como valor.',
            'conceptos_clave' => [
                'esenciales' => ['filtra', 'activos', 'agrupa', 'departamento', 'promedio', 'salario'],
                'secundarios' => ['map', 'stream', 'collectors', 'groupingby', 'averagingdouble', 'retorna', 'empleados'],
                'min_esenciales' => 3
            ]
        ],
        [
            'titulo' => 'Caché Concurrente Thread-Safe con ComputeIfAbsent',
            'codigo' => <<<'JAVA'
public class ReportService {
    private final ConcurrentMap<String, CompletableFuture<byte[]>> cache = new ConcurrentHashMap<>();

    public CompletableFuture<byte[]> getReportAsync(String reportId) {
        return cache.computeIfAbsent(reportId, id -> 
            CompletableFuture.supplyAsync(() -> generateHeavyReport(id))
        );
    }
}
JAVA
            ,
            'funcionalidad_esperada' => 'Implementa una caché concurrente en memoria para reportes pesados. Si el reporte ya fue solicitado o generado, reutiliza el resultado futuro; si no existe, lo genera de forma asíncrona en segundo plano sin bloquear hilos concurrentes.',
            'conceptos_clave' => [
                'esenciales' => ['cache', 'asincrono', 'asincrona', 'concurrente', 'reporte', 'hilos'],
                'secundarios' => ['completablefuture', 'concurrenthashmap', 'computeifabsent', 'evita', 'bloquear', 'memoria', 'reutiliza'],
                'min_esenciales' => 3
            ]
        ]
    ],
    'react' => [
        [
            'titulo' => 'Custom Hook de Debounce con Cancelación',
            'codigo' => <<<'JSX'
function useDebounce(value, delay = 500) {
    const [debouncedValue, setDebouncedValue] = useState(value);

    useEffect(() => {
        const handler = setTimeout(() => {
            setDebouncedValue(value);
        }, delay);

        return () => {
            clearTimeout(handler);
        };
    }, [value, delay]);

    return debouncedValue;
}
JSX
            ,
            'funcionalidad_esperada' => 'Es un hook personalizado que retrasa la actualización del valor (debounce) hasta que transcurre el tiempo especificado (delay) sin nuevos cambios. Si el valor cambia antes de que termine el tiempo, limpia el temporizador anterior y programa uno nuevo.',
            'conceptos_clave' => [
                'esenciales' => ['debounce', 'retrasa', 'espera', 'delay', 'temporizador', 'timeout', 'limpia', 'cancela'],
                'secundarios' => ['useeffect', 'usestate', 'hook', 'cleanup', 'cleartimeout', 'settimeout', 'actualiza'],
                'min_esenciales' => 3
            ]
        ],
        [
            'titulo' => 'Petición Asíncrona con AbortController en Hook',
            'codigo' => <<<'JSX'
function useFetchData(url) {
    const [data, setData] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const controller = new AbortController();
        setLoading(true);

        fetch(url, { signal: controller.signal })
            .then(res => res.json())
            .then(data => setData(data))
            .catch(err => {
                if (err.name !== 'AbortError') console.error(err);
            })
            .finally(() => setLoading(false));

        return () => controller.abort();
    }, [url]);

    return { data, loading };
}
JSX
            ,
            'funcionalidad_esperada' => 'Realiza peticiones HTTP para obtener datos de una URL gestionando estados de carga y datos, cancelando la petición en curso mediante AbortController si el componente se desmonta o si la URL cambia antes de recibir respuesta.',
            'conceptos_clave' => [
                'esenciales' => ['peticion', 'fetch', 'cancela', 'abort', 'url', 'loading', 'carga'],
                'secundarios' => ['abortcontroller', 'desmonta', 'effect', 'signal', 'json', 'aborterror'],
                'min_esenciales' => 3
            ]
        ]
    ],
    'cobol' => [
        [
            'titulo' => 'Lectura Secuencial con Acumuladores y Corte de Control',
            'codigo' => <<<'COBOL'
    PROCESAR-VENTAS.
        READ ARCHIVO-VENTAS
            AT END MOVE 'SI' TO WS-FIN-ARCHIVO
            NOT AT END
                IF COD-SUCURSAL = WS-SUCURSAL-ACTUAL
                    ADD IMPORTE-VENTA TO WS-TOTAL-SUCURSAL
                    ADD 1 TO WS-CONTADOR-TRANS
                ELSE
                    PERFORM IMPRIMIR-TOTAL-SUCURSAL
                    MOVE COD-SUCURSAL TO WS-SUCURSAL-ACTUAL
                    MOVE IMPORTE-VENTA TO WS-TOTAL-SUCURSAL
                    MOVE 1 TO WS-CONTADOR-TRANS
                END-IF
        END-READ.
COBOL
            ,
            'funcionalidad_esperada' => 'Lee secuencialmente registros de un archivo de ventas. Si la sucursal coincide con la actual, acumula el importe y suma una transacción. Si la sucursal cambia (corte de control), imprime el subtotal de la sucursal anterior y reinicia los acumuladores para la nueva sucursal.',
            'conceptos_clave' => [
                'esenciales' => ['corte de control', 'sucursal', 'acumula', 'suma', 'total', 'lee', 'archivo', 'ventas'],
                'secundarios' => ['subtotal', 'reinicia', 'contador', 'control break', 'read', 'perform'],
                'min_esenciales' => 3
            ]
        ],
        [
            'titulo' => 'Actualización Transaccional VSAM con Control de Estado',
            'codigo' => <<<'COBOL'
    ACTUALIZAR-SALDO.
        MOVE WS-NUMERO-CUENTA TO CLAVE-CUENTA
        READ ARCHIVO-CUENTAS
            INVALID KEY
                DISPLAY 'ERROR: CUENTA NO EXISTE'
            NOT INVALID KEY
                COMPUTE SALDO-CUENTA = SALDO-CUENTA + WS-MONTO-DEPOSITO
                REWRITE REG-CUENTA
                    INVALID KEY
                        DISPLAY 'ERROR AL REESCRIBIR REGISTRO'
                    NOT INVALID KEY
                        MOVE 'ACTUALIZACION EXITOSA' TO WS-MENSAJE
                END-REWRITE
        END-READ.
COBOL
            ,
            'funcionalidad_esperada' => 'Busca un registro de cuenta bancaria por su clave en un archivo VSAM indexado. Si no existe, muestra un mensaje de error. Si existe, suma el monto del depósito al saldo y reescribe (REWRITE) el registro actualizado en el archivo, confirmando la operación.',
            'conceptos_clave' => [
                'esenciales' => ['saldo', 'cuenta', 'deposito', 'actualiza', 'reescribe', 'rewrite', 'vsam', 'busca'],
                'secundarios' => ['invalid key', 'clave', 'archivo', 'read', 'error', 'compute'],
                'min_esenciales' => 3
            ]
        ]
    ],
    'informix' => [
        [
            'titulo' => 'Recorrido de Cursor 4GL con Actualización WHERE CURRENT OF',
            'codigo' => <<<'INFORMIX'
FUNCTION actualizar_pedidos_saldados()
    DEFINE l_pedido_id INTEGER,
           l_saldo     DECIMAL(10,2)

    DECLARE c_pedidos CURSOR FOR
        SELECT pedido_id, saldo FROM pedidos
        WHERE estado = 'PENDIENTE'
        FOR UPDATE

    FOREACH c_pedidos INTO l_pedido_id, l_saldo
        IF l_saldo <= 0 THEN
            UPDATE pedidos
               SET estado = 'PAGADO',
                   fecha_pago = TODAY
             WHERE CURRENT OF c_pedidos
        END IF
    END FOREACH
END FUNCTION
INFORMIX
            ,
            'funcionalidad_esperada' => 'Declara y recorre un cursor sobre los pedidos pendientes habilitado para actualización (FOR UPDATE). Para cada pedido, verifica si el saldo es menor o igual a cero y actualiza el estado a PAGADO y la fecha a TODAY usando WHERE CURRENT OF sobre el registro actual.',
            'conceptos_clave' => [
                'esenciales' => ['cursor', 'foreach', 'actualiza', 'update', 'pedidos', 'where current of', 'saldo', 'pagado'],
                'secundarios' => ['pendiente', 'today', 'for update', 'declare', 'fecha', 'estado'],
                'min_esenciales' => 3
            ]
        ],
        [
            'titulo' => 'Control Transaccional en Informix 4GL con Validación de status',
            'codigo' => <<<'INFORMIX'
FUNCTION registrar_movimiento(p_cuenta, p_monto)
    DEFINE p_cuenta INTEGER,
           p_monto  DECIMAL(12,2)

    WHENEVER ERROR CONTINUE
    BEGIN WORK
    
    INSERT INTO movimientos (cuenta_id, monto, fecha)
    VALUES (p_cuenta, p_monto, CURRENT YEAR TO SECOND)

    IF status = 0 THEN
        UPDATE cuentas
           SET saldo = saldo + p_monto
         WHERE cuenta_id = p_cuenta
         
        IF status = 0 THEN
            COMMIT WORK
            RETURN 1
        ELSE
            ROLLBACK WORK
            RETURN 0
        END IF
    ELSE
        ROLLBACK WORK
        RETURN 0
    END IF
END FUNCTION
INFORMIX
            ,
            'funcionalidad_esperada' => 'Ejecuta una operación transaccional atómica con BEGIN WORK insertando un movimiento y actualizando el saldo de la cuenta. Evalúa la variable status en cada paso; si ambas sentencias tienen éxito confirma con COMMIT WORK y retorna 1; ante cualquier fallo ejecuta ROLLBACK WORK y retorna 0.',
            'conceptos_clave' => [
                'esenciales' => ['transaccion', 'begin work', 'commit work', 'rollback work', 'status', 'movimiento', 'saldo', 'cuenta'],
                'secundarios' => ['whenever error', 'insert', 'update', 'atomica', 'revierte', 'confirma'],
                'min_esenciales' => 3
            ]
        ]
    ],
    'cloud_ia' => [
        [
            'titulo' => 'Pipeline de Recuperación y Síntesis RAG con Cloud LLM',
            'codigo' => <<<'PYTHON'
def consultar_asistente_rag(pregunta_usuario: str, top_k: int = 3) -> str:
    # 1. Generar embedding vectorial de la consulta
    query_vector = cloud_client.embeddings.create(
        model="text-embedding-3-small",
        input=pregunta_usuario
    ).data[0].embedding

    # 2. Búsqueda por similitud coseno en base vectorial
    fragmentos = vector_db.similarity_search_by_vector(query_vector, k=top_k)
    contexto = "\n---\n".join([doc.page_content for doc in fragmentos])

    # 3. Inyección del contexto en el prompt para inferencia
    system_prompt = f"Responde a la pregunta basándote estrictamente en el siguiente contexto:\n{contexto}"
    respuesta = cloud_client.chat.completions.create(
        model="gpt-4o",
        messages=[
            {"role": "system", "content": system_prompt},
            {"role": "user", "content": pregunta_usuario}
        ],
        temperature=0.2
    )
    return respuesta.choices[0].message.content
PYTHON
            ,
            'funcionalidad_esperada' => 'Implementa un flujo RAG (Retrieval-Augmented Generation): genera el embedding de la pregunta del usuario, busca los fragmentos más similares en la base de datos vectorial y los inyecta como contexto fundamentado en el prompt de sistema del modelo de lenguaje para generar una respuesta fáctica.',
            'conceptos_clave' => [
                'esenciales' => ['rag', 'embedding', 'vectorial', 'contexto', 'prompt', 'similitud', 'recupera', 'llm'],
                'secundarios' => ['vector_db', 'similarity_search', 'temperature', 'tokens', 'gpt', 'system'],
                'min_esenciales' => 3
            ]
        ],
        [
            'titulo' => 'Invocación de Herramientas Estructuradas con Function Calling',
            'codigo' => <<<'PYTHON'
def ejecutar_agente_con_herramientas(prompt_usuario: str):
    tools = [{
        "type": "function",
        "function": {
            "name": "consultar_saldo_bancario",
            "description": "Obtiene el saldo disponible de una cuenta de cliente",
            "parameters": {
                "type": "object",
                "properties": {"numero_cuenta": {"type": "string"}},
                "required": ["numero_cuenta"]
            }
        }
    }]

    response = cloud_ai.chat.create(
        model="claude-3-5-sonnet",
        messages=[{"role": "user", "content": prompt_usuario}],
        tools=tools
    )

    if response.tool_calls:
        call = response.tool_calls[0]
        args = json.loads(call.function.arguments)
        resultado = api_banco.get_saldo(args["numero_cuenta"])
        return f"Saldo verificado: {resultado}"
    
    return response.content
PYTHON
            ,
            'funcionalidad_esperada' => 'Configura una herramienta externa con esquema JSON en una llamada al modelo en la nube. Si el modelo detecta que la consulta requiere invocar la función (tool_calls), extrae los argumentos estructurados generados en JSON, ejecuta la API bancaria correspondiente y retorna el saldo obtenido.',
            'conceptos_clave' => [
                'esenciales' => ['function calling', 'tool', 'herramienta', 'json', 'argumentos', 'saldo', 'cuenta', 'api'],
                'secundarios' => ['tool_calls', 'schema', 'properties', 'ejecuta', 'modelo', 'llm'],
                'min_esenciales' => 3
            ]
        ]
    ]
];

