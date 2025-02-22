<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NicheSpotController;
use App\Http\Controllers\StampController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ユーザー登録API
Route::put('user', UserController::class);
// ログインAPI
Route::patch('login', [AuthController::class, 'login']);
// ログイン情報取得API
Route::get('me', [AuthController::class, 'me']);
// ログアウトAPI
Route::delete('logout', [AuthController::class, 'logout']);
// ニッチスポット関連API
Route::apiResource('niche_spot', NicheSpotController::class, ['only' => ['index', 'show']]);
// スタンプ関連API
Route::apiResource('stamp', StampController::class, ['only' => ['store', 'show']]);