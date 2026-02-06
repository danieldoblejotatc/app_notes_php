<?php

function urlIs($value)
{
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return $currentPath === $value;
};

function dd($value)
{
    echo "<pre style='background:#18181b;color:#fbbf24;padding:20px;border-radius:1px solid #f5f5f5;' >";
    var_dump($value);
    echo "</pre>";
    die();
}
