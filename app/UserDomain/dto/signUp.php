<?php

namespace App\UserDomain\dto;

use App\UserDomain\requests\UserRequest;

readonly class signUp
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $passwordRepeat
    ){}

    public static function fromValidatedRequest(UserRequest $request) : signUp
    {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            password: $request->validated('password'),
            passwordRepeat: $request->validated('passwordRepeat')
        );
    }
}
