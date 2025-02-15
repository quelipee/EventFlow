<?php

namespace App\UserDomain\controllers;

use App\Http\Controllers\Controller;
use App\UserDomain\contracts\UserAccountContract;
use App\UserDomain\dto\signUp;
use App\UserDomain\requests\UserRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function __construct(
        protected UserAccountContract $userAccount
    ){}

    public function UserRegister(UserRequest $request): JsonResponse
    {
        $user_created = $this->userAccount->serviceSignUp(signUp::fromValidatedRequest($request));
        return response()->json([
            'message' => 'User registered successfully',
            'data' => $user_created
        ], ResponseAlias::HTTP_CREATED);
    }
}
