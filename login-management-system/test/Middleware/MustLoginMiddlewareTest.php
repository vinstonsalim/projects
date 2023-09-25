<?php


namespace VinstonSalim\Learning\PHP\MVC\Middleware {

    require_once __DIR__ . '/../Helper/helper.php';
    use PHPUnit\Framework\TestCase;
    use VinstonSalim\Learning\PHP\MVC\Config\Database;
    use VinstonSalim\Learning\PHP\MVC\Domain\User;
    use VinstonSalim\Learning\PHP\MVC\Domain\Session;
    use VinstonSalim\Learning\PHP\MVC\Repository\SessionRepository;
    use VinstonSalim\Learning\PHP\MVC\Repository\UserRepository;
    use VinstonSalim\Learning\PHP\MVC\Service\SessionService;

    class MustLoginMiddlewareTest extends TestCase
    {
        private MustLoginMiddleware $mustLoginMiddleware;
        private UserRepository $userRepository;
        private SessionRepository $sessionRepository;

        protected function setUp(): void
        {
            $this->mustLoginMiddleware = new MustLoginMiddleware();
            putenv("mode=test");

            $this->userRepository = new UserRepository(Database::getConnection());
            $this->sessionRepository = new SessionRepository(Database::getConnection());

            $this->userRepository->deleteAll();
            $this->sessionRepository->deleteAll();
        }

        public function testBeforeGuest(): void
        {
            $this->mustLoginMiddleware->before();

            $this->expectOutputRegex("[Location: /users/login]");
        }

        public function testBeforeLoggedUser(): void
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

            $this->mustLoginMiddleware->before();
            $this->expectOutputString("");
        }
    }

}
