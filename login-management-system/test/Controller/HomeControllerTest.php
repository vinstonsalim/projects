<?php

namespace VinstonSalim\Learning\PHP\MVC\Controller;

use PHPUnit\Framework\TestCase;
use VinstonSalim\Learning\PHP\MVC\Config\Database;
use VinstonSalim\Learning\PHP\MVC\Domain\Session;
use VinstonSalim\Learning\PHP\MVC\Domain\User;
use VinstonSalim\Learning\PHP\MVC\Repository\SessionRepository;
use VinstonSalim\Learning\PHP\MVC\Repository\UserRepository;
use VinstonSalim\Learning\PHP\MVC\Service\SessionService;

class HomeControllerTest extends TestCase
{
    private HomeController $homeController;
    private UserRepository $userRepository;

    private SessionRepository $sessionRepository;

    protected function setUp(): void
    {
        $this->homeController = new HomeController();

        $connection = Database::getConnection();
        $this->sessionRepository = new SessionRepository($connection);
        $this->userRepository = new UserRepository($connection);

        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();
    }

    public function testNotLoggedIn()
    {
        $this->homeController->index();

        self::expectOutputRegex('[Login Management]');
        self::expectOutputRegex('[Login]');
        self::expectOutputRegex('[Register]');
    }

    public function testLoggedIn()
    {
        // create user
        $user = new User();
        $user->id = 'test_id';
        $user->name = 'test_name';
        $user->password = password_hash('test_password', PASSWORD_BCRYPT);

        $this->userRepository->save($user);

        // Create Session (Logged in)
        $session = new Session();
        $session->id = uniqid();
        $session->userId = $user->id;

        $this->sessionRepository->save($session);

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $this->homeController->index();

        self::expectOutputRegex('[Dashboard]');
        self::expectOutputString("Hello $user->name");

    }
}
