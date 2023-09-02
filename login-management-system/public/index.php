<?php

require_once '../vendor/autoload.php';


use \VinstonSalim\Learning\PHP\MVC\App\Router;
use \VinstonSalim\Learning\PHP\MVC\Controller\HomeController;
use VinstonSalim\Learning\PHP\MVC\Controller\UserController;

// HomeController
Router::add('GET', '/', HomeController::class, 'index');

// User Controller
Router::add('GET', '/users/register', UserController::class, 'register',[]);
Router::add('POST', '/users/register', UserController::class, 'postRegister',[]);


Router::run();