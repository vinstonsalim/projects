<?php

namespace VinstonSalim\Learning\PHP\MVC\Repository;

use PHPUnit\Framework\TestCase;
use VinstonSalim\Learning\PHP\MVC\Config\Database;
use VinstonSalim\Learning\PHP\MVC\Domain\User;

class UserRepositoryTest extends TestCase
{

    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll(); // Making sure the database empty before test
    }

    public function testSaveSuccess()
    {
        $user = new User();
        $user->id = "Vin";
        $user->name = "Vinston";
        $user->password = "GanzGeheim";

        $this->userRepository->save($user);

        $queryResult = $this->userRepository->findById($user->id);

        self::assertEquals($user->id, $queryResult->id);
        self::assertEquals($user->name, $queryResult->name);
        self::assertEquals($user->password, $queryResult->password);
    }

    public function testFindByIdNotFound()
    {
        $queryResult = $this->userRepository->findById("notFound");
        self::assertNull($queryResult);
    }
}
