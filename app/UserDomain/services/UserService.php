<?php

namespace App\UserDomain\services;

use App\Models\User;
use App\UserDomain\contracts\UserAccountContract;
use App\UserDomain\dto\signIn;
use App\UserDomain\dto\signUp;
use App\UserDomain\exceptions\UserException;
use Illuminate\Support\Facades\Auth;

class UserService implements UserAccountContract
{

    /**
     * @throws UserException
     */
    public function serviceSignUp(signUp $signUp): User
    {
        $this->checkEmailExist($signUp->email);
        $this->passwordConfirmation($signUp->password, $signUp->passwordRepeat);

        $user = new User([
            'email' => $signUp->email,
            'password' => $signUp->password,
            'passwordRepeat' => $signUp->passwordRepeat,
            'name' => $signUp->name,
        ]);
        $user->save();
        return $user;
    }

    /**
     * @throws UserException
     */
    protected function checkEmailExist(string $email): void
    {
        $exist = User::where('email', $email)->exists();
        if ($exist === true) {
            throw UserException::emailAlreadyExists();
        }
    }

    /**
     * @throws UserException
     */
    protected function passwordConfirmation(string $password, string $passwordRepeat): void
    {
        if ($password != $passwordRepeat) {
            throw UserException::passwordNotMatch();
        }
    }

    /**
     * @throws UserException
     */
    public function serviceSignIn(signIn $signIn) : string
    {
        if (!Auth::attempt(['email' => $signIn->email, 'password' => $signIn->password])) {
            throw UserException::invalidCredentials();
        }

        $user = Auth::user();
        return $user->createToken('auth token')->plainTextToken;
    }
}
