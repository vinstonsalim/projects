<?php

namespace VinstonSalim\Learning\PHP\MVC\App {

    function header(string $value): void
    {
        echo "$value";
    }
}


namespace VinstonSalim\Learning\PHP\MVC\Middleware {

    use PHPUnit\Framework\TestCase;

    class MustLoginMiddlewareTest extends TestCase
    {
        private MustLoginMiddleware $mustLoginMiddleware;

        protected function setUp(): void
        {
            $this->mustLoginMiddleware = new MustLoginMiddleware();
            putenv("mode=test");
        }

        public function testBeforeGuest(): void
        {
            $this->mustLoginMiddleware->before();

            $this->expectOutputRegex("[Location: /users/login]");
        }

        public function testBeforeLoggenUser(): void
        {

            $this->mustLoginMiddleware->before();
            $this->expectOutputString("");
        }

    }

}
