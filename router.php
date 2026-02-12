<?php
// router.php

/**
 * Lógica de ruteo: Determina qué controlador cargar basándose en la URL.
 */

$routes = require 'routes.php';

// Captura la URI actual (ej: /app_notas_pract/notes)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

/**
 * Verifica si la URI existe en el mapa y carga el controlador correspondiente.
 * Se inyecta $db para que el controlador tenga acceso a la base de datos.
 */
function routeToController($uri, $routes, $db)
{
    if (array_key_exists($uri, $routes)) {
        // Usamos base_path para obtener la ruta absoluta desde la raíz
        $path = base_path($routes[$uri]);
        if (file_exists($path)) {
            require $path;
        } else {
            // Si el archivo del controlador no existe físicamente
            abort(Response::NOT_FOUND);
        }
    } else {
        // Si la URL no está definida en el archivo routes.php
        abort(Response::NOT_FOUND);
    }
}

// Ejecución del ruteo
routeToController($uri, $routes, $db);
