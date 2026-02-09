<?php
// controllers/notes/show.php

$currentUserId = 2;

// 1. Buscar la nota primero
$note = $db->query("SELECT * FROM notes WHERE id = :id", [
    'id' => $_GET['id']
])->findOrFail();

// 2. Autorizar
authorize($note['user_id'] === $currentUserId);

// 3. Cargar vista al final
view('notes/note.view.php', [
    'heading' => 'Note',
    'note' => $note
]);
