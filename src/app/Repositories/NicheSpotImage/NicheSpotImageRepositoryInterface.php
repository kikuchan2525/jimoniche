<?php

declare(strict_types=1);

namespace App\Repositories\NicheSpotImage;

use Illuminate\Database\Eloquent\Collection;

interface NicheSpotImageRepositoryInterface
{
    /**
     * ニッチスポット画像一覧取得
     * 
     * @return Collection
     */
    public function getNicheSpotImages($nicheSpotId): Collection;
}
