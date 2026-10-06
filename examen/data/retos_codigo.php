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
    ]
];
