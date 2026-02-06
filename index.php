<?php
// 1. Cargar herramientas y funciones
require "functions.php";
require 'Database.php';
$config = require 'config.php';
$db = new Database(
    $config['database'],
    $config['user'],
    $config['password']
);



// 2. Cargar el ruteo AL FINAL
require "router.php";
