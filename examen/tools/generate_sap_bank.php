<?php
// Generador y compilador del Banco de Preguntas de SAP (Core Retail y SAP CAR)
header('Content-Type: text/plain; charset=utf-8');

$raw_questions = [
    // =========================================================================
    // PARTE 1: SAP MÓDULOS CORE (RETAIL, MM, SD, FI/CO, ABAP) - 50 PREGUNTAS
    // =========================================================================

    // --- SAP CORE JUNIOR (17 Preguntas) ---
    [
        'pregunta' => '¿Qué define a un artículo genérico (Generic Article) en SAP Retail?',
        'opcion_a' => 'Un artículo maestro que agrupa variantes según atributos como talla o color.',
        'opcion_b' => 'Un producto sin código EAN asignado que se vende exclusivamente a granel.',
        'opcion_c' => 'Un servicio comercial que no gestiona inventario ni centros de costo.',
        'opcion_d' => 'Un material estándar de compras que no puede distribuirse a tiendas físicas.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'El artículo genérico centraliza compras y agrupa variantes con dimensiones específicas.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué transacción en SAP MM se utiliza para consultar el resumen de stocks?',
        'opcion_a' => 'MMBE.',
        'opcion_b' => 'ME23N.',
        'opcion_c' => 'MD04.',
        'opcion_d' => 'MIGO.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'MMBE muestra el stock por empresa, centro, almacén y tipo de stock en tiempo real.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué representa un Centro tipo Tienda (Store - Tipo B) en SAP Retail?',
        'opcion_a' => 'Un centro logístico minorista con maestro de cliente y deudor asociado.',
        'opcion_b' => 'Un almacén virtual exclusivo para mermas y devoluciones de proveedores.',
        'opcion_c' => 'Una entidad financiera que solo emite comprobantes fiscales sin inventario.',
        'opcion_d' => 'Un centro de distribución regional que no permite ventas al consumidor final.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'Las tiendas operan como centro receptor de mercancía y emisor de ventas con cliente asignado.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Cuál es la función del cálculo de precios de venta (VKP5) en SAP Retail?',
        'opcion_a' => 'Determinar y actualizar los precios de venta al consumidor en tiendas.',
        'opcion_b' => 'Calcular automáticamente la liquidación de impuestos anuales de la empresa.',
        'opcion_c' => 'Establecer los salarios y comisiones de los cajeros en punto de venta.',
        'opcion_d' => 'Generar pedidos de traslado entre centros de distribución y almacenes.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'VKP5 permite simular y activar condiciones de precio final respetando márgenes comerciales.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué transacción en SAP MM se utiliza para crear un pedido de compras?',
        'opcion_a' => 'ME21N.',
        'opcion_b' => 'VA01.',
        'opcion_c' => 'VL01N.',
        'opcion_d' => 'MIRO.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'ME21N es la transacción estándar para la creación de órdenes de compra a proveedores.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué es un artículo estructurado tipo "Set de Venta" en SAP Retail?',
        'opcion_a' => 'Conjunto de artículos individuales vendidos juntos bajo un único precio.',
        'opcion_b' => 'Un artículo que no requiere código de barras para ser cobrado en caja.',
        'opcion_c' => 'Un lote de mercancía defectuosa destinado a destrucción en almacén.',
        'opcion_d' => 'Un grupo de proveedores que comparten el mismo contrato marco de entrega.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'Un Set agrupa componentes que se cobran como un paquete único en el punto de venta.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Cuál es el objetivo principal del Listado de Artículos (Listing - WSM3)?',
        'opcion_a' => 'Autorizar qué artículos pueden comprarse, venderse y recibirse en cada tienda.',
        'opcion_b' => 'Crear copias de seguridad de las bases de datos contables de cada centro.',
        'opcion_c' => 'Registrar el horario de apertura y cierre de las cajas registradoras.',
        'opcion_d' => 'Bloquear el acceso de usuarios no autorizados a la red inalámbrica de tienda.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'Si un artículo no está listado para un centro, el sistema no permite movimientos ni ventas.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué nivel jerárquico agrupa artículos con propiedades comerciales similares?',
        'opcion_a' => 'Grupo o Categoría de Mercancías (Merchandise Category).',
        'opcion_b' => 'Canal de distribución mayorista.',
        'opcion_c' => 'Sociedad de consolidación fiscal.',
        'opcion_d' => 'Puesto de expedición de planta.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'La Merchandise Category clasifica los productos para compras, inventarios y análisis.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => 'En SAP SD, ¿qué documento formaliza la obligación de pago del cliente?',
        'opcion_a' => 'La Factura de Ventas (Billing Document / VF01).',
        'opcion_b' => 'La Cotización preliminar de servicios.',
        'opcion_c' => 'El Pedido de cliente abierto en borrador.',
        'opcion_d' => 'La Orden de transporte de almacén.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'La factura comercial genera los asientos contables en cuentas por cobrar e impuestos.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué movimiento estándar en MIGO registra la recepción de un pedido de compra?',
        'opcion_a' => 'Movimiento 101.',
        'opcion_b' => 'Movimiento 201.',
        'opcion_c' => 'Movimiento 311.',
        'opcion_d' => 'Movimiento 601.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'El movimiento 101 incrementa el stock de libre utilización y registra el pasivo en EM/RF.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué tipo de artículo estructurado representa un mueble exhibidor promocional?',
        'opcion_a' => 'Display (exhibidor con surtido predefinido para piso de venta).',
        'opcion_b' => 'Artículo genérico con curvas de talla.',
        'opcion_c' => 'Material consumible de oficina.',
        'opcion_d' => 'Repuesto mecánico de maquinaria.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'Un Display contiene unidades surtidas listas para colocarse directamente en el piso.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué módulo de SAP gestiona la contabilidad general e impuestos en tiendas?',
        'opcion_a' => 'SAP FI (Financial Accounting).',
        'opcion_b' => 'SAP PM (Plant Maintenance).',
        'opcion_c' => 'SAP PP (Production Planning).',
        'opcion_d' => 'SAP QM (Quality Management).',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'SAP FI registra asientos de ingresos, cuentas por cobrar, bancos e impuestos por tienda.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué tabla del diccionario de datos almacena los datos generales del artículo?',
        'opcion_a' => 'MARA.',
        'opcion_b' => 'VBAK.',
        'opcion_c' => 'BSEG.',
        'opcion_d' => 'EKKO.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'MARA almacena las propiedades universales del material independientes del centro logístico.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué es un Prepack en la gestión de calzado y moda en SAP Retail?',
        'opcion_a' => 'Combinación preempacada de variantes de fábrica que se compra como unidad.',
        'opcion_b' => 'Un vale de descuento impreso para canjear en la siguiente visita.',
        'opcion_c' => 'Un lote vencido que debe ser devuelto inmediatamente al fabricante.',
        'opcion_d' => 'Un tipo de etiqueta térmica para marcar precios en góndolas.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'Los Prepacks agrupan una distribución fija de tallas para simplificar la logística.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué transacción se utiliza para verificar facturas logísticas de proveedores?',
        'opcion_a' => 'MIRO.',
        'opcion_b' => 'VA02.',
        'opcion_c' => 'FB08.',
        'opcion_d' => 'LS24.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'MIRO valida las facturas de proveedores contra los pedidos y entradas de mercancía.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué documento logístico refleja la salida física de mercancía para despacho?',
        'opcion_a' => 'Entrega de salida (Outbound Delivery) con salida de mercancías.',
        'opcion_b' => 'Solicitud de pedido en borrador.',
        'opcion_c' => 'Contrato de transporte provisional.',
        'opcion_d' => 'Asiento de diario informativo.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'La entrega de salida gestiona picking, packing y la contabilización del consumo de stock.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué campo en MARA identifica el tipo de artículo en SAP Retail?',
        'opcion_a' => 'ATTYP.',
        'opcion_b' => 'MATNR.',
        'opcion_c' => 'WERKS.',
        'opcion_d' => 'LGORT.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'ATTYP distingue artículos simples (00), genéricos (01), variantes (02) y estructurados.',
        'tema' => 'sap_core'
    ],

    // --- SAP CORE SEMI-SENIOR (17 Preguntas) ---
    [
        'pregunta' => '¿Cómo opera un Pedido de Traslado (Stock Transport Order - STO) en Retail?',
        'opcion_a' => 'Transfiere stock de un CD a tienda generando entrega y documento de transporte.',
        'opcion_b' => 'Elimina el stock de la base de datos sin requerir confirmación física.',
        'opcion_c' => 'Convierte compras nacionales en compras de importación sin intermediarios.',
        'opcion_d' => 'Genera facturas comerciales directas sin contabilizar movimientos de inventario.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'El STO asegura trazabilidad completa del inventario en tránsito entre centros de la empresa.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué mecanismo utiliza SAP SD para calcular precios y descuentos en pedidos?',
        'opcion_a' => 'Esquema de Cálculo (Pricing Procedure) con clases de condición y accesos.',
        'opcion_b' => 'Un script de shell que lee archivos de texto estáticos en el servidor.',
        'opcion_c' => 'Una consulta SQL directa sobre tablas temporales de navegador web.',
        'opcion_d' => 'Una hoja de cálculo importada manualmente por el operador de compras.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'La técnica de condiciones evalúa secuencias de acceso para determinar precios e impuestos.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿En qué consiste la estrategia de Cross-Docking en Centros de Distribución?',
        'opcion_a' => 'Traspasar mercancía de recepción a muelles de salida sin almacenaje intermedio.',
        'opcion_b' => 'Almacenar productos de baja rotación en silos automáticos subterráneos.',
        'opcion_c' => 'Vender mercancía defectuosa a empresas de reciclaje de materiales.',
        'opcion_d' => 'Consolidar pedidos online exclusivamente en tiendas físicas periféricas.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Cross-docking minimiza costos de manipulación y reduce el tiempo de reposición a tiendas.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué tabla registra las asignaciones activas de artículos listados por tienda?',
        'opcion_a' => 'WLK1.',
        'opcion_b' => 'VBRK.',
        'opcion_c' => 'BKPF.',
        'opcion_d' => 'LFA1.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'WLK1 guarda el periodo de vigencia del listado de cada artículo por surtido y centro.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué función cumple la cuenta de compensación EM/RF (GR/IR) en compras?',
        'opcion_a' => 'Servir de cuenta puente entre la entrada de mercancía y la recepción de factura.',
        'opcion_b' => 'Registrar el fondo de caja chica asignado a los supervisores de turno.',
        'opcion_c' => 'Cobrar intereses moratorios a clientes minoristas con crédito vencido.',
        'opcion_d' => 'Almacenar retenciones fiscales por concepto de nómina de empleados.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'EM/RF se acredita en MIGO y se debita en MIRO, cuadrando partidas pendientes.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => 'En SAP Retail, ¿cuál es la diferencia clave entre un centro tipo A y tipo B?',
        'opcion_a' => 'El tipo A es Centro de Distribución y el tipo B es Tienda minorista.',
        'opcion_b' => 'El tipo A solo maneja servicios y el tipo B solo materias primas industriales.',
        'opcion_c' => 'El tipo A no tiene almacenes físicos y el tipo B opera solo virtualmente.',
        'opcion_d' => 'El tipo A pertenece a terceros y el tipo B pertenece al corporativo.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'La categoría de centro define su comportamiento comercial, logístico y de surtido.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué BAPI estándar se utiliza para crear pedidos de ventas masivos en SD?',
        'opcion_a' => 'BAPI_SALESORDER_CREATEFROMDAT2.',
        'opcion_b' => 'BAPI_PO_CREATE1.',
        'opcion_c' => 'BAPI_TRANSACTION_ROLLBACK.',
        'opcion_d' => 'BAPI_GOODSMVT_CREATE.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Permite generar pedidos de venta completos con cabecera, posiciones, socios y precios.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué tabla reemplazó a KONV en S/4HANA para elementos de condición de precio?',
        'opcion_a' => 'PRCD_ELEMENTS.',
        'opcion_b' => 'CDPOS.',
        'opcion_c' => 'ACDOCA.',
        'opcion_d' => 'MATDOC.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'PRCD_ELEMENTS es la tabla transparente que optimiza condiciones en memoria en HANA.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué función cumple la transacción WAK1 / WAK2 en SAP Retail?',
        'opcion_a' => 'Crear y planificar promociones de venta con precios y vigencias especiales.',
        'opcion_b' => 'Auditar las llamadas telefónicas de atención al cliente de garantías.',
        'opcion_c' => 'Configurar los tipos de cambio bancarios para compras internacionales.',
        'opcion_d' => 'Dar de baja activos fijos obsoletos en instalaciones de sucursales.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'WAK1 define promociones de temporada, descuentos temporales y surtidos asignados.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => 'En SAP FI, ¿cómo se compensan habitualmente los cobros con tarjetas bancarias?',
        'opcion_a' => 'Mediante cuentas transitorias compensadas al procesar el extracto bancario.',
        'opcion_b' => 'Cargando directamente a pérdidas y ganancias en el cierre mensual.',
        'opcion_c' => 'Emitiendo notas de débito automáticas al proveedor de hardware POS.',
        'opcion_d' => 'Descontando el saldo contra la cuenta de amortización de activos fijos.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Los cobros de tarjetas se registran en tránsito hasta conciliar el pago de los adquirentes.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué proceso asegura que los precios de venta respeten el margen comercial mínimo?',
        'opcion_a' => 'Cálculo de precios en dos pasos (Two-step price calculation) en VKP5.',
        'opcion_b' => 'Replicación masiva de tablas sin reglas de validación en segundo plano.',
        'opcion_c' => 'Asignación manual de números de lote en la recepción de mercancías.',
        'opcion_d' => 'Bloqueo temporal de transferencias electrónicas en el módulo bancario.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Calcula el precio de venta considerando precio de compra, costos adicionales y margen.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué tipo de posición en SD se utiliza para venta de mercancía en consignación?',
        'opcion_a' => 'KEN (Toma de consignación).',
        'opcion_b' => 'TAN (Posición estándar de venta).',
        'opcion_c' => 'TATX (Texto informativo sin entrega).',
        'opcion_d' => 'AFN (Consulta de ventas no vinculante).',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'KEN extrae la mercancía del stock especial de consignación y genera factura al cliente.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Cómo se registran los movimientos de efectivo menores en tienda en SAP ERP?',
        'opcion_a' => 'Mediante el Libro de Caja (Cash Journal - transacción FBCJ).',
        'opcion_b' => 'Creando órdenes de producción discretas para gastos operativos.',
        'opcion_c' => 'Emitiendo órdenes de mantenimiento correctivo a transportistas.',
        'opcion_d' => 'Modificando la lista de materiales de artículos terminados.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'FBCJ registra cobros y pagos en efectivo en caja con comprobantes inmediatos.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué ventaja aporta el modelo Business Partner (BP) en S/4HANA Retail?',
        'opcion_a' => 'Unifica maestros de clientes, proveedores y tiendas bajo una sola entidad.',
        'opcion_b' => 'Elimina la necesidad de utilizar cuentas contables en libros de mayor.',
        'opcion_c' => 'Permite operar bases de datos relacionales sin llaves primarias en tablas.',
        'opcion_d' => 'Duplica los registros de transacciones para garantizar alta disponibilidad.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'El objeto BP gestiona múltiples roles (cliente, proveedor) sin redundancia de datos.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué clase de movimiento se usa en MIGO para registrar merma o desecho en tienda?',
        'opcion_a' => 'Movimiento 551.',
        'opcion_b' => 'Movimiento 261.',
        'opcion_c' => 'Movimiento 301.',
        'opcion_d' => 'Movimiento 122.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'El movimiento 551 reduce el inventario imputando el costo a una cuenta de pérdidas por merma.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué tecnología ABAP en S/4HANA se recomienda para reporting analítico en memoria?',
        'opcion_a' => 'Vistas CDS (Core Data Services).',
        'opcion_b' => 'Programas clásicos con sentencias WRITE.',
        'opcion_c' => 'Vistas lógicas de bases de datos LDB obsoletas.',
        'opcion_d' => 'Archivos de exportación CSV almacenados en servidor.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'CDS traslada el procesamiento de agregaciones y filtros directamente a la memoria de HANA.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué representa el surtido general (General Assortment) en SAP Retail?',
        'opcion_a' => 'Surtido asociado a un centro con artículos autorizados de forma permanente.',
        'opcion_b' => 'Una lista provisional de productos que expiran en menos de veinticuatro horas.',
        'opcion_c' => 'Un catálogo público impreso para distribuir en buzones residenciales.',
        'opcion_d' => 'Un registro de artículos donados a instituciones de beneficencia pública.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Cada centro tiene un surtido general que define los productos base de su oferta comercial.',
        'tema' => 'sap_core'
    ],

    // --- SAP CORE SENIOR (16 Preguntas) ---
    [
        'pregunta' => '¿Cómo opera el reabastecimiento multinivel en una red retail compleja con MRP?',
        'opcion_a' => 'Genera STOs del CD a tiendas y pedidos de compra consolidados a proveedores.',
        'opcion_b' => 'Envía alertas a clientes finales para que compren productos en otras tiendas.',
        'opcion_c' => 'Pausa todas las ventas en cajas hasta que el inventario físico llegue a cero.',
        'opcion_d' => 'Cancela automáticamente los pedidos que tengan más de tres días de creados.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'El MRP multinivel coordina la demanda de tiendas con compras centralizadas del CD.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué consecuencia inmediata tiene desactivar un artículo en la tabla WLK1 para un centro?',
        'opcion_a' => 'Impide compras, recepciones y bloquea la venta del artículo en ese centro.',
        'opcion_b' => 'Borra físicamente todos los registros contables históricos de la empresa.',
        'opcion_c' => 'Desconecta los servidores de la tienda de la red corporativa central.',
        'opcion_d' => 'Convierte el artículo en un activo intangible de amortización acelerada.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Al cerrarse el listado en WLK1, las funciones de compras y ventas quedan inhabilitadas.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => 'En S/4HANA Retail, ¿qué técnica previene bloqueos de tablas en facturación masiva?',
        'opcion_a' => 'Desacoplamiento de contabilización y procesamiento en paralelo de entregas.',
        'opcion_b' => 'Uso de un único usuario genérico que procese todas las órdenes secuencialmente.',
        'opcion_c' => 'Eliminación permanente de las llaves primarias en tablas de documentos.',
        'opcion_d' => 'Desactivación de los registros de auditoría y controles fiscales del sistema.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Procesa paquetes asíncronos distribuidos en memoria reduciendo bloqueos en ACDOCA/VBRK.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Cómo optimiza SAP Retail la valoración de inventarios por el método Retail (RVM)?',
        'opcion_a' => 'Valora el stock total a precio de venta aplicando márgenes por categoría.',
        'opcion_b' => 'Calcula el costo sumando manualmente las notas de remisión de proveedores.',
        'opcion_c' => 'Establece un precio fijo inmutable durante diez años para todo el inventario.',
        'opcion_d' => 'Reemplaza la valoración en dinero por conteo de volumen cúbico de almacén.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'RVM permite estimar el costo de stocks masivos cuando no es viable rastrear costo unitario.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => 'En integración POS-ERP, ¿cuál es la diferencia clave entre IDocs WPUUMS y WPUBON?',
        'opcion_a' => 'WPUUMS envía ventas agregadas por artículo; WPUBON envía detalle por ticket.',
        'opcion_b' => 'WPUUMS solo procesa devoluciones; WPUBON solo procesa cobros en efectivo.',
        'opcion_c' => 'WPUUMS se utiliza en banca; WPUBON se utiliza en manufactura pesada.',
        'opcion_d' => 'WPUUMS no genera asientos contables; WPUBON solo genera archivos de texto.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'WPUUMS reduce el volumen de documentos en FI/MM; WPUBON mantiene trazabilidad unitaria.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Cómo se gestionan los acuerdos de rappel con proveedores en S/4HANA Retail?',
        'opcion_a' => 'Mediante Settlement Management con Contratos de Condición (transacción WCOCO).',
        'opcion_b' => 'Creando órdenes de producción de mantenimiento preventivo de plantas.',
        'opcion_c' => 'Enviando correos electrónicos no estructurados al departamento de tesorería.',
        'opcion_d' => 'Modificando directamente los campos de costo estándar en tablas maestras.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Condition Contracts sustituyó los acuerdos de rappel clásicos con liquidación flexible.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué User Exit en el include MV45AFZZ permite validar campos antes de guardar pedidos?',
        'opcion_a' => 'USEREXIT_SAVE_DOCUMENT_PREPARE.',
        'opcion_b' => 'USEREXIT_PRICING_RULE.',
        'opcion_c' => 'USEREXIT_DELETE_DOCUMENT.',
        'opcion_d' => 'USEREXIT_PRINT_LABEL.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Permite realizar validaciones finales y modificar datos antes del COMMIT de base de datos.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué tabla contiene los parámetros logísticos del artículo específicos por centro?',
        'opcion_a' => 'MARC.',
        'opcion_b' => 'KNA1.',
        'opcion_c' => 'T001W.',
        'opcion_d' => 'VBAK.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'MARC contiene datos de reabastecimiento, stock de seguridad y control de calidad por centro.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Por qué en arquitecturas de alto volumen se evita la facturación síncrona desde POS?',
        'opcion_a' => 'Para evitar contención en rangos de números y bloqueos de tablas contables.',
        'opcion_b' => 'Porque el protocolo TCP/IP no soporta transmisión de datos bancarios.',
        'opcion_c' => 'Porque las cajas registradoras no pueden conectarse a redes de fibra óptica.',
        'opcion_d' => 'Porque la legislación prohíbe emitir facturas en horarios no laborales.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'La agregación y el procesamiento asíncrono protegen el rendimiento del ERP central.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Cómo opera la explosión de listas de materiales en artículos estructurados tipo Set?',
        'opcion_a' => 'Descuenta stock de componentes manteniendo el precio consolidado en cabecera.',
        'opcion_b' => 'Cobra cada componente por separado duplicando los impuestos aplicables.',
        'opcion_c' => 'Bloquea el inventario de todas las tiendas de la cadena simultáneamente.',
        'opcion_d' => 'Obliga al cliente a comprar únicamente artículos de la misma marca comercial.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'La explosión de BOM en ventas garantiza stock correcto sin alterar el precio ofertado.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Cómo determina SAP Retail automáticamente la fuente de aprovisionamiento interna?',
        'opcion_a' => 'Evaluando registros info, contratos marco y priorizando el CD regional asignado.',
        'opcion_b' => 'Seleccionando al azar cualquier centro sin verificar existencias físicas.',
        'opcion_c' => 'Consultando el inventario de tiendas de la competencia en sitios web públicos.',
        'opcion_d' => 'Pausando el pedido hasta que un analista ingrese manualmente la ruta de camiones.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'La determinación de fuente automatiza si el surtido viene de almacén central o proveedor DSD.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué tipo de IDoc transmite modificaciones masivas de precios y artículos a tiendas?',
        'opcion_a' => 'WP_PLU03.',
        'opcion_b' => 'FIDCCP01.',
        'opcion_c' => 'DESADV01.',
        'opcion_d' => 'INVOIC02.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'WP_PLU03 es el estándar para actualizar maestros de artículos y códigos PLU en POS.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => 'En Controlling (CO-PA), ¿cómo se modela la rentabilidad real por tienda física?',
        'opcion_a' => 'Asignando el centro como objeto de imputación y deduciendo costos directos.',
        'opcion_b' => 'Dividiendo las ganancias corporativas entre el número total de cajeros.',
        'opcion_c' => 'Estimando ventas con base en el tráfico peatonal reportado por encuestas.',
        'opcion_d' => 'Multiplicando los metros cuadrados del local por el valor de avalúo catastral.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Permite analizar márgenes brutos y operativos por formato, tienda y línea de productos.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Cómo se habilita la venta con inventario negativo controlado en retail de conveniencia?',
        'opcion_a' => 'Configurando permiso de stock negativo en centro/almacén regularizado con compras.',
        'opcion_b' => 'Modificando la base de datos para omitir comprobaciones de integridad.',
        'opcion_c' => 'Creando artículos ficticios sin costo que se eliminan al final de la jornada.',
        'opcion_d' => 'Desactivando la contabilidad financiera de partidas abiertas en la empresa.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Permite no detener ventas en caja cuando la recepción física llegó antes que el documento en ERP.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué tabla unificada de S/4HANA almacena las partidas individuales contables y de control?',
        'opcion_a' => 'ACDOCA (Universal Journal).',
        'opcion_b' => 'GLT0.',
        'opcion_c' => 'COEP.',
        'opcion_d' => 'BSIS.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'ACDOCA combina datos de FI, CO, AA y rentabilidad en una sola fuente de la verdad.',
        'tema' => 'sap_core'
    ],
    [
        'pregunta' => '¿Qué mecanismo en ABAP garantiza idempotencia al recibir órdenes EDI de múltiples canales?',
        'opcion_a' => 'Validación de número de pedido externo del cliente en cabecera con bloqueo transaccional.',
        'opcion_b' => 'Generación de nombres de archivo aleatorios sin validar contenido previo.',
        'opcion_c' => 'Reescritura de los identificadores de cliente en cada solicitud entrante.',
        'opcion_d' => 'Ejecución de procesos sin confirmación de base de datos para ganar velocidad.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Evita duplicidad de pedidos e-commerce verificando el purchase order number de origen.',
        'tema' => 'sap_core'
    ],

    // =========================================================================
    // PARTE 2: SAP CAR (CUSTOMER ACTIVITY REPOSITORY & RETAIL) - 50 PREGUNTAS
    // =========================================================================

    // --- SAP CAR JUNIOR (17 Preguntas) ---
    [
        'pregunta' => '¿Cuál es el objetivo primordial de SAP Customer Activity Repository (CAR)?',
        'opcion_a' => 'Centralizar y auditar transacciones omnicanal en tiempo real sobre SAP HANA.',
        'opcion_b' => 'Diseñar páginas web estáticas con plantillas de comercio electrónico.',
        'opcion_c' => 'Administrar los turnos de limpieza y mantenimiento de pisos de venta.',
        'opcion_d' => 'Reemplazar los sistemas operativos de servidores locales de tiendas.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'SAP CAR unifica datos de ventas físicas y digitales para auditoría, pronóstico y disponibilidad.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué componente de SAP CAR procesa, audita y valida los tickets de venta de tiendas?',
        'opcion_a' => 'POS Data Transfer and Audit (POS DTA).',
        'opcion_b' => 'SAP Extended Warehouse Management.',
        'opcion_c' => 'SAP Human Capital Management.',
        'opcion_d' => 'SAP Product Lifecycle Management.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'POS DTA recibe las transacciones de cajas, valida su consistencia y prepara su integración.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué transacción se utiliza como consola central de auditoría en POS DTA?',
        'opcion_a' => '/POSDW/MON0 (POS Workbench).',
        'opcion_b' => 'SM59.',
        'opcion_c' => 'AL08.',
        'opcion_d' => 'ST22.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => '/POSDW/MON0 permite revisar tickets por tienda, fecha, caja, estado de auditoría y tareas.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué base de datos in-memory es requisito técnico indispensable para SAP CAR?',
        'opcion_a' => 'SAP HANA.',
        'opcion_b' => 'Oracle Database Standard Edition.',
        'opcion_c' => 'Microsoft Access 2016.',
        'opcion_d' => 'SQLite embebido en navegador.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'CAR requiere SAP HANA para ejecutar algoritmos predictivos y consultas analíticas masivas.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué sub-módulo de SAP CAR proporciona el motor de pronóstico de demanda retail?',
        'opcion_a' => 'Unified Demand Forecast (UDF).',
        'opcion_b' => 'SAP SuccessFactors.',
        'opcion_c' => 'SAP Concur Expense.',
        'opcion_d' => 'SAP Business Network.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'UDF utiliza modelos bayesianos en SAP HANA para predecir la demanda de clientes por artículo.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En la estructura de transacción POS de CAR, ¿dónde se guardan los medios de pago?',
        'opcion_a' => 'En el segmento de Tenders (medios de pago).',
        'opcion_b' => 'En la tabla de especificaciones técnicas de producto.',
        'opcion_c' => 'En el encabezado de configuración de idioma del cajero.',
        'opcion_d' => 'En el registro de proveedores de suministros de cómputo.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'El segmento Tender almacena efectivo, tarjetas bancarias, vales o cupones utilizados.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué es Omnichannel Promotion Pricing (OPP) en SAP CAR?',
        'opcion_a' => 'Un motor central que calcula precios promocionales idénticos en todos los canales.',
        'opcion_b' => 'Un módulo contable para liquidar nóminas de personal eventual de temporada.',
        'opcion_c' => 'Un servicio web para comprar espacios publicitarios en redes sociales.',
        'opcion_d' => 'Un software de impresión de carteles de descuento en formato PDF.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'OPP garantiza que las promociones se apliquen igual en tiendas físicas, app y e-commerce.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué función tiene Demand Data Foundation (DDF) en SAP CAR?',
        'opcion_a' => 'Almacenar datos maestros de artículos, centros y promociones para UDF y planning.',
        'opcion_b' => 'Gestionar la seguridad perimetral contra intrusiones de red en tiendas.',
        'opcion_c' => 'Enviar facturas electrónicas a clientes mediante mensajes SMS.',
        'opcion_d' => 'Crear copias de seguridad de audio de grabaciones telefónicas de quejas.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'DDF es la capa de persistencia armonizada que nutre a los motores de planificación y pronóstico.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué tarea de auditoría en POS DTA detecta si un ticket se recibió dos veces?',
        'opcion_a' => 'Duplicate Transaction Check.',
        'opcion_b' => 'Cash Journal Audit.',
        'opcion_c' => 'Credit Card Batch Settlement.',
        'opcion_d' => 'Physical Inventory Count.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'Compara tienda, caja, fecha y número consecutivo para marcar tickets duplicados.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En POS DTA, ¿qué tipo de transacción POS representa una devolución de mercancía?',
        'opcion_a' => 'Return Transaction.',
        'opcion_b' => 'Sales Order Inquiry.',
        'opcion_c' => 'Quotation Delivery.',
        'opcion_d' => 'Maintenance Request.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'Identifica que el cliente reintegró artículos a la tienda, generando reintegro de pago.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué indica el estado de tarea "Completed" (código 3) en /POSDW/MON0?',
        'opcion_a' => 'La tarea de auditoría o procesamiento se ejecutó con éxito.',
        'opcion_b' => 'La tarea fue abortada por falta de espacio en disco en el servidor.',
        'opcion_c' => 'El cajero solicitó un cambio de turno antes de terminar la jornada.',
        'opcion_d' => 'La conexión entre la caja y el servidor se encuentra temporalmente caída.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'El estatus 3 confirma que la tarea finalizó satisfactoriamente sin generar errores.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué microservicio de OPP calcula precios de promociones para e-commerce o apps?',
        'opcion_a' => 'Promotion Pricing Service (PPS).',
        'opcion_b' => 'SAP Cloud Connector Agent.',
        'opcion_c' => 'Internet Information Services Daemon.',
        'opcion_d' => 'Print Spooler Manager.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'PPS calcula en milisegundos las reglas promocionales de carritos de compra digitales.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En SAP CAR, ¿qué componente calcula la disponibilidad omnicanal para venta?',
        'opcion_a' => 'Omnichannel Article Availability and Sourcing (OAA).',
        'opcion_b' => 'SAP Treasury Risk Management.',
        'opcion_c' => 'SAP Business Warehouse Accelerator.',
        'opcion_d' => 'SAP Solution Manager Diagnostics.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'OAA calcula el stock libre disponible en tiendas y centros de distribución para la venta web.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué herramienta se usa para replicar datos maestros de ERP a SAP CAR en tiempo real?',
        'opcion_a' => 'SAP Landscape Transformation Replication Server (SLT).',
        'opcion_b' => 'Envío de correos electrónicos con archivos adjuntos comprimidos.',
        'opcion_c' => 'Copia manual con memorias USB en cada sucursal de la empresa.',
        'opcion_d' => 'Descarga periódica mediante protocolo FTP no cifrado.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'SLT captura deltas basados en triggers en el ERP y los inserta inmediatamente en HANA CAR.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué representa un "Void" en el procesamiento de transacciones de punto de venta?',
        'opcion_a' => 'La anulación de una posición o de un ticket completo por error del cajero.',
        'opcion_b' => 'El pago de la nómina semanal del encargado de piso de venta.',
        'opcion_c' => 'La autorización de crédito preferencial para clientes frecuentes.',
        'opcion_d' => 'El cambio de bobina de papel térmico de la impresora de tickets.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'Los Voids deben ser auditados para asegurar que no existan fraudes o desajustes de inventario.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Cuál es la ventaja de la base in-memory de SAP CAR para cadenas de retail masivo?',
        'opcion_a' => 'Procesa millones de transacciones diarias y genera analíticos inmediatos.',
        'opcion_b' => 'Permite prescindir de licencias de software y contratos de soporte.',
        'opcion_c' => 'Elimina la necesidad de computadoras en las cajas registradoras de tienda.',
        'opcion_d' => 'Convierte las impresoras tradicionales en impresoras 3D de productos.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'La velocidad de HANA permite auditar ventas y actualizar stock en tiempo casi real.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué módulo de CAR alerta si un producto de alta rotación no se está vendiendo?',
        'opcion_a' => 'On-Shelf Availability (OSA).',
        'opcion_b' => 'SAP Audit Management.',
        'opcion_c' => 'SAP Identity Management.',
        'opcion_d' => 'SAP Landscape Management.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Junior',
        'explicacion' => 'OSA detecta falta de ventas anómalas en productos clave, sugiriendo góndolas vacías.',
        'tema' => 'sap_car'
    ],

    // --- SAP CAR SEMI-SENIOR (16 Preguntas) ---
    [
        'pregunta' => 'En POS DTA, ¿qué verificación ejecuta la tarea de auditoría "Balance Check"?',
        'opcion_a' => 'Comprueba que el total de artículos más impuestos sea igual a los pagos recibidos.',
        'opcion_b' => 'Revisa que la tienda tenga fondos suficientes en su cuenta bancaria corriente.',
        'opcion_c' => 'Calcula el promedio de comisiones de venta pagadas a cada cajero.',
        'opcion_d' => 'Verifica que la temperatura de los refrigeradores se mantenga constante.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Asegura que el ticket esté matemáticamente cuadrado antes de enviarlo a contabilidad.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Cuál es la ventaja de enviar ventas agregadas (WPUUMS) frente a ticket por ticket?',
        'opcion_a' => 'Reduce significativamente el volumen de documentos y bloqueos en ERP.',
        'opcion_b' => 'Permite cancelar transacciones individuales sin dejar registro de auditoría.',
        'opcion_c' => 'Evita el pago de impuestos estatales en ventas de artículos perecederos.',
        'opcion_d' => 'Hace innecesario conciliar los medios de pago con las instituciones bancarias.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'WPUUMS resume las cantidades vendidas por artículo por día/tienda, aliviando la BD del ERP.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En UDF, ¿qué es un Factor de Influencia de la Demanda (DIF)?',
        'opcion_a' => 'Variable como promociones, precios o festividades que altera el patrón de compra.',
        'opcion_b' => 'Un error en el disco duro que daña las series de tiempo almacenadas.',
        'opcion_c' => 'Un indicador financiero de solvencia que emite el banco central del país.',
        'opcion_d' => 'Una clave de acceso cifrada para ingresar al panel de administración técnica.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Los DIFs permiten al modelo matemático aislar y predecir el impacto de promociones y clima.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Cómo gestiona UDF los desabastos (quiebres de stock) al modelar la demanda?',
        'opcion_a' => 'Estima las ventas perdidas (Lost Sales) para no subestimar la demanda futura.',
        'opcion_b' => 'Asume que los clientes perdieron interés y reduce el pronóstico a cero.',
        'opcion_c' => 'Crea pedidos de compra automáticos sin validar presupuesto disponible.',
        'opcion_d' => 'Borra del catálogo el artículo que se quedó sin existencias físicas.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Si hubo desabasto, la venta fue cero pero la demanda real no; UDF corrige esa distorsión.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué función cumple el Rough Stock Indicator (RSI) en SAP OAA?',
        'opcion_a' => 'Genera semáforos de disponibilidad para catálogos web de alta concurrencia.',
        'opcion_b' => 'Calcula el peso total de la mercancía para contratar camiones de carga.',
        'opcion_c' => 'Determina la depreciación contable de estanterías en tiendas físicas.',
        'opcion_d' => 'Asigna códigos de barras provisionales a productos sin empaque original.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'El RSI clasifica el stock en verde, amarillo y rojo para responder a millones de hits web.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En POS DTA, ¿qué tabla almacena el registro transaccional plano de ventas?',
        'opcion_a' => '/POSDW/TLOGF.',
        'opcion_b' => 'BSIS.',
        'opcion_c' => 'COEP.',
        'opcion_d' => 'CDHDR.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => '/POSDW/TLOGF guarda el Transaction Log en formato aplanado para alta velocidad de ingesta.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué BAdI en POS DTA permite transformar y enriquecer datos en la ingesta?',
        'opcion_a' => '/POSDW/BADI_RFINS.',
        'opcion_b' => 'BADI_MATERIAL_CHECK.',
        'opcion_c' => 'BADI_ACC_DOCUMENT.',
        'opcion_d' => 'BADI_CUSTOMER_ADD_DATA.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => '/POSDW/BADI_RFINS intercepta la transacción cruda de POS antes de grabarla en el log de CAR.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En OPP, ¿qué estándar de la industria minorista modela las reglas de promoción?',
        'opcion_a' => 'Estándar OASIS ARTS (Association for Retail Technology Standards).',
        'opcion_b' => 'Norma ISO 9001 de gestión de calidad.',
        'opcion_c' => 'Protocolo IEEE 802.11 de comunicaciones.',
        'opcion_d' => 'Estándar ANSI C de compilación de código.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'ARTS define la estructura XML/JSON unificada para promociones complejas en retail.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Cómo evita OAA que dos compradores web adquieran la última unidad disponible?',
        'opcion_a' => 'Creando reservas temporales (Temporary Reservations) durante el checkout.',
        'opcion_b' => 'Bloqueando el acceso a la tienda online a usuarios de ciertas regiones.',
        'opcion_c' => 'Obligando a los clientes a pagar exclusivamente con depósito en efectivo.',
        'opcion_d' => 'Cancelando ambos pedidos y emitiendo notas de crédito compensatorias.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Las reservas temporales congelan el stock por unos minutos mientras se procesa el pago.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué biblioteca matemática de SAP HANA ejecuta los algoritmos de UDF?',
        'opcion_a' => 'SAP HANA PAL (Predictive Analysis Library).',
        'opcion_b' => 'jQuery UI Framework.',
        'opcion_c' => 'Apache Lucene Engine.',
        'opcion_d' => 'Node.js Express Module.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'PAL corre de manera nativa en el motor C++ de HANA para cálculos estadísticos en paralelo.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En POS DTA, ¿qué inconsistencia detecta la tarea "Gap Check"?',
        'opcion_a' => 'Saltos o números faltantes en la secuencia consecutiva de tickets de una caja.',
        'opcion_b' => 'Diferencias en los precios de compra pactados con proveedores extranjeros.',
        'opcion_c' => 'Falta de sellos fiscales en documentos de importación de aduanas.',
        'opcion_d' => 'Retrasos en la entrega de uniformes al personal de seguridad de tiendas.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'El Gap Check alerta si se omitió un ticket entre dos transacciones correlativas.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Cómo opera el Promotion Pricing Service (PPS) en modo embebido en la caja registradora?',
        'opcion_a' => 'Calcula promociones localmente en caja incluso sin conexión a internet.',
        'opcion_b' => 'Transmite cada clic del mouse al centro de cómputo corporativo central.',
        'opcion_c' => 'Apaga la pantalla de la caja si la transacción supera cierto monto fijado.',
        'opcion_d' => 'Imprime cupones de lotería estatal al finalizar cada cobro en efectivo.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'El motor PPS local consume las promociones sincronizadas previamente para operar offline.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En SAP CAR, ¿qué información almacena Multichannel Sales Repository (MCSR)?',
        'opcion_a' => 'Todas las transacciones de venta sin importar si fueron físicas o en línea.',
        'opcion_b' => 'Los curriculum vitae de los candidatos a puestos de cajeros en tienda.',
        'opcion_c' => 'Las grabaciones de video del circuito cerrado de vigilancia de tiendas.',
        'opcion_d' => 'Los contratos de arrendamiento de locales comerciales de la cadena.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'MCSR es el almacén central de ventas unificadas para analítica omnicanal en tiempo real.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué tipo de promoción OPP otorga beneficio al comprar artículos combinados?',
        'opcion_a' => 'Promoción tipo Mix and Match.',
        'opcion_b' => 'Descuento por método de pago bancario.',
        'opcion_c' => 'Aumento de precio por horario pico.',
        'opcion_d' => 'Cobro de comisión por empaque biodegradable.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'Mix and Match permite combinar productos de distintas líneas con descuento unificado.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué IDoc de salida de POS DTA contabiliza cobros y medios de pago en FI?',
        'opcion_a' => 'WPUTAB.',
        'opcion_b' => 'ORDERS05.',
        'opcion_c' => 'DELVRY03.',
        'opcion_d' => 'CREMAS01.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'WPUTAB transfiere los desgloses de tarjetas, efectivo y vales a las cuentas contables de FI.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En Demand Data Foundation (DDF), ¿qué modela la entidad "Offer"?',
        'opcion_a' => 'Promociones comerciales con vigencia, condiciones de precio y productos.',
        'opcion_b' => 'Presupuestos de gastos de viaje de ejecutivos comerciales.',
        'opcion_c' => 'Solicitudes de contratación de nuevo personal administrativo.',
        'opcion_d' => 'Listados de refacciones para camiones de distribución regional.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Semi-Senior',
        'explicacion' => 'La entidad Offer estructura las campañas promocionales que consumen UDF y OPP.',
        'tema' => 'sap_car'
    ],

    // --- SAP CAR SENIOR (17 Preguntas) ---
    [
        'pregunta' => 'En eventos masivos como Black Friday, ¿cómo se optimiza la ingesta en POS DTA?',
        'opcion_a' => 'Ingesta masiva en /POSDW/TLOGF desacoplada de tareas de auditoría en batch.',
        'opcion_b' => 'Pausa total de la base de datos hasta que termine la venta en tiendas.',
        'opcion_c' => 'Eliminación del cálculo de impuestos en todas las cajas registradoras.',
        'opcion_d' => 'Ejecución de auditorías síncronas bloqueando la caja en cada venta.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Separar la recepción plana (/POSDW/TLOGF) del procesamiento analítico evita cuellos de botella.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Cómo determina OAA el nodo óptimo de despacho para pedidos e-commerce?',
        'opcion_a' => 'Aplica estrategias de sourcing basadas en proximidad, stock libre y costo.',
        'opcion_b' => 'Envía siempre el pedido al centro de distribución más lejano del cliente.',
        'opcion_c' => 'Obliga al cliente a recoger la mercancía en oficinas corporativas centrales.',
        'opcion_d' => 'Asigna el pedido a la tienda que tenga menos empleados contratados.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'OAA optimiza si despachar desde tienda cercana (Ship-from-Store) o desde almacén central.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En UDF, ¿cuál es la diferencia conceptual entre Demand Estimating y Forecasting?',
        'opcion_a' => 'Estimating pondera factores pasados; Forecasting proyecta la demanda futura.',
        'opcion_b' => 'Estimating solo calcula compras; Forecasting solo calcula devoluciones de clientes.',
        'opcion_c' => 'Estimating se ejecuta en el ERP; Forecasting se ejecuta en hojas de cálculo.',
        'opcion_d' => 'Estimating borra registros históricos; Forecasting genera facturas fiscales.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'La estimación calibra el modelo con ventas históricas; el pronóstico predice ventas futuras.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué regla aplica OPP cuando dos promociones no combinables aplican a un artículo?',
        'opcion_a' => 'Regla de Mejor Precio (Best Price) aplicando el mayor ahorro al cliente.',
        'opcion_b' => 'Suma ambos descuentos superando el valor original del producto.',
        'opcion_c' => 'Cancela la venta y expulsa al usuario del portal de compras web.',
        'opcion_d' => 'Aplica el precio más caro ignorando los descuentos configurados.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'OPP resuelve conflictos seleccionando la promoción que otorga mayor beneficio al cliente.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Cómo se concilia el inventario vendido en CAR contra el stock de SAP ERP?',
        'opcion_a' => 'Comparando los movimientos de salida agregados de CAR contra los PGIs en ERP.',
        'opcion_b' => 'Restando las ventas de CAR únicamente a fin de año en un asiento manual.',
        'opcion_c' => 'Contando físicamente todos los artículos de las tiendas cada cuatro horas.',
        'opcion_d' => 'Suponiendo que el inventario en tienda no varía con las ventas de caja.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'La auditoría de interfaces coteja que cada ticket de CAR tenga su reflejo contable en ERP.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En SAP CAR, ¿qué rol técnico juegan las vistas CDS Virtual Data Model (VDM)?',
        'opcion_a' => 'Proveer capas semánticas de reporting en tiempo real sin duplicar datos en tablas.',
        'opcion_b' => 'Generar scripts de respaldo en cinta magnética fuera de las instalaciones.',
        'opcion_c' => 'Bloquear el acceso de usuarios con contraseñas que tengan números repetidos.',
        'opcion_d' => 'Crear interfaces gráficas para terminales móviles con pantallas monocromáticas.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Las vistas VDM leen los datos transaccionales en memoria ofreciendo KPIs instantáneos.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué debe ocurrir en POS DTA si se recibe un Post-Void de un ticket ya enviado a ERP?',
        'opcion_a' => 'Ejecutar una tarea de compensación o reversa en el ERP para anular el impacto.',
        'opcion_b' => 'Ignorar la anulación y dejar que el cliente asuma el cargo duplicado.',
        'opcion_c' => 'Borrar el ticket de la base de datos de CAR sin notificar a contabilidad.',
        'opcion_d' => 'Bloquear la terminal de cobro hasta que un auditor visite la sucursal.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'El Post-Void debe generar el movimiento inverso en ERP para mantener la consistencia contable.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Cómo emplea el módulo On-Shelf Availability (OSA) el análisis de patrones?',
        'opcion_a' => 'Identifica pausas anómalas en ventas de alta rotación para alertar góndolas vacías.',
        'opcion_b' => 'Reconoce rostros de compradores habituales para ofrecerles cupones en caja.',
        'opcion_c' => 'Mide la velocidad del viento en el estacionamiento para evitar accidentes.',
        'opcion_d' => 'Detecta si los cajeros ingresaron productos con las dos manos o con una.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Si un artículo que se vende cada diez minutos deja de venderse, OSA infiere estante vacío.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En OAA, ¿cómo se asegura que el stock de CAR refleje los movimientos de ERP?',
        'opcion_a' => 'Mediante sincronización periódica de deltas de stock o eventos vía SLT.',
        'opcion_b' => 'Cargando manualmente planillas Excel al inicio de cada turno comercial.',
        'opcion_c' => 'Conectando directamente los sensores de las estanterías por Bluetooth.',
        'opcion_d' => 'Reescribiendo la tabla de artículos en cada orden de compra generada.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'La sincronización de deltas actualiza el ATP de CAR garantizando visibilidad en la tienda web.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Por qué la tabla /POSDW/TLOGF almacena los tickets en formato plano?',
        'opcion_a' => 'Para maximizar el throughput de inserción masiva sin costo de desnormalización.',
        'opcion_b' => 'Porque el motor de base de datos no soporta tablas con más de dos columnas.',
        'opcion_c' => 'Para evitar que los auditores externos puedan leer los montos de ventas.',
        'opcion_d' => 'Para comprimir los archivos de texto y enviarlos por fax a las sucursales.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'La estructura plana agiliza la escritura masiva en memoria durante picos de venta.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En UDF, ¿cómo se tratan las ventas atípicas de una compra institucional única?',
        'opcion_a' => 'Se detectan como valores atípicos (Outliers) y se limpian de la serie base.',
        'opcion_b' => 'Se multiplican por diez para elevar artificialmente el pronóstico anual.',
        'opcion_c' => 'Se eliminan junto con los datos de todos los clientes de la tienda.',
        'opcion_d' => 'Se registran como faltantes de caja en la contabilidad general de FI.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'La detección de outliers evita que compras esporádicas provoquen sobre-stock en compras.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué parámetro determina la duración de una reserva temporal en SAP OAA?',
        'opcion_a' => 'El Time-to-Live (TTL) configurado en el perfil de sourcing omnicanal.',
        'opcion_b' => 'El saldo disponible en la tarjeta de crédito del comprador web.',
        'opcion_c' => 'La velocidad de conexión a internet del dispositivo del cliente.',
        'opcion_d' => 'El número de visitas que recibe la página del producto al día.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'El TTL libera automáticamente las reservas si el usuario no concreta la compra en el plazo.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Cómo se conecta SAP CAR con herramientas analíticas como SAP Analytics Cloud?',
        'opcion_a' => 'Mediante conexiones Live sobre vistas de cálculo en memoria de SAP HANA.',
        'opcion_b' => 'Exportando archivos de texto delimitados por comas a carpetas compartidas.',
        'opcion_c' => 'Imprimiendo los tableros y enviándolos físicamente por paquetería.',
        'opcion_d' => 'Creando réplicas de datos en bases de datos de texto no estructuradas.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Las conexiones Live consultan directamente los datos de CAR sin replicación intermedia.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En POS DTA, ¿cómo se garantiza la segregación de funciones entre tiendas?',
        'opcion_a' => 'Asignando objetos de autorización por ID de tienda, canal y rol de usuario.',
        'opcion_b' => 'Instalando una base de datos SAP HANA física distinta en cada tienda.',
        'opcion_c' => 'Cambiando las contraseñas de red cada tres minutos en toda la empresa.',
        'opcion_d' => 'Desconectando las tiendas entre sí para que no compartan servidores.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Los objetos de autorización aseguran que el gerente de tienda solo visualice sus propios tickets.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué ventaja ofrece SAP CAR Replenishment Planning frente al MRP clásico de ERP?',
        'opcion_a' => 'Utiliza pronósticos probabilísticos de UDF considerando capacidad de góndola.',
        'opcion_b' => 'Calcula compras asumiendo que la demanda de todos los productos es constante.',
        'opcion_c' => 'Permite comprar sin autorización de presupuesto ni supervisión financiera.',
        'opcion_d' => 'Envía solicitudes de compra a los proveedores mediante llamadas telefónicas.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'Integra distribución de probabilidades de demanda y restricciones de espacio de tienda.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => 'En OPP, ¿cómo se envían las reglas promocionales a tiendas con baja conectividad?',
        'opcion_a' => 'Exportando el repositorio de promociones hacia motores PPS locales en JSON.',
        'opcion_b' => 'Dictando las fórmulas de descuento por teléfono al supervisor de cajas.',
        'opcion_c' => 'Pausando las promociones hasta que la tienda cuente con fibra óptica.',
        'opcion_d' => 'Imprimiendo hojas de cálculo para que los cajeros apliquen descuentos a mano.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'El motor PPS local consume las promociones offline manteniendo consistencia omnicanal.',
        'tema' => 'sap_car'
    ],
    [
        'pregunta' => '¿Qué mecanismo garantiza idempotencia en la recepción de tickets POS hacia CAR?',
        'opcion_a' => 'Llave compuesta por Store ID, Workstation ID, Business Date y Sequence Number.',
        'opcion_b' => 'Asignación de números aleatorios generados por la memoria de la impresora.',
        'opcion_c' => 'Uso de la dirección IP pública del enrutador de internet de la tienda.',
        'opcion_d' => 'Registro exclusivo del apellido del cajero en turno sin marcas de tiempo.',
        'respuesta_correcta' => 'A',
        'complejidad' => 'Senior',
        'explicacion' => 'La combinación única de estos cuatro campos previene procesar el mismo ticket más de una vez.',
        'tema' => 'sap_car'
    ]
];

// Validación de cantidad de preguntas
echo "Total de preguntas definidas: " . count($raw_questions) . "\n";
if (count($raw_questions) !== 100) {
    die("ERROR: Se esperaban 100 preguntas exactas.\n");
}

// Balanceo estricto de opciones A, B, C, D (25 de cada una exactamente)
$targets = ['A', 'B', 'C', 'D'];
$counts = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0];
$complexities = ['Junior' => 0, 'Semi-Senior' => 0, 'Senior' => 0];
$temas = ['sap_core' => 0, 'sap_car' => 0];

$final_questions = [];

foreach ($raw_questions as $idx => $q) {
    $desiredLetter = $targets[$idx % 4];
    $currentLetter = strtoupper(trim($q['respuesta_correcta']));

    if ($currentLetter !== $desiredLetter) {
        $curKey = 'opcion_' . strtolower($currentLetter);
        $desKey = 'opcion_' . strtolower($desiredLetter);

        $temp = $q[$desKey];
        $q[$desKey] = $q[$curKey];
        $q[$curKey] = $temp;

        $q['respuesta_correcta'] = $desiredLetter;
    }

    $counts[$q['respuesta_correcta']]++;
    $complexities[$q['complejidad']]++;
    $temas[$q['tema']]++;

    $final_questions[$idx] = [
        'pregunta' => $q['pregunta'],
        'opcion_a' => $q['opcion_a'],
        'opcion_b' => $q['opcion_b'],
        'opcion_c' => $q['opcion_c'],
        'opcion_d' => $q['opcion_d'],
        'respuesta_correcta' => $q['respuesta_correcta'],
        'complejidad' => $q['complejidad'],
        'explicacion' => $q['explicacion'],
        'tema' => $q['tema']
    ];
}

echo "Desglose por letra de respuesta:\n";
print_r($counts);
echo "Desglose por complejidad:\n";
print_r($complexities);
echo "Desglose por tema:\n";
print_r($temas);

// Generar archivo de datos examen/data/sap_preguntas.php
$data_file = dirname(__DIR__) . '/data/sap_preguntas.php';
$content_data = "<?php\nreturn " . var_export($final_questions, true) . ";\n";
file_put_contents($data_file, $content_data);
echo "[OK] Archivo generado: $data_file\n";

// Generar archivo builder examen/tools/builder_sap.php
$builder_file = __DIR__ . '/builder_sap.php';
$content_builder = "<?php\nfunction get_sap_bank() {\n    return " . var_export($final_questions, true) . ";\n}\n";
file_put_contents($builder_file, $content_builder);
echo "[OK] Archivo generado: $builder_file\n";

echo "¡Banco de SAP generado con éxito!\n";

