<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    /**
     * UserRepository コンストラクタ
     * User の依存性を注入する
     * 
     * @param User $user
     */
    public function __construct(protected User $user) {}

    /**
     * ユーザー登録
     * 
     * @return void
     */
    public function createUser($user): void
    {
        $this->user->create($user);
    }
}
