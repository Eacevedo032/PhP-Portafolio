<?php

namespace App\Controllers;

class PostController{
    public function show(){

        $post = db()->query('SELECT * FROM posts WHERE id = :id', [
            'id' => $_GET['id'] ?? null,
            ]) -> firstOrFail();

        view('post', [
            'title' => 'Proyectos',
            'post' => $post
        ]);
    }
}
