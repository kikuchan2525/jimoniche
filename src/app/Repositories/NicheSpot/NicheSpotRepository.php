<?php

declare(strict_types=1);

namespace App\Repositories\NicheSpot;

use App\Models\NicheSpot;
use App\Models\Stamp;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class NicheSpotRepository implements NicheSpotRepositoryInterface
{

    /**
     * NicheSpotRepository コンストラクタ
     * NicheSpot の依存性を注入する
     * 
     * @param NicheSpot $nicheSpot
     */
    public function __construct(protected NicheSpot $nicheSpot) {}

    /**
     * ニッチスポット一覧取得
     * 
     * @return Collection
     */
    public function getNicheSpot(int $userId): Collection
    {
        // NicheSpot を取得し、スタンプ数と is_visited を含めて返す
        return NicheSpot::withCount('stamps') // スタンプの数を取得
            ->get()
            ->map(function ($nicheSpot) use ($userId) {
                $nicheSpot->is_visited = $nicheSpot->stamps()->where('user_id', $userId)->exists();
                return $nicheSpot;
            });
    }
    
}
