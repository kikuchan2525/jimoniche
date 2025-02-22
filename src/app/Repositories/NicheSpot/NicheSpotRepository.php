<?php

declare(strict_types=1);

namespace App\Repositories\NicheSpot;

use App\Models\NicheSpot;
use Illuminate\Database\Eloquent\Collection;

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
     * @param int|null $userId
     * @param string $keyword
     * @return Collection
     */
    public function getNicheSpot(int $userId = null, string $keyword): Collection
    {
        $query = NicheSpot::withCount('stamps'); // スタンプの数をカウントする

        // キーワードが指定されていた場合、name と address で検索を追加
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('address', 'like', "%{$keyword}%");
            });
        }

        // 結果を取得して、is_visited を追加
        return $query->get()->map(function ($nicheSpot) use ($userId) {
            $nicheSpot->is_visited = $nicheSpot->stamps()->where('user_id', $userId)->exists();
            return $nicheSpot;
        });
    }

    /**
     * ニッチスポット詳細取得
     * 
     * @param int $id
     * @return object|null
     */
    public function getDetailNicheSpot(int $id): object|null
    {
        return $this->nicheSpot->find($id);
    }
}
