<?php

class LinkController{
    public function index(){

        $db = new Database();
        $links = $db
            ->query('SELECT * FROM links ORDER BY id DESC')
            ->get();
        require __DIR__ .'/../../resources/links.template.php';
    }

    public function create(){
        $title = 'Registrar Proyecto';
        require __DIR__ .'/../../resources/links-create.template.php';
    }

    public function store(){
        $validator = new Validator($_POST, [
        'title'       => 'required|min:3|max:190',
        'url'         => 'required|url|max:190',
        'description' => 'nullable|min:3|max:500',
    ]);

    if ($validator->passes()) {
        $db = new Database();
        $db->query(
            'INSERT INTO links (title, url, description) VALUES (:title, :url, :description)',
            [
                'title'         => $_POST['title'],
                 'url'          => $_POST['url'], 
                 'description'  => $_POST['description'],
                 ]
        );

        header('Location: /links');
        exit;
    }
        $errors = $validator->errors();

        $title = 'Registrar Proyecto';
        require __DIR__ .'/../../resources/links-create.template.php';
    }

    public function edit(){
        $title = 'Editar Proyecto';

        $db = new Database();

        $link = $db
            ->query('SELECT * FROM links WHERE id = :id', [
                'id' => $_GET['id'] ?? null,
            ])
            ->firstOrFail();
            require __DIR__ .'/../../resources/links-edit.template.php';
    }

    public function destroy(){
        $db = new Database();
        $db->query('DELETE FROM links WHERE id = :id', [
            'id' => $_POST['id'] ?? null,
        ]);

        header('Location: /links');
        exit;
    }

}