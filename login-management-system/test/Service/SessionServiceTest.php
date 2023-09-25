<?php

namespace VinstonSalim\Learning\PHP\MVC\Service;

use PHPUnit\Framework\TestCase;
use VinstonSalim\Learning\PHP\MVC\Config\Database;
use VinstonSalim\Learning\PHP\MVC\Domain\Session;
use VinstonSalim\Learning\PHP\MVC\Domain\User;
use VinstonSalim\Learning\PHP\MVC\Repository\SessionRepository;
use VinstonSalim\Learning\PHP\MVC\Repository\UserRepository;

// Because we are on the same namespace, we can mock the setcookie function
require_once __DIR__ . '/../Helper/helper.php';

class SessionServiceTest extends TestCase
{
    private SessionService $sessionService;
    private SessionRepository $sessionRepository;

    protected function setUp(): void
    {
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($this->sessionRepository, $userRepository);

        // Clean database before use
        $this->sessionRepository->deleteAll();
        $userRepository->deleteAll();

        $user = new User();
        $user->name = "test_name";
        $user->id = "test_id";
        $user->password = "test_password";

        $userRepository->save($user);
    }


    /**
     * @throws \Exception
     */
    public function testCreate()
    {
        $session = $this->sessionService->create("test_id");

        self::expectOutputRegex("[USER_SESSION_ID: $session->id]");

        $sessionFromDatabase = $this->sessionRepository->findById($session->id);

        self::assertEquals($session->id, $sessionFromDatabase->id);
        self::assertEquals($session->userId, $sessionFromDatabase->userId);
    }

    public function testCurrent()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "test_id";

        $this->sessionRepository->save($session);

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $user = $this->sessionService->current();

        self::assertEquals($session->userId, $user->id);
    }

    public function testDestroy()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "test_id";

        $this->sessionRepository->save($session);

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $this->sessionService->destroy();

        self::expectOutputRegex("[USER_SESSION_ID: ]");

        $sessionFromDatabase = $this->sessionRepository->findById($session->id);
        self::assertNull($sessionFromDatabase);
    }
}
