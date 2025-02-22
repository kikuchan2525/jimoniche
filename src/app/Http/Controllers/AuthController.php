<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * AuthController コンストラクタ
     * AuthService の依存性を注入する
     *
     * @param AuthService $authService
     */
    public function __construct(protected AuthService $authService)
    {
    }

    /**
     * ログインAPI
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        return $this->authService->login($request);
    }

    /**
     * ログイン情報取得API
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        return $this->authService->me($request);
    }

    /**
     * ログアウトAPI
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        return $this->authService->logout($request);
    }
}