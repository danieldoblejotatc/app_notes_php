<?php
// public/index.php

const BASE_PATH = __DIR__ . '/../';

/**
 * Bootstrapping: Cargamos el corazón de la aplicación
 */
require BASE_PATH . 'functions.php';

require base_path('Response.php');
require base_path('Database.php');

// 1. Cargamos la configuración técnica
$config = require base_path('config.php');

// 2. Inicializamos componentes globales (Conexión Única)
$db = new Database(
    $config['database'],
    $config['user'],
    $config['password']
);

/**
 * Despacho: El Router toma el control al final
 */
require base_path('router.php');
