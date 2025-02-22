<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NicheSpotController;
use App\Http\Controllers\StampController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::put('user', UserController::class);
Route::patch('login', [AuthController::class, 'login']);
Route::get('me', [AuthController::class, 'me']);
Route::delete('logout', [AuthController::class, 'logout']);
Route::apiResource('niche_spot', NicheSpotController::class, ['only' => ['index', 'show']]);
Route::apiResource('stamp', StampController::class, ['only' => ['store', 'show']]);