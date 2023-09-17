<?php

namespace VinstonSalim\Learning\PHP\MVC\App {

    function header(string $value): void
    {
        echo "$value";
    }
}

namespace VinstonSalim\Learning\PHP\MVC\Service {

    function setcookie(string $key, string $value): void
    {
        echo "$key: $value";
    }
}


namespace VinstonSalim\Learning\PHP\MVC\Controller {
    use PHPUnit\Framework\TestCase;
    use VinstonSalim\Learning\PHP\MVC\Config\Database;
    use VinstonSalim\Learning\PHP\MVC\Domain\Session;
    use VinstonSalim\Learning\PHP\MVC\Domain\User;
    use VinstonSalim\Learning\PHP\MVC\Exception\ValidationException;
    use VinstonSalim\Learning\PHP\MVC\Model\UserLoginRequest;
    use VinstonSalim\Learning\PHP\MVC\Repository\SessionRepository;
    use VinstonSalim\Learning\PHP\MVC\Repository\UserRepository;
    use VinstonSalim\Learning\PHP\MVC\Service\SessionService;


    class UserControllerTest extends TestCase
    {
        private UserController $userController;
        private UserRepository $userRepository;
        private SessionRepository $sessionRepository;

        protected function setUp(): void
        {
            $this->userController = new UserController();

            $this->sessionRepository = new SessionRepository(Database::getConnection());
            $this->sessionRepository->deleteAll();

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


        public function testLogin(): void
        {
            $this->userController->login();
            $this->expectOutputRegex("[Login]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Sign On]");

        }

        /**
         * @return void
         */
        public function testLoginSuccess(): void
        {
            $user = new User();
            $user->id = "testId";
            $user->name = "testName";
            $user->password = password_hash("testPassword", PASSWORD_BCRYPT);

            $this->userRepository->save($user);


            $_POST['id'] = "testId";
            $_POST['password'] = "testPassword";


            $this->userController->postLogin();

            self::expectOutputRegex("[Location: /]");
            $key = SessionService::$COOKIE_NAME;
            self::expectOutputString("$key: ");
        }

        public function testLoginValidationError(): void
        {
            $_POST['id'] = "";
            $_POST['password'] = "";

            $this->userController->postLogin();

            $this->expectOutputRegex("[Login]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Sign On]");
            $this->expectOutputRegex("[Id or Password can't be empty]");
        }

        public function testLoginUserNotFound(): void
        {
            $_POST['id'] = "testId";
            $_POST['password'] = "testPassword";

            $this->userController->postLogin();

            $this->expectOutputRegex("[Login]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Sign On]");
            $this->expectOutputRegex("[Id or password is incorrect]");

        }

        public function testWrongPassword(): void
        {
            $user = new User();

            $user->id = "testId";
            $user->name = "testName";
            $user->password = password_hash("testPassword", PASSWORD_BCRYPT);

            $this->userRepository->save($user);

            $_POST['id'] = "testId";
            $_POST['password'] = "wrongPassword";

            $this->userController->postLogin();

            $this->expectOutputRegex("[Login]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Sign On]");
            $this->expectOutputRegex("[Id or password is incorrect]");
        }

        public function testLogout(): void
        {
            $user = new User();
            $user->id = "testId";
            $user->name = "testName";
            $user->password = password_hash("testPassword", PASSWORD_BCRYPT);

            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;

            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $this->userController->logout();

            $this->expectOutputRegex("[Location: /]");
            $key = SessionService::$COOKIE_NAME;
            $this->expectOutputRegex("[$key: ]");
        }
    }
}