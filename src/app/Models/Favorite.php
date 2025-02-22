<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use SoftDeletes;

    // テーブル名
    const TABLE = 'favorite';
    public $table = self::TABLE;

    // カラム名
    const ID = 'id';
    const USER_ID = 'user_id';
    const NICHE_SPOT_ID = 'niche_spot_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::NICHE_SPOT_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];
}
