<?php

namespace App\Http\Controllers;

use App\Services\StampService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StampController extends Controller
{

    /**
     * StampController コンストラクタ
     * StampService の依存性を注入する
     *
     * @param StampService $stampService
     */
    public function __construct(protected StampService $stampService)
    {
    }

    /**
     * スタンプ登録API
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request):JsonResponse
    {
        return $this->stampService->createStamp($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
