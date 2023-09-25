<?php

namespace VinstonSalim\Learning\PHP\MVC\Service;

use PHPUnit\Framework\TestCase;
use VinstonSalim\Learning\PHP\MVC\Config\Database;
use VinstonSalim\Learning\PHP\MVC\Domain\User;
use VinstonSalim\Learning\PHP\MVC\Exception\ValidationException;
use VinstonSalim\Learning\PHP\MVC\Model\UserLoginRequest;
use VinstonSalim\Learning\PHP\MVC\Model\UserUpdateProfileRequest;
use VinstonSalim\Learning\PHP\MVC\Model\UserRegisterRequest;
use VinstonSalim\Learning\PHP\MVC\Repository\UserRepository;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private UserRepository $userRepository;
    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userService = new UserService($this->userRepository);

        // Clean database before use
        $this->userRepository->deleteAll();
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
        $user = new User();
        $user->id = "testId";
        $user->name = "testName";
        $user->password = "testPassword";

        # In order to test this, we need to register a user first directly to the database
        $this->userRepository->save($user);
        # User should be already in database

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("User already exists");

        $request = new UserRegisterRequest();
        $request->id = $user->id;
        $request->name = $user->name;
        $request->password = $user->password;

        $response = $this->userService->register($request);
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

    public function testLoginNotFound()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Id or password is incorrect");

        $request = new UserLoginRequest();
        $request->id = "testId";
        $request->password = "testPassword";

        $response = $this->userService->login($request);

        $this->assertNull($response->user);
    }

    public function testLoginPasswordIncorrect()
    {
        // Create User
        $user = new User();
        $user->id = "testId";
        $user->name = "testName";
        $user->password = password_hash("testPassword", PASSWORD_BCRYPT);

        $this->userRepository->save($user);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Id or password is incorrect");

        $request = new UserLoginRequest();
        $request->id = $user->id;
        $request->password = "wrongPassword";

        $response = $this->userService->login($request);

        $this->assertNull($response->user);
    }

    /**
     * @throws ValidationException
     */
    public function testLoginSuccess()
    {
        // Create User
        $user = new User();
        $user->id = "testId";
        $user->name = "testName";
        $user->password = password_hash("testPassword", PASSWORD_BCRYPT);

        $this->userRepository->save($user);


        $request = new UserLoginRequest();
        $request->id = $user->id;
        $request->password = "testPassword";

        $response = $this->userService->login($request);

        $this->assertEquals($user, $response->user);
        $this->assertTrue(password_verify($request->password, $response->user->password));
    }

    public function testLoginIdMoreThan255Char()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Id or password is incorrect");

        $request = new UserLoginRequest();
        $request->id = str_repeat("a", 256);
        $request->password = "testPassword";

        $response = $this->userService->login($request);
    }

    public function testLoginFailed()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Id or Password can't be empty");

        $request = new UserLoginRequest();
        $request->id = "testId";
        $request->password = "";

        $response = $this->userService->login($request);

    }

    /**
     * @throws ValidationException
     */
    public function testUpdateSuccess()
    {
        // Create User
        $user = new User();
        $user->id = "testId";
        $user->name = "testName";
        $user->password = password_hash("testPassword", PASSWORD_BCRYPT);

        $this->userRepository->save($user);

        $request = new UserUpdateProfileRequest();
        $request->id = "testId";
        $request->name = "testNameUpdated";

        $response = $this->userService->updateProfile($request);

        $this->assertEquals($request->name, $response->user->name);
        $this->assertEquals($request->id, $response->user->id);
        $this->assertEquals($user->password, $response->user->password);
    }

    public function testUpdateValidationError()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Id or Name can't be empty");

        $request = new UserUpdateProfileRequest();
        $request->id = "testId";
        $request->name = "";

        $response = $this->userService->updateProfile($request);
        // Create User
        $user = new User();
        $user->id = "testId";
        $user->name = "testName";
        $user->password = password_hash("testPassword", PASSWORD_BCRYPT);

        $this->userRepository->save($user);

        $request = new UserUpdateProfileRequest();
        $request->id = "";
        $request->name = "";

        $response = $this->userService->updateProfile($request);

        $this->assertEquals($request->name, $response->user->name);
        $this->assertEquals($request->id, $response->user->id);
        $this->assertEquals($user->password, $response->user->password);
    }

    public function testUpdateNotFound()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("User not found");

        $request = new UserUpdateProfileRequest();
        $request->id = "testId";
        $request->name = "testNameUpdated";

        $response = $this->userService->updateProfile($request);
    }
}
