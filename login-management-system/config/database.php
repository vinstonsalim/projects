<?php

/**
 * @return array
 * This is actually a bad practice to store database credentials in a file.
 * It is better to store them in environment variables.
 * But for the sake of simplicity, I will store them in a file.
 */

function getDatabaseConfig() : array {
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=php_login_management_test",
                "username" => "root",
                "password" => ""
            ],
            "prod" => [
                "url" => "mysql:host=localhost:3306;dbname=php_login_management",
                "username" => "root",
                "password" => ""
            ]
        ]
    ];
}