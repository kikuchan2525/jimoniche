<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * UserController コンストラクタ
     * UserService の依存性を注入する
     * 
     * @param UserService $userService
     */
    public function __construct(protected UserService $userService)
    {
    }

    /**
     * ユーザー登録API
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return $this->userService->createUser($request);
    }
}
