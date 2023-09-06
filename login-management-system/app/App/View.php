<?php

namespace VinstonSalim\Learning\PHP\MVC\App;

use JetBrains\PhpStorm\NoReturn;

class View
{

    public static function render(string $view, $model): void
    {
        require __DIR__ . '/../View/header.php';
        require __DIR__ . '/../View/' . $view . '.php';
        require __DIR__ . '/../View/footer.php';
    }

    #[NoReturn] public static function redirect(string $url): void
    {
        header('Location: ' . $url);

        if(getenv("mode") != "test")
            exit();
    }

}