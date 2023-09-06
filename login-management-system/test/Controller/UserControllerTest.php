<?php

namespace VinstonSalim\Learning\PHP\MVC\App {

    function header(string $value): void
    {
        echo "$value";
    }
}

namespace VinstonSalim\Learning\PHP\MVC\Controller {
    use PHPUnit\Framework\TestCase;
    use VinstonSalim\Learning\PHP\MVC\Config\Database;
    use VinstonSalim\Learning\PHP\MVC\Domain\User;
    use VinstonSalim\Learning\PHP\MVC\Exception\ValidationException;
    use VinstonSalim\Learning\PHP\MVC\Repository\UserRepository;


    class UserControllerTest extends TestCase
    {
        private UserController $userController;
        private UserRepository $userRepository;

        protected function setUp(): void
        {
            $this->userController = new UserController();
            $this->userRepository = new UserRepository(Database::getConnection());
            $this->userRepository->deleteAll();
            putenv("mode=test");
        }
        public function testRegister(): void
        {
            $this->userController->register();
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register New User]");
        }

        /**
         * @throws ValidationException
         */
        public function testPostRegisterSuccess(): void
        {
            $_POST['id'] = "testId";
            $_POST['name'] = "testName";
            $_POST['password'] = "geheim";

            $this->userController->postRegister();

            $this->expectOutputString("Location: /users/login");
            $this->expectOutputRegex("[Location: /users/login]");
        }

        /**
         * @throws ValidationException
         */
        public function testPostRegisterValidationError(): void
        {
            $_POST['id'] = "testId";
            $_POST['name'] = "testName";
            $_POST['password'] = "";

            $this->userController->postRegister();

            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register New User]");
            $this->expectOutputRegex("[Id, Name or Password can't be empty]");

        }

        /**
         * @throws ValidationException
         */
        public function testPostRegisterDuplicate(): void
        {
            $user = new User();

            $user->id = "testId";
            $user->name = "testName";
            $user->password = "testPassword";

            $this->userRepository->save($user);


            $_POST['id'] = "testId";
            $_POST['name'] = "testName";
            $_POST['password'] = "testPassword";

            $this->userController->postRegister();

            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register New User]");
            $this->expectOutputRegex("[User already exists]");

        }

    }
}