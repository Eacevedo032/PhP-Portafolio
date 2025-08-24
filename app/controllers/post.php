<?php

$title = 'Proyectos';

$post = $db->query('SELECT * FROM posts WHERE id = :id', [
    'id' => $_GET['id'] ?? null,
]) -> firstOrFail();

require __DIR__ .'/../../resources/post.template.php';