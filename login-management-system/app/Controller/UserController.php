<?php

namespace VinstonSalim\Learning\PHP\MVC\Controller;

use VinstonSalim\Learning\PHP\MVC\App\View;

class UserController
{
    public function register(): void
    {
        View::render('User/register', [
            'title' => "Register New User"
        ]);
    }

    public function postRegister()
    {

    }


}