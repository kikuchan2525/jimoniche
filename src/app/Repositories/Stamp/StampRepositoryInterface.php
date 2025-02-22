<?php

declare(strict_types=1);

namespace App\Repositories\Stamp;

interface StampRepositoryInterface
{
    /**
     * スタンプ数取得
     */
    public function getCountStamp($nicheSpotId): int;
}
