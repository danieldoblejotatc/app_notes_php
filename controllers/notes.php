<?php

//dd(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$heading = "My Notes";
$currentUserId = 2;


// $notes = $db->query("SELECT * FROM notes WHERE user_id = 2")->fetchAll();
// dd($notes);

// Obtenemos la nota más reciente del usuario 2
$notes = $db->query("SELECT * FROM notes WHERE user_id = :user_id", [
    'user_id' => $currentUserId
])->fetchAll();


require 'views/notes.view.php';
