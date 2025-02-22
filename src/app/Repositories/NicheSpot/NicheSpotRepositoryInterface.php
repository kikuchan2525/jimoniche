<?php

declare(strict_types=1);

namespace App\Repositories\NicheSpot;

use Illuminate\Database\Eloquent\Collection;

interface NicheSpotRepositoryInterface
{
    /**
     * ニッチスポット一覧取得
     * 
     * @return Collection
     */
    public function getNicheSpot(int $userId, $keyword): Collection;

    /**
     * ニッチスポット詳細取得
     * 
     * @param $id
     * @return object|null
     */
    public function getDetailNicheSpot($id): object|null;
}
