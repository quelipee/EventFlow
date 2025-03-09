<?php

use App\EventDomain\controllers\EventController;
use App\Models\Invite;
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
    Route::post('event', [EventController::class, 'createEvent'])->name('createEvent');
    Route::put('event/{id}', [EventController::class, 'updateEvent'])
        ->middleware('EnsureUserOwnsEvent')
        ->name('updateEvent');
    Route::delete('event/{id}', [EventController::class, 'deleteEvent'])->name('deleteEvent');
    Route::get('event', [EventController::class, 'listEvents'])->name('listEvents');
    Route::post('{id}/invite',function (Request $request, int $id){
        $invite = Invite::create([
            'event_id' => $id,
            'user_invite' => $request->inviteId,
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
        ]);
        return response()->json([
            'invite' => $invite,
        ],\Illuminate\Http\Response::HTTP_CREATED);
    })->name('inviteEvent');

    Route::post('{id}/join',function (int $id, Request $request){
        $arrayinvite = Invite::query()
            ->where('event_id', $id)
            ->where('user_invite',\Illuminate\Support\Facades\Auth::id())
            ->where('statusResponse',0)
            ->first();
        if ($request->statusResponse === true) {
            $arrayinvite->fill([
                'statusResponse' => $request->statusResponse,
            ]);
            $arrayinvite->save();
            \Illuminate\Support\Facades\Auth::user()->events()->attach($id);
        }
        print_r(\App\Models\Event::with('user')->get()->toArray());

        return response()->json([
            'message' => 'Event joined',
            'invite' => $arrayinvite,
        ],\Illuminate\Http\Response::HTTP_OK);
    });
});
