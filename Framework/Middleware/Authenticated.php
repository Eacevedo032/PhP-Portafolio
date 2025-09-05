<?php 

namespace Framework\Middleware;

class Authenticated
{
    public function __invoke()
    {
        if (! isset($_SESSION['user'])) {
            redirect('/login');
        }
    }
}