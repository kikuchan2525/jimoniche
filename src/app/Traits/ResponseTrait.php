<?php

declare(strict_types=1);

namespace App\Traits;

use App\Consts\HttpStatusConst;
use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * 成功時（200）レスポンス
     * @param array $responseData
     * @return JsonResponse
     */
    public function okResponse(array $responseData = []): JsonResponse
    {
        return response()->json($responseData, HttpStatusConst::OK);
    }

    /**
     * 400エラーレスポンス
     * @return JsonResponse
     */
    public function badRequestResponse(): JsonResponse
    {
        return response()->json([], HttpStatusConst::BAD_REQUEST);
    }

    /**
     * 401エラーレスポンス
     * @return JsonResponse
     */
    public function unauthorizedResponse(): JsonResponse
    {
        return response()->json([], HttpStatusConst::UNAUTHORIZED);
    }

    /**
     * 403エラーレスポンス
     * @return JsonResponse
     */
    public function forbiddenResponse(): JsonResponse
    {
        return response()->json([], HttpStatusConst::FORBIDDEN);
    }

    /**
     * 404エラーレスポンス
     * @return JsonResponse
     */
    public function notFoundResponse(): JsonResponse
    {
        return response()->json([], HttpStatusConst::NOT_FOUND);
    }

    /**
     * 422エラーレスポンス
     * @param array $errorMessage
     * @return JsonResponse
     */
    public function unprocessableEntityResponse(array $errorMessage): JsonResponse
    {
        return response()->json(
            [
                'errors' => (object)$errorMessage
            ],
            HttpStatusConst::UNPROCESSABLE_ENTITY,
        );
    }

    /**
     * 500エラーレスポンス
     * @param string $key
     * @param array $value
     * @return JsonResponse
     */
    public function internalServerErrorResponse(array $value = []): JsonResponse
    {
        return response()->json($value, HttpStatusConst::INTERNAL_SERVER_ERROR);
    }
}