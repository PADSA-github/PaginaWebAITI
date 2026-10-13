<?php
$file = 'c:/workspace/PaginaWebAITI/examen/tools/builder_java.php';
$content = file_get_contents($file);

$content = preg_replace_callback("/'explicacion'\s*=>\s*'([^']*)'/", function($matches) {
    $text = $matches[1];
    if (mb_strlen($text, 'UTF-8') > 90) {
        $text = mb_substr($text, 0, 87, 'UTF-8') . '...';
    }
    return "'explicacion' => '$text'";
}, $content);

file_put_contents($file, $content);
echo "Todas las explicaciones truncadas a max 90 caracteres.\n";
