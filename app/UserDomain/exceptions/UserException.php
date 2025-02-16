<?php

namespace App\UserDomain\exceptions;

class UserException extends \Exception
{
    public static function emailAlreadyExists(): UserException
    {
        return new self("User email already exists");
    }

    public static function passwordNotMatch(): UserException
    {
        return new self("Password not match");
    }

    public static function invalidCredentials(): UserException
    {
        return new self("Invalid credentials");
    }
}
