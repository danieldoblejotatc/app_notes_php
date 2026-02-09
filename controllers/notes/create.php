<?php
// controllers/notes/create.php

require 'Validator.php';

$currentUserId = 2;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Validator::string($_POST['body'], 1, 1000)) {
        $errors['body'] = 'A body is required and must be between 1 and 1000 characters.';
    }

    if (empty($errors)) {
        $db->query(
            "INSERT INTO notes(body, user_id) VALUES(:body, :user_id)",
            [
                'body' => $_POST['body'],
                'user_id' => $currentUserId
            ]
        );
        header('Location: /app_notas_pract/notes');
        exit();
    }
}

// Cargar la vista al final, pasando los errores (estén vacíos o no)
view('notes/note-create.view.php', [
    'heading' => 'Create Note',
    'errors' => $errors
]);
