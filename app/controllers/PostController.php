<?php

namespace App\Controllers;
Use Framework\Database;

class PostController{
    public function show(){
        $db = new Database();

        $post = $db->query('SELECT * FROM posts WHERE id = :id', [
            'id' => $_GET['id'] ?? null,
            ]) -> firstOrFail();

        view('post', [
            'title' => 'Proyectos',
            'post' => $post
        ]);
    }
}
