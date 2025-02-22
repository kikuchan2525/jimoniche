<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Traits\DecodeJwt;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserService
{
    use ExceptionHandlerTrait;
    use ResponseTrait;
    use DecodeJwt;

    /**
     * 
     */
    public function __construct(protected UserRepository $userRepository)
    {
    }

    public function createUser(Request $request): JsonResponse
    {
        try{
            // Header の Authorization から token を取得
            $jwt = $request->header('Authorization');
            $decodedJwt = $this->decodeJWT($jwt);
            // 登録データの作成
            $user = [
                User::UID => $decodedJwt['payload']['user_id'],
                User::EMAIL => $decodedJwt['payload']['email'],
                User::PROVIDER => $decodedJwt['payload']['firebase']['sign_in_provider'],
                User::TOKEN_EXPIRED_AT => date('Y-m-d H:i:s', $decodedJwt['payload']['exp']),
                User::LAST_LOGINED_AT => date('Y-m-d H:i:s', $decodedJwt['payload']['auth_time']),
            ];
            // データベーストランザクションの開始
            DB::transaction(function () use ($user){
                $this->userRepository->createUser($user);
            });
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // レスポンス
        return $this->okResponse();
    }
    

}