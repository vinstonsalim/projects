<?php

namespace VinstonSalim\Learning\PHP\MVC\Service;

use VinstonSalim\Learning\PHP\MVC\Domain\User;
use VinstonSalim\Learning\PHP\MVC\Exception\ValidationException;
use VinstonSalim\Learning\PHP\MVC\Model\UserRegisterRequest;
use VinstonSalim\Learning\PHP\MVC\Model\UserRegisterResponse;
use VinstonSalim\Learning\PHP\MVC\Repository\UserRepository;

class UserService
{
    // Inject what we need, namely user repository

    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws ValidationException
     */
    public function register(UserRegisterRequest $userRegisterRequest): UserRegisterResponse
    {
        $this->validateUserRegistrationRequest($userRegisterRequest);

        $user = $this->userRepository->findById($userRegisterRequest->id);
        if($user != null)
        {
            throw new ValidationException("User already exists");
        }

        $user = new User();
        $user->id = $userRegisterRequest->id;
        $user->name = $userRegisterRequest->name;
        $user->password = password_hash($userRegisterRequest->password, PASSWORD_BCRYPT);
        
        $this->userRepository->save($user);

        // Response
        $userRegisterResponse = new UserRegisterResponse();
        $userRegisterResponse->user = $user;
        return $userRegisterResponse;
    }

    /**
     * @param UserRegisterRequest $userRegisterRequest
     * @return void
     * @throws ValidationException
     */
    private function validateUserRegistrationRequest(UserRegisterRequest $userRegisterRequest): void
    {
        if($userRegisterRequest->name == null
        || $userRegisterRequest->password == null
        || $userRegisterRequest->id == null
        || trim($userRegisterRequest->name) == ""
        || trim($userRegisterRequest->id) == ""
        || trim($userRegisterRequest->password) == "")
        {
            throw new ValidationException("Id, Name or Password can't be empty");
        }

        // Name, Password and Id can't be longer than 255 characters
        if(strlen($userRegisterRequest->name) > 255
        || strlen($userRegisterRequest->password) > 255
        || strlen($userRegisterRequest->id) > 255)
        {
            throw new ValidationException("Id, Name or Password can't be longer than 255 characters");
        }
    }
}