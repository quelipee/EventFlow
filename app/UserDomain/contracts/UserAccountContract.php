<?php

namespace App\UserDomain\contracts;

use App\Models\User;
use App\UserDomain\dto\signIn;
use App\UserDomain\dto\signUp;

interface UserAccountContract
{
    public function serviceSignUp(signUp $signUp) : User;
    public function serviceSignIn(signIn $signIn) : string;
}
