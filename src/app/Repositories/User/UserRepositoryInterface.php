<?php

declare(strict_types=1);

namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * ユーザー登録
     * 
     * @return void
     */
    public function createUser($user): void;

    /**
     * ユーザー取得
     * 
     * @param string $uid
     * @return object
     */
    public function getUesr(string $uid): object;

    /**
     * トークン期限削除
     * 
     * @param object $user
     * @return void
     */
    public function deleteTokenExpiredAt(object $user): void;
}
