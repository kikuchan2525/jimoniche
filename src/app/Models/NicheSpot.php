<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NicheSpot extends Model
{
    use SoftDeletes;

    // テーブル名
    const TABLE = 'niche_spot';
    public $table = self::TABLE;

    // カラム名
    const ID = 'id';
    const NAME = 'name';
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';
    const ADDRESS = 'address';
    const VIEW_COUNT = 'view_count';
    const COMMENT = 'comment';
    const USER_ID = 'user_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        self::ID,
        self::NAME,
        self::LATITUDE,
        self::LONGITUDE,
        self::ADDRESS,
        self::VIEW_COUNT,
        self::COMMENT,
        self::USER_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];

    // リクエスト用定数
    const KEYWORD = 'keyword';

    // レスポンス用定数
    const NICHE_SPOTS = 'niche_spots';
    const NUMBER_OF_VISITS = 'number_of_visits';
    const IS_VISITED = 'is_visited';
    const STAMPS_COUNT = 'stamps_count';

    public function stamps()
    {
        return $this->hasMany(Stamp::class, 'niche_spot_id', 'id');
    }
}
