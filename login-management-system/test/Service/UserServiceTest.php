<?php

namespace VinstonSalim\Learning\PHP\MVC\Service;

use PHPUnit\Framework\TestCase;
use VinstonSalim\Learning\PHP\MVC\Config\Database;
use VinstonSalim\Learning\PHP\MVC\Exception\ValidationException;
use VinstonSalim\Learning\PHP\MVC\Model\UserRegisterRequest;
use VinstonSalim\Learning\PHP\MVC\Repository\UserRepository;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        $userRepository= new UserRepository(Database::getConnection());
        $this->userService = new UserService($userRepository);

        // Clean database before use
        $userRepository->deleteAll();
    }

    /**
     * @throws ValidationException
     */
    public function testRegisterSuccess()
    {
        $request = new UserRegisterRequest();
        $request->id = "testId";
        $request->name = "testName";
        $request->password = "testPassword";

        $response = $this->userService->register($request);

        $this->assertEquals($request->id, $response->user->id);
        $this->assertEquals($request->name, $response->user->name);
        $this->assertNotEquals($request->password, $response->user->password);
        $this->assertTrue(password_verify($request->password, $response->user->password));

    }

    public function testRegisterFailed()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Id, Name or Password can't be empty");

        $request = new UserRegisterRequest();
        $request->id = "testId";
        $request->name = "testName";
        $request->password = "";

        $response = $this->userService->register($request);


    }

    public function testRegisterDuplicate()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("User already exists");

        $request = new UserRegisterRequest();
        $request->id = "testId";
        $request->name = "testName";
        $request->password = "testPassword";

        $response1 = $this->userService->register($request);
        $response2 = $this->userService->register($request);
    }

    public function testRegisterIdMoreThan255Char()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Id, Name or Password can't be longer than 255 characters");

        $request = new UserRegisterRequest();
        $request->id = str_repeat("a", 256);
        $request->name = "testName";
        $request->password = "testPassword";

        $response = $this->userService->register($request);

    }
}
