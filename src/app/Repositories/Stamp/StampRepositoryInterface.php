<?php

declare(strict_types=1);

namespace App\Repositories\Stamp;

interface StampRepositoryInterface
{
    /**
     * スタンプ数取得
     * 
     * @param int $nicheSpotId
     * @return int
     */
    public function getCountStamp($nicheSpotId): int;

    /**
     * スタンプ登録
     * 
     * @param $stamp
     * @return void
     */
    public function createStamp(array $stamp): void;

    /**
     * スタンプ詳細取得
     * 
     * @param int user_id
     * @param int niche_spot_id
     * @return object|null
     */
    public function getDetailStamp(int $user_id, int $niche_spot_id): object|null;
}
