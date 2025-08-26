<?php

namespace App\Controllers;
Use Framework\Database;

class PostController{
    public function show(){
        $title = 'Proyectos';

        $db = new Database();

        $post = $db->query('SELECT * FROM posts WHERE id = :id', [
            'id' => $_GET['id'] ?? null,
            ]) -> firstOrFail();
        require __DIR__ .'/../../resources/post.template.php';
    }
}
