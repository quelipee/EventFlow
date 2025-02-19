<?php

namespace App\UserDomain\exceptions;

class UserException extends \Exception
{
    public static function emailAlreadyExists(): UserException
    {
        return new self("Email indisponivel");
    }

    public static function passwordNotMatch(): UserException
    {
        return new self("Senhas diferentes");
    }

    public static function invalidCredentials(): UserException
    {
        return new self("Informações invalidas");
    }

    public static function UserNotFoundException(): UserException
    {
        return new self("Usuario não encontrado");
    }
}
