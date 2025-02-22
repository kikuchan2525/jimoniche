<?php

declare(strict_types=1);

namespace App\Repositories\Stamp;

use App\Models\Stamp;
use Illuminate\Database\Eloquent\Collection;

class StampRepository implements StampRepositoryInterface
{

    /**
     * NicheSpotRepository コンストラクタ
     * NicheSpot の依存性を注入する
     * 
     * @param Stamp $nicheSpot
     */
    public function __construct(protected Stamp $stamp) {}

    /**
     * スタンプ数取得
     */
    public function getCountStamp($nicheSpotId): int
    {
        return $this->stamp->where(Stamp::NICHE_SPOT_ID, $nicheSpotId)->count();
    }
}
