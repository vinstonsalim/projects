<?php

require_once '../vendor/autoload.php';


use \VinstonSalim\Learning\PHP\MVC\App\Router;
use \VinstonSalim\Learning\PHP\MVC\Controller\HomeController;

Router::add('GET', '/', HomeController::class, 'index');

Router::run();