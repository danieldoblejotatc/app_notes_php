<?php
// controllers/index.php

/**
 * Controlador de la página de inicio (Landing Page).
 */

//dd(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$heading = "Home";

/**
 * Nota: Actualmente estás buscando una nota específica por ID aquí también.
 * Si esta es solo la página de bienvenida, podrías no necesitar la consulta a la BD,
 * o podrías usarla para mostrar la "Nota del día" o un mensaje especial.
 */
$id = $_GET['id'] ?? 2;

$notes = $db->query("SELECT * FROM notes WHERE id=:id", ['id' => $id])->find();

// Cargamos la vista principal
view('index.view.php', [
    'heading' => $heading,
    'notes' => $notes
]);
