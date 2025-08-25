<?php 

$title = 'Registrar Proyecto';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validator = new Validator($_POST, [
        'title'       => 'required|min:3'|'max:190',
        'url'         => 'required|url|max:190',
        'description' => 'nullable|min:3|max:500',
    ]);

    if ($validator->passes()) {
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
    } else {
        $errors = $validator->errors();
    }   
}

require __DIR__ .'/../../resources/links-create.template.php';