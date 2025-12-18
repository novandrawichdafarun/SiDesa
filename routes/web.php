<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\UserController;

//? Auth
Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware('role:Admin,User');

Route::middleware(['auth'])->group(function () {
    Route::get('/account-request', [UserController::class, 'accountRequestView'])
        ->name('account-request.index');
    Route::post('/account-request/approval/{id}', [UserController::class, 'accountApproval'])
        ->name('account-request.approval');

    Route::get('/account-list', [UserController::class, 'accountListView'])
        ->name('account-list.index')
        ->middleware('role:Admin');

    Route::get('/account-request', [UserController::class, 'accountRequestView'])
        ->name('account-request.index')
        ->middleware('role:Admin');

    Route::post('/account-list/approval/{id}', [UserController::class, 'accountApproval'])
        ->name('account-list.approval')
        ->middleware('role:Admin');

    Route::get('/profile', [UserController::class, 'profileView'])
        ->name('profile.index');
    Route::post('/profile/{id}', [UserController::class, 'updateProfile'])
        ->name('profile.update');

    Route::get('/change-password', [UserController::class, 'changePasswordView'])
        ->name('change-password.index');
    Route::post('/change-password/{id}', [UserController::class, 'changePassword'])
        ->name('change-password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/resident', [ResidentController::class, 'store'])
        ->middleware('role:Admin');
    Route::get('/resident/create', [ResidentController::class, 'create'])
        ->middleware('role:Admin');

    Route::put('/resident/{id}', [ResidentController::class, 'update'])
        ->middleware('role:Admin');
    Route::get('/resident/{id}', [ResidentController::class, 'edit'])
        ->middleware('role:Admin');

    Route::delete('/resident/{id}', [ResidentController::class, 'destyroy'])
        ->middleware('role:Admin');

    Route::get('/resident', [ResidentController::class, 'index'])
        ->middleware('role:Admin');

});


