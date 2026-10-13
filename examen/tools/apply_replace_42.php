<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/validate_new_42.php';

// $new_42 is available from validate_new_42.php
$stmt = $conecction->prepare("UPDATE preguntas_examen SET 
    pregunta = ?, 
    opcion_a = ?, 
    opcion_b = ?, 
    opcion_c = ?, 
    opcion_d = ?, 
    respuesta_correcta = ?, 
    complejidad = ?, 
    explicacion = ? 
    WHERE id = ? AND lenguaje = 'java'");

if (!$stmt) {
    die("Error prepare: " . $conecction->error . "\n");
}

$updated = 0;
foreach ($new_42 as $id => $data) {
    $stmt->bind_param(
        'ssssssssi',
        $data['pregunta'],
        $data['opcion_a'],
        $data['opcion_b'],
        $data['opcion_c'],
        $data['opcion_d'],
        $data['respuesta_correcta'],
        $data['complejidad'],
        $data['explicacion'],
        $id
    );
    if ($stmt->execute()) {
        $updated++;
    } else {
        echo "Error en ID $id: " . $stmt->error . "\n";
    }
}
$stmt->close();

echo "Se actualizaron con éxito $updated de " . count($new_42) . " preguntas en la base de datos.\n";

// Verificar el conteo que dio 42 antes:
$res42 = $conecction->query("SELECT COUNT(*) FROM preguntas_examen WHERE lenguaje = 'java' AND (LENGTH(pregunta) > 100 AND (LENGTH(opcion_a) > 90 OR LENGTH(opcion_b) > 90 OR LENGTH(opcion_c) > 90 OR LENGTH(opcion_d) > 90))");
echo "Conteo de la condición original (42): " . $res42->fetch_row()[0] . "\n";

// Verificar las 42 actualizadas
$ids_str = implode(',', array_keys($new_42));
$resCheck = $conecction->query("SELECT id, 
    CHAR_LENGTH(pregunta) as q_len, 
    GREATEST(CHAR_LENGTH(opcion_a), CHAR_LENGTH(opcion_b), CHAR_LENGTH(opcion_c), CHAR_LENGTH(opcion_d)) as max_opt,
    CHAR_LENGTH(explicacion) as exp_len
    FROM preguntas_examen WHERE id IN ($ids_str)");

$viol_after = 0;
while ($r = $resCheck->fetch_assoc()) {
    if ($r['q_len'] > 100 || $r['max_opt'] > 90 || $r['exp_len'] > 90) {
        $viol_after++;
        echo "VIOLACION en ID {$r['id']}: Q={$r['q_len']}, Opt={$r['max_opt']}, Exp={$r['exp_len']}\n";
    }
}
echo "Violaciones en las 42 preguntas tras el reemplazo: $viol_after\n";

// Verificar balance de respuestas de Java
$resBal = $conecction->query("SELECT respuesta_correcta, COUNT(*) as c FROM preguntas_examen WHERE lenguaje = 'java' GROUP BY respuesta_correcta");
echo "Distribución de respuestas en DB Java:\n";
while ($r = $resBal->fetch_assoc()) {
    echo "  " . $r['respuesta_correcta'] . ": " . $r['c'] . "\n";
}

// Verificar balance de complejidad de Java
$resComp = $conecction->query("SELECT complejidad, COUNT(*) as c FROM preguntas_examen WHERE lenguaje = 'java' GROUP BY complejidad");
echo "Distribución de complejidad en DB Java:\n";
while ($r = $resComp->fetch_assoc()) {
    echo "  " . $r['complejidad'] . ": " . $r['c'] . "\n";
}
