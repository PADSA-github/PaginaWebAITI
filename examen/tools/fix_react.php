<?php
$react_file = 'c:/workspace/PaginaWebAITI/examen/tools/builder_react.php';
require_once $react_file;

$valid_questions = [];
$original_questions = get_react_bank();

foreach ($original_questions as $q) {
    $q_len = mb_strlen($q['pregunta'], 'UTF-8');
    $opts = [
        mb_strlen($q['opcion_a'], 'UTF-8'),
        mb_strlen($q['opcion_b'], 'UTF-8'),
        mb_strlen($q['opcion_c'], 'UTF-8'),
        mb_strlen($q['opcion_d'], 'UTF-8')
    ];
    $exp_len = isset($q['explicacion']) ? mb_strlen($q['explicacion'], 'UTF-8') : 0;
    
    $violation = false;
    if ($q_len > 100) $violation = true;
    if (max($opts) > 90) $violation = true;
    if ($exp_len > 90) $violation = true;
    
    if (!$violation) {
        $valid_questions[] = $q;
    }
}

echo "Preguntas validas originales: " . count($valid_questions) . "\n";

$needed = 100 - count($valid_questions);
echo "Necesitamos generar: " . $needed . " preguntas.\n";

$new_questions = [
    ["¿Qué hook maneja el estado local?", "useState", "useEffect", "useRef", "useMemo", "A", "useState crea estado local."],
    ["¿Qué hook ejecuta efectos secundarios?", "useState", "useEffect", "useRef", "useMemo", "B", "useEffect maneja efectos secundarios."],
    ["¿Qué método de ciclo de vida equivale a useEffect con array vacío?", "componentDidMount", "render", "componentWillUnmount", "constructor", "A", "componentDidMount se ejecuta una vez."],
    ["¿Qué prop especial permite renderizar elementos hijos?", "children", "props", "elements", "nodes", "A", "La prop children pasa componentes hijos."],
    ["¿Cómo se actualiza el estado basado en el estado anterior?", "setState(prev => prev + 1)", "setState(state + 1)", "state = state + 1", "this.state++", "A", "Se usa una función callback en setState."],
    ["¿Qué hook memoriza un valor calculado?", "useMemo", "useCallback", "useRef", "useState", "A", "useMemo cachea valores calculados."],
    ["¿Qué hook memoriza una función?", "useMemo", "useCallback", "useRef", "useEffect", "B", "useCallback cachea referencias a funciones."],
    ["¿Qué herramienta empaqueta aplicaciones React?", "Webpack", "Babel", "ESLint", "Prettier", "A", "Webpack es un bundler de módulos."],
    ["¿Qué compilador transforma JSX en JavaScript?", "Babel", "Webpack", "NPM", "Node", "A", "Babel transpila JSX a JS estándar."],
    ["¿Qué biblioteca maneja rutas en React?", "React Router", "Redux", "Axios", "Next.js", "A", "React Router gestiona la navegación."],
    ["¿Qué estado global es muy popular en React?", "Redux", "Axios", "Jest", "Enzyme", "A", "Redux maneja el estado global complejo."],
    ["¿Qué atributo JSX reemplaza a class de HTML?", "className", "class", "css", "style", "A", "className se usa para evitar conflictos con JS."],
    ["¿Qué atributo JSX reemplaza a for de HTML?", "htmlFor", "for", "labelFor", "id", "A", "htmlFor se usa en lugar de for."],
    ["¿Qué hook permite referenciar un elemento del DOM?", "useRef", "useState", "useEffect", "useDOM", "A", "useRef guarda referencias mutables."],
    ["¿Qué componente de React Router envuelve toda la app?", "BrowserRouter", "Route", "Link", "Switch", "A", "BrowserRouter provee el contexto de rutas."],
    ["¿Cómo se llama el DOM virtual en React?", "Virtual DOM", "Shadow DOM", "Real DOM", "Document", "A", "React usa el Virtual DOM para optimizar."],
    ["¿Qué función compara el Virtual DOM con el real?", "Reconciliation", "Diffing", "Rendering", "Mounting", "A", "El proceso se llama Reconciliación."],
    ["¿Qué biblioteca se usa comúnmente para peticiones HTTP?", "Axios", "Redux", "Lodash", "Moment", "A", "Axios es un cliente HTTP basado en promesas."],
    ["¿Qué framework usa React para SSR?", "Next.js", "Create React App", "Gatsby", "Vite", "A", "Next.js permite renderizado en servidor."],
    ["¿Qué comando inicia una app con Vite?", "npm create vite@latest", "npx create-react-app", "npm start", "vite run", "A", "Vite es muy rápido para inicializar."],
    ["¿Qué atributo es obligatorio al iterar listas en JSX?", "key", "id", "index", "ref", "A", "La key ayuda a React a identificar elementos."],
    ["¿Qué hook se usa para suscribirse a un Contexto?", "useContext", "useState", "useProvider", "useReducer", "A", "useContext lee valores de un Provider."],
    ["¿Qué hook es una alternativa a useState para lógica compleja?", "useReducer", "useEffect", "useMemo", "useContext", "A", "useReducer maneja estados con acciones."],
    ["¿Qué patrón renderiza props como funciones?", "Render Props", "HOC", "Hooks", "Context", "A", "Render Props inyecta datos dinámicos."],
    ["¿Qué sigla significa Componente de Orden Superior?", "HOC", "JSX", "DOM", "SSR", "A", "Higher-Order Component envuelve componentes."],
    ["¿Qué etiqueta permite fragments sin importar React.Fragment?", "<></>", "<fragment>", "<temp>", "<div>", "A", "Sintaxis corta para fragmentos."],
    ["¿Qué hook se introdujo para manejar IDs únicos?", "useId", "useRef", "useUnique", "useKey", "A", "useId genera IDs estables (React 18)."],
    ["¿Qué función suspende el renderizado hasta que los datos carguen?", "Suspense", "Lazy", "Await", "Defer", "A", "Suspense muestra un fallback temporal."],
    ["¿Qué función carga componentes dinámicamente?", "React.lazy", "import", "dynamic", "Suspense", "A", "lazy() permite code-splitting."],
    ["¿Qué prop de Suspense define el contenido temporal?", "fallback", "loading", "placeholder", "spinner", "A", "fallback muestra la interfaz de carga."],
    ["¿Qué característica de React 18 agrupa actualizaciones de estado?", "Automatic Batching", "Concurrency", "Suspense", "Transitions", "A", "El batching reduce los re-renders."],
    ["¿Qué hook de React 18 marca actualizaciones como no urgentes?", "useTransition", "useDeferredValue", "useMemo", "useIdle", "A", "useTransition prioriza el renderizado."],
    ["¿Qué hook retrasa la actualización de un valor?", "useDeferredValue", "useTransition", "useMemo", "useRef", "A", "useDeferredValue permite render fluido."],
    ["¿Qué función de prueba viene por defecto en CRA?", "Jest", "Mocha", "Cypress", "Puppeteer", "A", "Jest es el test runner predeterminado."],
    ["¿Qué librería prueba componentes React de forma accesible?", "React Testing Library", "Enzyme", "Selenium", "Jest", "A", "RTL fomenta probar como un usuario real."],
    ["¿Qué hook permite insertar lógica antes de pintar la pantalla?", "useLayoutEffect", "useEffect", "usePaint", "useRender", "A", "useLayoutEffect es síncrono tras mutar el DOM."],
    ["¿Qué componente estricto de React avisa sobre código legado?", "StrictMode", "DebugMode", "SafeMode", "Profiler", "A", "StrictMode resalta problemas potenciales."],
    ["¿Qué API mide el rendimiento de renderizado?", "Profiler", "Performance", "Trace", "Profiler API", "A", "React Profiler mide tiempos de renderizado."],
    ["¿Cómo se evita que un componente funcional se re-renderice?", "React.memo", "useMemo", "PureComponent", "shouldUpdate", "A", "memo() hace una comparación superficial de props."],
    ["¿Qué librería permite escribir CSS en JS?", "Styled Components", "Sass", "Less", "CSS Modules", "A", "Styled Components usa template literals para CSS."],
    ["¿Qué framework estático basado en React es respaldado por Vercel?", "Next.js", "Gatsby", "Astro", "Remix", "A", "Next.js es creado por Vercel."],
    ["¿Qué herramienta sustituye a Webpack en Vite?", "Rollup", "Parcel", "Esbuild", "Babel", "A", "Vite usa Rollup para producción."],
    ["¿Qué librería facilita formularios complejos en React?", "React Hook Form", "Formik", "Redux Form", "Final Form", "A", "React Hook Form reduce re-renders en inputs."],
    ["¿Qué librería gestiona animaciones fluidas en React?", "Framer Motion", "React Transition", "Anime.js", "GSAP", "A", "Framer Motion es muy popular para animaciones."],
    ["¿Qué sistema de diseño de componentes es de Google?", "MUI (Material UI)", "Ant Design", "Chakra UI", "Bootstrap", "A", "MUI implementa Material Design en React."],
    ["¿Qué patrón divide código para carga diferida?", "Code Splitting", "Lazy Loading", "Dynamic Import", "Tree Shaking", "A", "Code splitting reduce el bundle inicial."],
    ["¿Qué técnica elimina código no utilizado del bundle?", "Tree Shaking", "Minification", "Uglify", "Compressing", "A", "Tree shaking limpia exportaciones muertas."],
    ["¿Qué es un componente que no maneja estado propio?", "Stateless Component", "Pure Component", "Dumb Component", "UI Component", "A", "También llamado componente presentacional."],
    ["¿Qué es un componente que gestiona lógica y estado?", "Stateful Component", "Smart Component", "Container", "Root", "A", "También conocido como componente contenedor."],
    ["¿Qué valor retorna useState por defecto si no se pasa argumento?", "undefined", "null", "false", "0", "A", "El estado inicial es undefined."],
    ["¿Se pueden usar Hooks dentro de bucles o condicionales?", "No", "Sí", "Depende", "Solo useEffect", "A", "Rompe las reglas de los Hooks."],
    ["¿Qué archivo de Next.js define las rutas de API?", "api/route.js", "server.js", "pages/api", "routes.js", "A", "App Router usa route.js para APIs."],
    ["¿Qué convención usa Next.js para rutas anidadas?", "Carpetas", "Archivos", "Configuración", "Decoradores", "A", "La estructura de carpetas define las rutas."],
    ["¿Qué es JSX?", "Sintaxis de extensión JS", "Un motor de plantillas", "HTML estricto", "Un lenguaje compilado", "A", "JSX extiende JS con sintaxis XML."],
    ["¿Qué método vinculaba this en componentes de clase?", "bind()", "call()", "apply()", "link()", "A", "Se usaba bind en el constructor para eventos."],
    ["¿Qué función define prop types en React legado?", "PropTypes", "TypeScript", "Flow", "Interfaces", "A", "PropTypes validaba tipos en tiempo de ejecución."],
    ["¿Qué librería se usa para tipado estático en React actual?", "TypeScript", "Flow", "PropTypes", "JSDoc", "A", "TypeScript es el estándar moderno."],
    ["¿Qué propiedad CSS se escribe como backgroundColor en JSX?", "background-color", "bgcolor", "background", "color", "A", "JSX usa camelCase para propiedades CSS."],
    ["¿Cómo se envían datos del hijo al padre en React?", "Callbacks en props", "Event Emitters", "Redux", "Context", "A", "El padre pasa una función callback como prop."],
    ["¿Qué librería maneja estado del servidor y caché?", "React Query", "Redux", "Zustand", "Context API", "A", "React Query gestiona el estado asíncrono remoto."],
    ["¿Qué estado maneja Zustand?", "Estado global simple", "Estado del servidor", "Rutas", "Formularios", "A", "Zustand es un gestor de estado ligero."],
    ["¿Qué librería moderna compite con Redux por simplicidad?", "Zustand", "MobX", "Recoil", "Jotai", "A", "Zustand es muy minimalista y usa hooks."],
    ["¿Qué es SSR?", "Server-Side Rendering", "Static Site React", "Single State Render", "Sync State React", "A", "Renderiza HTML en el servidor antes de enviar."],
    ["¿Qué es SSG?", "Static Site Generation", "Server Side GraphQL", "Single Site Generator", "Static State Git", "A", "Genera HTML en tiempo de construcción (build)."],
    ["¿Qué es CSR?", "Client-Side Rendering", "Cascading Style React", "Component Style Rule", "Client Server Route", "A", "React clásico donde el navegador dibuja todo."],
    ["¿Qué framework React es recomendado para sitios estáticos?", "Gatsby", "Next.js", "CRA", "Remix", "A", "Gatsby se enfoca en SSG con GraphQL."],
    ["¿Qué tipo de componente usa la palabra clave class?", "Class Component", "Functional Component", "Pure Component", "HOC", "A", "Son componentes legacy basados en clases."],
    ["¿Qué método de clase se llamaba al desmontar el componente?", "componentWillUnmount", "unmount", "destroy", "clean", "A", "Ideal para limpiar temporizadores y eventos."],
    ["¿Qué comando detiene la ejecución de useEffect?", "return () => {}", "stop()", "break", "clear()", "A", "Retornar una función sirve de cleanup."],
    ["¿Qué símbolo denota un fragmento vacío en JSX?", "<></>", "<!>", "<?>", "||", "A", "Es la sintaxis corta para Fragments."],
    ["¿Qué librería se usa para gráficos 3D en React?", "React Three Fiber", "D3.js", "Chart.js", "Three.js", "A", "Envuelve Three.js en componentes React."],
    ["¿Qué tecnología usa React Native para móviles?", "Puente JS (JS Bridge)", "WebViews", "HTML5", "WASM", "A", "Comunica JavaScript con hilos nativos móviles."]
];

for ($i = 0; $i < $needed; $i++) {
    $q_data = $new_questions[$i];
    $valid_questions[] = [
        'pregunta' => $q_data[0],
        'opcion_a' => $q_data[1],
        'opcion_b' => $q_data[2],
        'opcion_c' => $q_data[3],
        'opcion_d' => $q_data[4],
        'respuesta_correcta' => $q_data[5],
        'complejidad' => ($i % 3 === 0) ? 'Junior' : (($i % 3 === 1) ? 'Semi-Senior' : 'Senior'),
        'explicacion' => $q_data[6]
    ];
}

$exportContent = "<?php\n// Banco de REACT (Reescrito Automáticamente)\nfunction get_react_bank() {\n    return " . var_export($valid_questions, true) . ";\n}\n";

file_put_contents($react_file, $exportContent);

echo "React completamente reconstruido con 100 preguntas válidas.\n";
