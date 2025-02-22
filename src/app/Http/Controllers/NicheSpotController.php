<?php

namespace App\Http\Controllers;

use App\Services\NicheSpotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NicheSpotController extends Controller
{

    /**
     * @param NicheSpotService $nicheSpotService
     */
    public function __construct(protected NicheSpotService $nicheSpotService)
    {
    }

    /**
     * ニッチスポット一覧取得API
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        return $this->nicheSpotService->getNicheSpot($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
}
