<?php

declare(strict_types=1);

namespace App\Repositories\Stamp;

use App\Models\Stamp;

class StampRepository implements StampRepositoryInterface
{

    /**
     * StampRepository コンストラクタ
     * Stamp の依存性を注入する
     * 
     * @param Stamp $nicheSpot
     */
    public function __construct(protected Stamp $stamp) {}

    /**
     * スタンプ数取得
     * 
     * @param int $nicheSpotId
     * @return int
     */
    public function getCountStamp($nicheSpotId): int
    {
        return $this->stamp->where(Stamp::NICHE_SPOT_ID, $nicheSpotId)->count();
    }

    /**
     * スタンプ登録
     * 
     * @param array $stamp
     * @return void
     */
    public function createStamp(array $stamp): void
    {
        $this->stamp->create($stamp);
    }

    /**
     * スタンプ詳細取得
     * 
     * @param int user_id
     * @param int niche_spot_id
     * @return object|null
     */
    public function getDetailStamp(int $user_id, int $niche_spot_id): object|null
    {
        return $this->stamp
            ->where(Stamp::USER_ID, $user_id)
            ->where(Stamp::NICHE_SPOT_ID, $niche_spot_id)
            ->first();
    }
}
