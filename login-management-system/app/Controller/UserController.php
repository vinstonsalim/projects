<?php

namespace VinstonSalim\Learning\PHP\MVC\Controller;

use VinstonSalim\Learning\PHP\MVC\App\View;
use VinstonSalim\Learning\PHP\MVC\Config\Database;
use VinstonSalim\Learning\PHP\MVC\Exception\ValidationException;
use VinstonSalim\Learning\PHP\MVC\Model\UserLoginRequest;
use VinstonSalim\Learning\PHP\MVC\Model\UserRegisterRequest;
use VinstonSalim\Learning\PHP\MVC\Repository\UserRepository;
use VinstonSalim\Learning\PHP\MVC\Service\UserService;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $userRepo = new UserRepository(Database::getConnection());
        $this->userService = new UserService($userRepo);
    }

    public function register(): void
    {
        View::render('User/register', [
            'title' => "Register New User"
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function postRegister(): void
    {
        $request = new UserRegisterRequest();
        $request->id = $_POST['id'];
        $request->name = $_POST['name'];
        $request->password = $_POST['password'];

        try {
            $this->userService->register($request);
            // redirect to login page or message success
            View::redirect('/users/login');
        }
        catch (ValidationException $e) {
            View::render('User/register', [
                'title' => "Register New User",
                'error' => $e->getMessage()
            ]);
        }

    }

    public function login(): void
    {
        View::render('User/login', [
            'title' => "Login"
        ]);
    }


    public function postLogin():void
    {
        $request = new UserLoginRequest();
        $request->id = $_POST['id'];
        $request->password = $_POST['password'];

        try {
            $this->userService->login($request);
            // redirect to home page or message success
            View::redirect('/');
        }
        catch (ValidationException $e) {
            View::render('User/login', [
                'title' => "Login",
                'error' => $e->getMessage()
            ]);
        }

    }

}