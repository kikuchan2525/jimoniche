<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    // テーブル名
    const TABLE = 'user';
    public $table = self::TABLE;

    // カラム名
    const ID = 'id';
    const UID = 'uid';
    const EMAIL = 'email';
    const PROVIDER = 'provider';
    const TOKEN_EXPIRED_AT = 'token_expired_at';
    const LAST_LOGINED_AT = 'last_logined_at';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        self::ID,
        self::UID,
        self::EMAIL,
        self::PROVIDER,
        self::TOKEN_EXPIRED_AT,
        self::LAST_LOGINED_AT,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];
}
