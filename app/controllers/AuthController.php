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
        $validator = new Validator($_POST, [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if ($validator->passes()) {
            $login = (new Authenticate())->login($_POST['email'], $_POST['password']);

            if ($login) {
                redirect('/');
            }
        }

        view('login',[
            'errors' => $validator->errors()]);
    }

    public function logout()
    {
        (new Authenticate())->logout();
        redirect('/login');
    }   
}
