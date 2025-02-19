<?php

use App\EventDomain\controllers\EventController;
use App\UserDomain\controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('guest:sanctum')->group(function () {
    Route::post('signUp', [UserController::class, 'userRegister'])->name('signUp');
    Route::post('signIn', [UserController::class, 'userLogin'])->name('signIn');
});

Route::middleware(['auth:sanctum','duplicatedEvent'])->group(function () {
    Route::post('signOut', [UserController::class, 'userLogout'])->name('signOut');
    Route::post('event/create', [EventController::class, 'createEvent'])->name('createEvent');
    Route::put('event/edit/{id}', [EventController::class, 'updateEvent'])
        ->middleware('EnsureUserOwnsEvent')
        ->name('updateEvent');
    Route::delete('event/delete/{id}', [EventController::class, 'deleteEvent'])->name('deleteEvent');
    Route::get('event', [EventController::class, 'listEvents'])->name('listEvents');
});
