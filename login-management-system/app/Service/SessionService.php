<?php

namespace VinstonSalim\Learning\PHP\MVC\Service;

use VinstonSalim\Learning\PHP\MVC\Config\Database;
use VinstonSalim\Learning\PHP\MVC\Domain\Session;
use VinstonSalim\Learning\PHP\MVC\Domain\User;
use VinstonSalim\Learning\PHP\MVC\Repository\SessionRepository;
use VinstonSalim\Learning\PHP\MVC\Repository\UserRepository;

class SessionService
{
    public static string $COOKIE_NAME = "USER_SESSION_ID";
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    /**
     * @param SessionRepository $sessionRepository
     */
    public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository)
    {
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
    }


    /**
     * @throws \Exception
     */
    public function create(string $userId): Session
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = $userId;

        // Wrap into DB Transaction
        try {
            Database::beginTransaction();

            $this->sessionRepository->save($session);

            // Using cookie to save the session id for 30 Days
            // "/": means the cookie is available in the entire website
            setcookie(self::$COOKIE_NAME, $session->id, time() + (86400 * 30), "/");

            Database::commit();
            return $session;

        } catch (\Exception $exception) {
            Database::rollBack();
            throw $exception;
        }
    }

    public function destroy(): void
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? "";

        $this->sessionRepository->deleteById($sessionId);

        // Idea is to set the cookie to empty and set the time to past
        setcookie(self::$COOKIE_NAME, "", 1, "/");
    }

    public function current(): ?User
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? "";

        $session = $this->sessionRepository->findById($sessionId);

        return (empty($session) ? null : $this->userRepository->findById($session->userId));
    }
}