<?php

namespace VinstonSalim\Learning\PHP\MVC\Repository;

use PDO;
use VinstonSalim\Learning\PHP\MVC\Domain\User;

class UserRepository
{
    private PDO $connection;

    // Injection via Constructor
    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param User $user
     * @return User
     */
    public function save(User $user) : User {
        $statement = $this->connection->prepare("INSERT INTO users(id, name, password) VALUES (?, ?, ?)");
        $statement->execute([
            $user->id, $user->name, $user->password,
        ]);
        // Consideration: Maybe password should not be returned?
        return $user;
    }

    /**
     * @param string $id
     * @return User|null
     */
    public function findById(string $id): ?User {
        $statement = $this->connection->prepare("SELECT id,name,password FROM users WHERE id = ?");
        $statement->execute([$id]);

        try {
            if($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->name = $row['name'];
                $user->password = $row['password'];

                return $user;
            }

            return Null;

        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE from users");
    }
}