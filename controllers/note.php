<?php

//dd(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$heading = "Note";
$currentUserId = 2; // El ID del usuario logueado actualmente

// dd($_GET['id']);

// 1. Usamos fetch() para obtener un solo registro (array asociativo)
$note = $db->query("SELECT * FROM notes WHERE id = :id", [
    'id' => $_GET['id']
])->fetch();

// 2. Validación: Si el ID no existe en la BD, no sigas
if (! $note) {
    abort(404);
}

if ($note['user_id'] !== $currentUserId) {
    abort(403);
}


require 'views/note.view.php';
