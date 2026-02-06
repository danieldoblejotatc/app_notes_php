<?php

$dirToScan = __DIR__;
$outputFile = 'estructura_proyecto.txt';
$excluded = ['vendor', 'node_modules', '.git', '.idea', '.vscode', 'generar_mapa.php', 'generar.bat'];

/**
 * @param string $dir Directorio actual
 * @param string $prefix Prefijo visual para las ramas
 * @param array $excluded Carpetas y archivos a ignorar
 * @return string
 */
function buildTree($dir, $prefix = '', $excluded = [])
{
    $result = "";
    $files = scandir($dir);

    // Quitamos . y .. y los excluidos
    $files = array_filter($files, function ($file) use ($excluded) {
        return !in_array($file, $excluded) && $file !== '.' && $file !== '..';
    });

    // Reindexamos para saber cuál es el último elemento
    $files = array_values($files);
    $count = count($files);

    foreach ($files as $index => $file) {
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        $isLast = ($index === $count - 1);

        // Elegimos el conector según la posición
        $connector = $isLast ? '└── ' : '├── ';

        $result .= $prefix . $connector . $file . PHP_EOL;

        if (is_dir($path)) {
            // Si es carpeta, bajamos un nivel con un nuevo prefijo
            $newPrefix = $prefix . ($isLast ? '    ' : '│   ');
            $result .= buildTree($path, $newPrefix, $excluded);
        }
    }
    return $result;
}

// Construcción del contenido final
$header = "ESTRUCTURA DEL PROYECTO" . PHP_EOL;
$header .= "Generado el: " . date('Y-m-d H:i:s') . PHP_EOL;
$header .= str_repeat('=', 30) . PHP_EOL . PHP_EOL;
$header .= basename($dirToScan) . DIRECTORY_SEPARATOR . PHP_EOL;

// Aquí estaba el fallo: simplemente concatenamos el retorno de la función
$treeBody = buildTree($dirToScan, '', $excluded);

file_put_contents($outputFile, $header . $treeBody);

echo "¡Listo! Estructura limpia generada en: $outputFile" . PHP_EOL;
