<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $fillable = ['user_id', 'likeable_type', 'likeable_id'];

    const UPDATED_AT = null;

    public $table = 'likes';

    const foreignPivotKey = 'likeable_id';

    public function likeable()
    {
        return $this->morphTo();
    }



    /**
     * Get all of the videos that are assigned this like.
     */
    public  function videos()
    {
        return $this->morphedByMany(Video::class, 'likeable', $this->table, self::foreignPivotKey);
    }
}
