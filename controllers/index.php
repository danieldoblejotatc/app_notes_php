<?php
//dd(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$heading = "Home";

$id = $_GET['id'] ?? 2;
$posts = $db->query("SELECT * FROM notes WHERE id=?", [$id])->fetch();

// Esto "imprime" el arreglo de forma legible en el navegador
// dd($posts);

require 'views/index.view.php';
