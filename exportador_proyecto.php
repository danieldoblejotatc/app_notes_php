<?php
// exportador.php

/**
 * EXPORTADOR DE PROYECTO A TXT
 * Captura la estructura y el código y los guarda en un archivo físico.
 */

// 1. Configuración inicial
$rootPath = __DIR__;
$outputFile = 'proyecto_completo.txt';
$excludeList = ['.git', '.ds_store', 'node_modules', 'proyecto_completo.txt', basename(__FILE__)];

// Iniciar captura de salida
ob_start();

echo "==========================================\n";
echo "ESTRUCTURA Y CÓDIGO DEL PROYECTO\n";
echo "Fecha: " . date('Y-m-d H:i:s') . "\n";
echo "Raíz: " . basename($rootPath) . "\n";
echo "==========================================\n\n";

/**
 * 1. Generar el Árbol de Directorios
 */
echo "--- ÁRBOL DE DIRECTORIOS ---\n";
$directoryItems = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($directoryItems as $name => $object) {
    $path = $object->getPathname();
    $basename = basename($path);

    foreach ($excludeList as $exclude) {
        if (strpos($path, DIRECTORY_SEPARATOR . $exclude) !== false) continue 2;
    }

    $depth = $directoryItems->getDepth();
    echo str_repeat("  ", $depth) . (is_dir($path) ? "📁 " : "📄 ") . $basename . "\n";
}

echo "\n\n--- CONTENIDO DE LOS ARCHIVOS ---\n";

/**
 * 2. Extraer el Código
 */
foreach ($directoryItems as $name => $object) {
    if (is_dir($name)) continue;

    $path = $object->getPathname();
    $relativePath = str_replace($rootPath . DIRECTORY_SEPARATOR, '', $path);

    foreach ($excludeList as $exclude) {
        if (strpos($path, DIRECTORY_SEPARATOR . $exclude) !== false) continue 2;
    }

    echo "\n" . str_repeat("=", 60) . "\n";
    echo "ARCHIVO: $relativePath\n";
    echo str_repeat("=", 60) . "\n";

    $content = file_get_contents($path);
    echo $content ?: "[Archivo vacío]";
    echo "\n";
}

// 3. Guardar el contenido capturado en el archivo
$finalOutput = ob_get_clean();
file_put_contents($outputFile, $finalOutput);

// 4. Informar al usuario
header('Content-Type: text/html; charset=utf-8');
echo "<h2>✅ Exportación completada con éxito.</h2>";
echo "<p>Se ha generado el archivo: <strong>$outputFile</strong></p>";
echo "<a href='$outputFile' target='_blank'>Haz clic aquí para ver el archivo</a>";
