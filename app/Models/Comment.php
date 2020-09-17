<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = array(
        'commentable_type',
        'commentable_id',
        'user_id',
        'body'
    );

    // protected $casts = [
    //     'created_at' => 'date:Y'
    // ];
     /**
     * Get the owning imageable model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * 
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
