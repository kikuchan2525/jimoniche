<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UnauthorizedException;
use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Traits\DecodeJwt;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthService
{
    use ExceptionHandlerTrait;
    use ResponseTrait;
    use DecodeJwt;

    /**
     * UserService コンストラクタ
     * UserRepository の依存性を注入する
     *
     * @param UserRepository $userRepository
     */
    public function __construct(protected UserRepository $userRepository)
    {
    }

    /**
     * ログイン
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try{
            if(!$request->header('Authorization')) {
                // token が存在しない場合
                throw new UnauthorizedException();
            }
            // Header の Authorization から token を取得
            $jwt = $request->header('Authorization');
            $decodedJwt = $this->decodeJWT($jwt);
            // uid に紐づくユーザーの取得
            $user = $this->userRepository->getUesr($decodedJwt['payload']['user_id']);
            if(!$user) {
                // uid に紐づく情報が存在しない場合
                throw new UnauthorizedException();
            }
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // レスポンス
        return $this->okResponse($this->formatUserResponse($user));
    }

    /**
     * ログイン情報取得
     * 
     * @param Request $requet
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        try{
            if(!$request->header('Authorization')) {
                // token が存在しない場合
                throw new UnauthorizedException();
            }
            // Header の Authorization から token を取得
            $jwt = $request->header('Authorization');
            $decodedJwt = $this->decodeJWT($jwt);
            // uid に紐づくユーザーの取得
            $user = $this->userRepository->getUesr($decodedJwt['payload']['user_id']);
            if(!$user) {
                // uid に紐づく情報が存在しない場合
                throw new UnauthorizedException();
            }
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // レスポンス
        return $this->okResponse($this->formatUserResponse($user));
    }

    /**
     * ユーザー情報のレスポンスの作成
     * 
     * @param object $user
     * @return array
     */
    public function formatUserResponse(object $user):array
    {
        return [
            User::ID => $user[User::ID],
            User::UID => $user[User::UID],
            User::EMAIL => $user[User::EMAIL],
            User::PROVIDER => $user[User::PROVIDER]
        ];
    }
}