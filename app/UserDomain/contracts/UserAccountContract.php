<?php

namespace App\UserDomain\contracts;

use App\UserDomain\dto\signUp;

interface UserAccountContract
{
    public function serviceSignUp(signUp $signUp);
}
