<?php

namespace App\Http\Controllers;

use App\Services\NicheSpotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NicheSpotController extends Controller
{

    /**
     * NicheSpotController コンストラクタ
     * NicheSpotService の依存性を注入する
     *
     * @param NicheSpotService $nicheSpotService
     */
    public function __construct(protected NicheSpotService $nicheSpotService) {}

    /**
     * ニッチスポット一覧取得API
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->nicheSpotService->getNicheSpot($request);
    }

    /**
     * ニッチスポット詳細取得API
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request, int $id): JsonResponse
    {
        return $this->nicheSpotService->getDetailNicheSpot($request, $id);
    }
}
