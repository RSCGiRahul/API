<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserVideoStatus;

use App\Models\Comment;

class Video extends Model
{
    protected $fillable = ['user_id', 'description', 'video', 'thum', 'gif', 'view', 'music_id'];
    
    /**
     * BelongsTo 
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * HasOne
     */
    public function music()
    {
        return $this->belongsTo(Music::class);
    }


    public function likes()
    {
        return $this->hasMany(UserVideoStatus::class)
                ->where('action', array_search('LIKE',UserVideoStatus::Action) );
    }

    /**
     * 
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
