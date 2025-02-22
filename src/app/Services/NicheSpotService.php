<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\NicheSpot;
use App\Models\NicheSpotImage;
use App\Models\User;
use App\Repositories\NicheSpot\NicheSpotRepository;
use App\Repositories\NicheSpotImage\NicheSpotImageRepository;
use App\Repositories\Stamp\StampRepository;
use App\Repositories\User\UserRepository;
use App\Traits\DecodeJwt;
use App\Traits\ExceptionHandlerTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NicheSpotService
{
    use ExceptionHandlerTrait;
    use ResponseTrait;
    use DecodeJwt;

    /**
     * NicheSpotService コンストラクタ
     * UserRepository の依存性を注入する
     * NicheSpotRepository の依存性を注入する
     * NicheSpotImageRepository の依存性を注入する
     * StampRepository の依存性を注入する
     *
     * @param UserRepository $userRepository
     * @param NicheSpotRepository $nicheSpotRepository
     * @param NicheSpotImageRepository $nicheSpotImageRepository
     * @param StampRepository $stampRepository
     */
    public function __construct(
        protected UserRepository $userRepository,
        protected NicheSpotRepository $nicheSpotRepository,
        protected NicheSpotImageRepository $nicheSpotImageRepository,
        protected StampRepository $stampRepository
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
            if ($request->header('Authorization')) {
                // Authorization が存在する場合
                // Header の Authorization から token を取得
                $jwt = $request->header('Authorization');
                // token をデコード
                $decodedJwt = $this->decodeJWT($jwt);
                // uid に紐づくユーザーの取得
                $user = $this->userRepository->getUesr($decodedJwt['payload']['user_id']);
            }
            $userId = $user[User::ID] ?? null;
            // ニッチスポット一覧取得
            $nicheSpots = $this->nicheSpotRepository->getNicheSpot($userId, $request[NicheSpot::KEYWORD]);
            // レスポンスデータの作成
            foreach ($nicheSpots as $nicheSpot) {
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

    /**
     * ニッチスポット詳細取得
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getDetailNicheSpot(Request $request, int $id): JsonResponse
    {
        $responseData = [];
        $images = [];
        try {
            // ニッチスポット一覧取得
            $nicheSpot = $this->nicheSpotRepository->getDetailNicheSpot($id);
            if (!$nicheSpot) {
                throw new NotFoundException();
            }
            $nicheSpotImages = $this->nicheSpotImageRepository->getNicheSpotImages($id);
            foreach ($nicheSpotImages as $nicheSpotImage) {
                $images[] = [
                    NicheSpotImage::IMAGE_ID => $nicheSpotImage[NicheSpotImage::ID],
                    NicheSpotImage::IMAGE_PATH => config('app.url') . '/storage/' . $nicheSpotImage[NicheSpotImage::IMAGE_PATH]
                ];
            }
            // レスポンスデータの作成
            $responseData = [
                NicheSpot::ID => $nicheSpot[NicheSpot::ID],
                NicheSpot::NAME => $nicheSpot[NicheSpot::NAME],
                NicheSpot::ADDRESS => $nicheSpot[NicheSpot::ADDRESS],
                NicheSpot::NUMBER_OF_VISITS => $this->stampRepository->getCountStamp($id),
                NicheSpot::IMAGE_LIST => $images,
                NicheSpot::COMMENT => $nicheSpot[NicheSpot::COMMENT]
            ];
        } catch (Exception $e) {
            // エラーハンドリング
            return $this->exceptionHandler($e);
        }
        // レスポンス
        return $this->okResponse($responseData);
    }
}
