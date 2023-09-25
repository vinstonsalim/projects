<?php

require_once '../vendor/autoload.php';


use \VinstonSalim\Learning\PHP\MVC\App\Router;
use \VinstonSalim\Learning\PHP\MVC\Controller\HomeController;
use VinstonSalim\Learning\PHP\MVC\Controller\UserController;
use VinstonSalim\Learning\PHP\MVC\Middleware\MustLoginMiddleware;
use VinstonSalim\Learning\PHP\MVC\Middleware\MustNotLoginMiddleware;

// HomeController
Router::add('GET', '/', HomeController::class, 'index',[]);

// User Controller
Router::add('GET', '/users/register', UserController::class, 'register',[MustNotLoginMiddleware::class]);
Router::add('POST', '/users/register', UserController::class, 'postRegister',[MustNotLoginMiddleware::class]);
Router::add('GET', '/users/login', UserController::class, 'login',[MustNotLoginMiddleware::class]);
Router::add('POST', '/users/login', UserController::class, 'postLogin',[MustNotLoginMiddleware::class]);
Router::add('GET', '/users/logout', UserController::class, 'logout',[MustLoginMiddleware::class]);
Router::add('GET', '/users/profile', UserController::class, 'updateProfile',[MustLoginMiddleware::class]);
Router::add('POST', '/users/profile', UserController::class, 'postUpdateProfile',[MustLoginMiddleware::class]);


Router::run();