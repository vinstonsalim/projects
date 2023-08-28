<?php

namespace VinstonSalim\Learning\PHP\MVC\Controller;

use VinstonSalim\Learning\PHP\MVC\App\View;

class HomeController
{
    /**
     * @return void
     */
    function index(): void
    {
        View::render('Home/index', [
            'title' => "PHP Login Management"
        ]);
    }
}