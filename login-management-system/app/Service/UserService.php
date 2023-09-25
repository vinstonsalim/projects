<?php

namespace VinstonSalim\Learning\PHP\MVC\Service;

use VinstonSalim\Learning\PHP\MVC\Config\Database;
use VinstonSalim\Learning\PHP\MVC\Domain\User;
use VinstonSalim\Learning\PHP\MVC\Exception\ValidationException;
use VinstonSalim\Learning\PHP\MVC\Model\UserLoginRequest;
use VinstonSalim\Learning\PHP\MVC\Model\UserLoginResponse;
use VinstonSalim\Learning\PHP\MVC\Model\UserProfileUpdateRequest;
use VinstonSalim\Learning\PHP\MVC\Model\UserRegisterRequest;
use VinstonSalim\Learning\PHP\MVC\Model\UserRegisterResponse;
use VinstonSalim\Learning\PHP\MVC\Model\UserProfileUpdateResponse;
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

        try {
            Database::beginTransaction();
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
            Database::commit();
            return $userRegisterResponse;

        } catch (\Exception $exception) {
            Database::rollBack();
            throw $exception;
        }
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

    /**
     * @throws ValidationException
     */
    public function login(UserLoginRequest $userLoginRequest) : UserLoginResponse
    {
        $this->validateUserLoginRequest($userLoginRequest);

        $user = $this->userRepository->findById($userLoginRequest->id);

        if($user == null || !password_verify($userLoginRequest->password, $user->password))
        {
            throw new ValidationException("Id or password is incorrect");
        }

        $userLoginResponse = new UserLoginResponse();
        $userLoginResponse->user = $user;
        return $userLoginResponse;
    }

    /**
     * @throws ValidationException
     */
    private function validateUserLoginRequest(UserLoginRequest $userLoginRequest) : void
    {
        if($userLoginRequest->password == null
            || $userLoginRequest->id == null
            || trim($userLoginRequest->id) == ""
            || trim($userLoginRequest->password) == "")
        {
            throw new ValidationException("Id or Password can't be empty");
        }

        // Id and Password can't be longer than 255 characters to reduce the query time
        if(strlen($userLoginRequest->password) > 255
            || strlen($userLoginRequest->id) > 255)
        {
            throw new ValidationException("Id or password is incorrect");
        }

    }

    /**
     * @throws ValidationException
     */
    public function updateProfile(UserProfileUpdateRequest $request): UserProfileUpdateResponse
    {
        $this->validateUserProfileUpdateRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findById($request->id);
            if($user == null)
            {
                throw new ValidationException("User not found");
            }

            $user->name = $request->name;
            $this->userRepository->update($user);

            // Response
            $userUpdateProfileResponse = new UserProfileUpdateResponse();
            $userUpdateProfileResponse->user = $user;
            Database::commit();
            return $userUpdateProfileResponse;

        } catch (\Exception $exception) {
            Database::rollBack();
            throw $exception;
        }

    }

    private function validateUserProfileUpdateRequest(UserProfileUpdateRequest $request): void
    {
        if($request->name == null
            || $request->id == null
            || trim($request->name) == ""
            || trim($request->id) == "")
        {
            throw new ValidationException("Id or Name can't be empty");
        }

        // Id and Password can't be longer than 255 characters to reduce the query time
        if(strlen($request->name) > 255
            || strlen($request->id) > 255)
        {
            throw new ValidationException("Id or Name can't be longer than 255 characters");

        }

    }
}