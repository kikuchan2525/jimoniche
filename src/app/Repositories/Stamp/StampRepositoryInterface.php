<?php

declare(strict_types=1);

namespace App\Repositories\Stamp;

interface StampRepositoryInterface
{
    /**
     * スタンプ数取得
     */
    public function getCountStamp($nicheSpotId): int;

    /**
     * スタンプ登録
     * 
     * @param $stamp
     * @return void
     */
    public function createStamp(array $stamp): void;
}
