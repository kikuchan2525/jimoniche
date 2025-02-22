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
    public function getNicheSpot($userId = null, $keyword): Collection;
}
