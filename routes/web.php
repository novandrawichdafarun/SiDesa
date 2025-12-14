<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/resident', [ResidentController::class, 'index']);
Route::get('/resident/create', [ResidentController::class, 'create']);
Route::get('/resident/{id}', [ResidentController::class, 'edit']);
Route::post('/resident', [ResidentController::class, 'store']);
Route::put('/resident/{id}', [ResidentController::class, 'update']);
Route::delete('/resident/{id}', [ResidentController::class, 'delete']);