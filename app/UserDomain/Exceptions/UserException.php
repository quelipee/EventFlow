<?php

namespace App\UserDomain\Exceptions;

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
}
