<?php

use App\UserDomain\controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('guest:sanctum')->group(function () {
    Route::post('signUp', [UserController::class, 'UserRegister'])->name('signUp');
});
