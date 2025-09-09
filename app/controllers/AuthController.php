<?php

namespace App\Controllers;

use Framework\Authenticate;
use Framework\Validator;

class AuthController
{
    public function login()
    {
        view('login');
    }

    public function authenticate()
    {
        Validator::make($_POST, [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        $login = (new Authenticate())->login($_POST['email'], $_POST['password']);

        if ($login) {
            redirect('/');
        }

        //if login fails, redirect back to login page with error
    }

    public function logout()
    {
        (new Authenticate())->logout();
        redirect('/login');
    }   
}
