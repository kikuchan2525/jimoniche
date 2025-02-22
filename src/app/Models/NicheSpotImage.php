<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NicheSpotImage extends Model
{
    use SoftDeletes;

    // テーブル名
    const TABLE = 'niche_spot_image';
    public $table = self::TABLE;

    // カラム名
    const ID = 'id';
    const NICHE_SPOT_ID = 'niche_spot_id';
    const IMAGE_PATH = 'image_path';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        self::ID,
        self::NICHE_SPOT_ID,
        self::IMAGE_PATH,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];

    // レスポンス用カラム
    const IMAGE_ID = 'image_id';

}
