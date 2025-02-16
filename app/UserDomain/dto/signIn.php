<?php

namespace App\UserDomain\dto;

use App\UserDomain\requests\SignInRequest;

readonly class signIn
{
    public function __construct(
        public string $email,
        public string $password
    ){}

    public static function fromValidatedRequest(SignInRequest $request): SignIn
    {
        return new self(
            email: $request->validated('email'),
            password: $request->validated('password')
        );
    }
}
