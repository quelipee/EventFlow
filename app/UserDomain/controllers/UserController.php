<?php

namespace App\UserDomain\controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\UserDomain\contracts\UserAccountContract;
use App\UserDomain\dto\signIn;
use App\UserDomain\dto\signUp;
use App\UserDomain\requests\SignInRequest;
use App\UserDomain\requests\UserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function __construct(
        protected UserAccountContract $userAccount
    ){}

    public function userRegister(UserRequest $request): JsonResponse
    {
        $user_created = $this->userAccount->serviceSignUp(signUp::fromValidatedRequest($request));
        return response()->json([
            'message' => 'User registered successfully',
            'data' => $user_created
        ], ResponseAlias::HTTP_CREATED);
    }

    public function userLogin(SignInRequest $request): JsonResponse
    {
        $user_token = $this->userAccount->serviceSignIn(signIn::fromValidatedRequest($request));
        return response()->json([
            'message' => 'User logged in successfully',
            'data' => [
                'user' => User::find(Auth::id()),
                'token' => $user_token
            ]
        ]);
    }

    public function userLogout()
    {
        $session = $this->userAccount->invalidateSession();
        return response()->json([
            'message' => 'User logged out successfully',
            'data' => $session
        ], ResponseAlias::HTTP_OK);
    }
}
