<?php

declare(strict_types=1);

namespace App\Repositories\NicheSpotImage;

use App\Models\NicheSpotImage;
use Illuminate\Database\Eloquent\Collection;

class NicheSpotImageRepository implements NicheSpotImageRepositoryInterface
{

    /**
     * NicheSpotRepository コンストラクタ
     * NicheSpot の依存性を注入する
     * 
     * @param NicheSpotImage $nicheSpotImage
     */
    public function __construct(protected NicheSpotImage $nicheSpotImage) {}

    /**
     * ニッチスポット画像一覧取得
     * 
     * @return Collection
     */
    public function getNicheSpotImages($nicheSpotId): Collection 
    {
        return $this->nicheSpotImage->where(NicheSpotImage::NICHE_SPOT_ID, $nicheSpotId)->get();
    }
}
