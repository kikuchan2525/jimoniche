<?php

declare(strict_types=1);

namespace App\Repositories\NicheSpot;

use Illuminate\Database\Eloquent\Collection;

interface NicheSpotRepositoryInterface
{
    /**
     * ニッチスポット一覧取得
     * 
     * @param int|null $userId
     * @param string $keyword
     * @return Collection
     */
    public function getNicheSpot(int $userId = null, string $keyword): Collection;

    /**
     * ニッチスポット詳細取得
     * 
     * @param int $id
     * @return object|null
     */
    public function getDetailNicheSpot(int $id): object|null;
}
