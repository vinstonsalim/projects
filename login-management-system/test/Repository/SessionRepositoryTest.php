<?php

namespace VinstonSalim\Learning\PHP\MVC\Repository;

use PHPUnit\Framework\TestCase;
use VinstonSalim\Learning\PHP\MVC\Config\Database;
use VinstonSalim\Learning\PHP\MVC\Domain\Session;
use VinstonSalim\Learning\PHP\MVC\Domain\User;

class SessionRepositoryTest extends TestCase
{
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;



    protected function setUp(): void
    {
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();

        $user = new User();
        $user->id = "test_id";
        $user->name = "test_name";
        $user->password = password_hash("test_password", PASSWORD_BCRYPT);

        // Prevent constraint violation error because of foreign key
        $this->userRepository->save($user);
    }

    public function testSaveSuccess()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "test_id";

        $this->sessionRepository->save($session);

        $result =  $this->sessionRepository->findById($session->id);

        self::assertNotNull($result);
        self::assertEquals($session->id, $result->id);
        self::assertEquals($session->userId, $result->userId);
    }

    public function testDeleteById()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "test_id";

        $this->sessionRepository->save($session);

        $this->sessionRepository->deleteById($session->id);
        $result =  $this->sessionRepository->findById($session->id);

        self::assertNull($result);
    }

    public function testDeleteAll()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "test_id";

        $this->sessionRepository->save($session);

        $this->sessionRepository->deleteAll();
        $result =  $this->sessionRepository->findById($session->id);

        self::assertNull($result);
    }


    public function testFindById()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "test_id";

        $this->sessionRepository->save($session);

        $result =  $this->sessionRepository->findById($session->id);

        self::assertNotNull($result);
        self::assertEquals($session->id, $result->id);
        self::assertEquals($session->userId, $result->userId);

    }
}
