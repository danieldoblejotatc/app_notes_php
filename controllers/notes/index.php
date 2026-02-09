<?php
// controllers/notes/index.php

// 1. Lógica y datos
$heading = "My Notes";
$currentUserId = 2;

$notes = $db->query(
    "SELECT * FROM notes WHERE user_id = :user_id",
    ["user_id" => $currentUserId]
)->get();

// 2. Carga la vista al final (y elimina el require antiguo)
view('notes/notes.view.php', [
    'heading' => $heading,
    'notes' => $notes
]);
