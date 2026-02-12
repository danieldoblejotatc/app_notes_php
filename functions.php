<?php
// functions.php

/**
 * NAVEGACIÓN Y RUTAS
 * ============================================================
 */

/**
 * Retorna la ruta absoluta desde la raíz del proyecto.
 * Usamos una constante o definimos la raíz basándonos en este archivo.
 */
function base_path($path)
{
    return BASE_PATH . $path;
}

/**
 * Determina si la URL actual coincide con el valor dado.
 */
function urlIs($value)
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $value;
}

/**
 * GESTIÓN DE VISTAS Y RESPUESTAS
 * ============================================================
 */

/**
 * Carga una vista y le inyecta variables.
 */
function view($path, $attributes = [])
{
    extract($attributes);
    require base_path('views/' . $path);
}

/**
 * Detiene la ejecución con un código de error y su vista correspondiente.
 */
function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

/**
 * SEGURIDAD Y CONTROL
 * ============================================================
 */

function authorize($condition)
{
    if (!$condition) {
        abort(Response::FORBIDDEN); // [cite: 48, 81]
    }
}

/**
 * DEBUGGING
 * ============================================================
 */

function dd($value)
{
    echo "<pre style='background:#18181b; color:#fbbf24; padding:20px; border-radius:8px; overflow:auto; line-height:1.5; border:1px solid #3f3f46;'>";
    var_dump($value);
    echo "</pre>";
    die();
}
