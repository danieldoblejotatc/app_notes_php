<?php
// index.php

/**
 * Bootstrapping: Cargamos el corazón de la aplicación
 */
require 'Response.php';
require 'functions.php';
require 'Database.php';

// 1. Cargamos la configuración técnica
$config = require 'config.php';

// 2. Inicializamos componentes globales (Conexión Única)
$db = new Database(
    $config['database'],
    $config['user'],
    $config['password']
);

/**
 * Despacho: El Router toma el control al final
 */
require 'router.php';
