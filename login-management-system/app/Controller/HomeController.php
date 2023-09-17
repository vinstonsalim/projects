<?php

namespace VinstonSalim\Learning\PHP\MVC\Controller;

use VinstonSalim\Learning\PHP\MVC\App\View;
use VinstonSalim\Learning\PHP\MVC\Config\Database;
use VinstonSalim\Learning\PHP\MVC\Repository\SessionRepository;
use VinstonSalim\Learning\PHP\MVC\Repository\UserRepository;
use VinstonSalim\Learning\PHP\MVC\Service\SessionService;

class HomeController
{
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $sessionRepository = new SessionRepository($connection);
        $userRepository = new UserRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    /**
     * @return void
     */
    function index(): void
    {
        $user = $this->sessionService->current();
        // check if user is logged in
        if ($user)
            View::render('Home/dashboard', [
                'title' => "Welcome to Dashboard",
                'user' => [
                    'name' => $user->name,
                    'id' => $user->id,
                ]
            ]);
        else
            View::render('Home/index', [
                'title' => "PHP Login Management"
            ]);
    }
}