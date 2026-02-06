<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// var_dump($uri);

$routes = [
    "/app_notas_pract/" => "controllers/index.php",
    "/app_notas_pract/about" => "controllers/about.php",
    "/app_notas_pract/notes" => "controllers/notes.php",
    "/app_notas_pract/note" => "controllers/note.php",
    "/app_notas_pract/contact" => "controllers/contact.php"
];

function abort($code = 404)
{
    http_response_code($code);
    require "views/$code.php";
    die();
}

function routeToController($uri, $routes, $db)
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}

routeToController($uri, $routes, $db);
