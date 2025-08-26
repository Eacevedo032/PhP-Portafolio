<?php

class AboutController{
    public function index(){
        $title = 'Sobre mí';
        require __DIR__ .'/../../resources/about.template.php';
    }

}


