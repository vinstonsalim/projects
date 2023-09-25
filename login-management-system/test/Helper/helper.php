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
