<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Models\NicheSpot;
use App\Models\Stamp;
use App\Models\User;
use App\Repositories\NicheSpot\NicheSpotRepository;
use App\Repositories\Stamp\StampRepository;
use App\Repositories\User\UserRepository;
use App\Traits\DecodeJwt;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StampService
{
    use ExceptionHandlerTrait;
    use ResponseTrait;
    use DecodeJwt;

    /**
     * StampService コンストラクタ
     * StampRepository の依存性を注入する
     * UserRepository の依存性を注入する
     * NicheSpotRepository の依存性を注入する
     *
     * @param StampRepository $stampRepository
     * @param UserRepository $userRepository
     * @param NicheSpotRepository $nicheSpotRepository
     */
    public function __construct(
        protected StampRepository $stampRepository,
        protected UserRepository $userRepository,
        protected NicheSpotRepository $nicheSpotRepository
    )
    {
    }

    /**
     * スタンプ登録
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function createStamp(Request $request): JsonResponse
    {
        try{
            if(!$request->header('Authorization')) {
                // token が存在しない場合
                throw new UnauthorizedException();
            }
            // Header の Authorization から token を取得
            $jwt = $request->header('Authorization');
            // token をデコード
            $decodedJwt = $this->decodeJWT($jwt);
            // uid に紐づくユーザーの取得
            $user = $this->userRepository->getUesr($decodedJwt['payload']['user_id']);
            if(!$user) {
                // uid に紐づく情報が存在しない場合
                throw new UnauthorizedException();
            }
            if (!$this->nicheSpotRepository->getDetailNicheSpot($request[Stamp::NICHE_SPOT_ID])) {
                // id に紐づくニッチスポットが存在しない場合
                throw new NotFoundException();
            }
            // 登録データの作成
            $stamp = [
                Stamp::USER_ID => $user[User::ID],
                Stamp::NICHE_SPOT_ID => $request[Stamp::NICHE_SPOT_ID]
            ];
            // データベーストランザクションの開始
            DB::transaction(function () use ($stamp){
                $this->stampRepository->createStamp($stamp);
            });
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // レスポンス
        return $this->okResponse();
    }
    

}