<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UnauthorizedException;
use App\Models\NicheSpot;
use App\Models\User;
use App\Repositories\NicheSpot\NicheSpotRepository;
use App\Repositories\User\UserRepository;
use App\Traits\DecodeJwt;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NicheSpotService
{
    use ExceptionHandlerTrait;
    use ResponseTrait;
    use DecodeJwt;

    /**
     * NicheSpotService コンストラクタ
     * UserRepository の依存性を注入する
     * NicheSpotRepository の依存性を注入する
     *
     * @param UserRepository $userRepository
     * @param NicheSpotRepository $nicheSpotRepository
     */
    public function __construct(
        protected UserRepository $userRepository,
        protected NicheSpotRepository $nicheSpotRepository
    ) {}

    /**
     * ニッチスポット一覧取得
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getNicheSpot(Request $request): JsonResponse
    {
        $responseData = [];
        try {
            if (!$request->header('Authorization')) {
                // token が存在しない場合
                throw new UnauthorizedException();
            }
            // Header の Authorization から token を取得
            $jwt = $request->header('Authorization');
            // token をデコード
            $decodedJwt = $this->decodeJWT($jwt);
            // uid に紐づくユーザーの取得
            $user = $this->userRepository->getUesr($decodedJwt['payload']['user_id']);
            if (!$user) {
                // uid に紐づく情報が存在しない場合
                throw new UnauthorizedException();
            }
            // ニッチスポット一覧取得
            $nicheSpots = $this->nicheSpotRepository->getNicheSpot($user[User::ID]);
            // レスポンスデータの作成
            foreach($nicheSpots as $nicheSpot){
                $responseData[NicheSpot::NICHE_SPOTS][] = [
                    NicheSpot::ID => $nicheSpot[NicheSpot::ID],
                    NicheSpot::NAME => $nicheSpot[NicheSpot::NAME],
                    NicheSpot::LATITUDE => $nicheSpot[NicheSpot::LATITUDE],
                    NicheSpot::LONGITUDE => $nicheSpot[NicheSpot::LONGITUDE],
                    NicheSpot::ADDRESS => $nicheSpot[NicheSpot::ADDRESS],
                    NicheSpot::NUMBER_OF_VISITS => $nicheSpot[NicheSpot::STAMPS_COUNT],
                    NicheSpot::IS_VISITED => $nicheSpot[NicheSpot::IS_VISITED]
                ];
            }
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // レスポンス
        return $this->okResponse($responseData);
    }
}
