<?php
// routes.php

/**
 * Mapa de rutas: Asocia URIs específicas con sus respectivos controladores.
 */
return [
    "/app_notas_pract/"         => "controllers/index.php",
    "/app_notas_pract/about"   => "controllers/about.php",
    "/app_notas_pract/contact" => "controllers/contact.php",
    "/app_notas_pract/notes"   => "controllers/notes/index.php",
    "/app_notas_pract/note"    => "controllers/notes/show.php",
    "/app_notas_pract/notes/create" => "controllers/notes/create.php"

];
