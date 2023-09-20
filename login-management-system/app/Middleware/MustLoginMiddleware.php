<?php

namespace VinstonSalim\Learning\PHP\MVC\Middleware;

use VinstonSalim\Learning\PHP\MVC\App\View;
use VinstonSalim\Learning\PHP\MVC\Config\Database;
use VinstonSalim\Learning\PHP\MVC\Domain\User;
use VinstonSalim\Learning\PHP\MVC\Repository\SessionRepository;
use VinstonSalim\Learning\PHP\MVC\Repository\UserRepository;
use VinstonSalim\Learning\PHP\MVC\Service\SessionService;

class MustLoginMiddleware implements Middleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function before(): void
    {
        $user = $this->sessionService->current();

        if (!$user) {
            View::redirect('/users/login');
        }
    }


}