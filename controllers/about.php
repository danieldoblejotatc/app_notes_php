<?php

//dd(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$heading = "About Us";
view('about.view.php', [
    'heading' => $heading
]);
