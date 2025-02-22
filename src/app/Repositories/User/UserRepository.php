<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

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
     * @param array
     * @return void
     */
    public function createUser(array $user): void
    {
        $this->user->create($user);
    }

    /**
     * ユーザー取得
     * 
     * @param string $uid
     * @return object
     */
    public function getUesr(string $uid): object
    {
        return $this->user->where(User::UID, $uid)->first();
    }

    /**
     * トークン期限削除
     * 
     * @param object $user
     * @return void
     */
    public function deleteTokenExpiredAt(object $user): void
    {
        $this->user->where(User::ID, $user[User::ID])->update([User::TOKEN_EXPIRED_AT => null]);
    }
}
