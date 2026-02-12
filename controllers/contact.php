<?php

//dd(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$heading = "Contact Us";
view('contact.view.php', [
    'heading' => $heading
]);
