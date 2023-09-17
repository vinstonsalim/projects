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
Router::add('GET', '/users/login', UserController::class, 'login',[]);
Router::add('POST', '/users/login', UserController::class, 'postLogin',[]);
Router::add('GET', '/users/logout', UserController::class, 'logout',[]);


Router::run();