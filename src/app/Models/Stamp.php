<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stamp extends Model
{
    use SoftDeletes;

    // テーブル名
    const TABLE = 'stamp';
    public $table = self::TABLE;

    // カラム名
    const USER_ID = 'user_id';
    const NICHE_SPOT_ID = 'niche_spot_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        self::USER_ID,
        self::NICHE_SPOT_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];

    // レスポンス用カラム
    const IS_EXIST_STAMP = 'is_exist_stamp';
}
