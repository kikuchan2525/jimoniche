<?php

declare(strict_types=1);

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * ユーザー登録
     * 
     * @return void
     */
    public function createUser($user): void;
}