<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserVideoStatus;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    protected $fillable = ['user_id', 'description', 'video', 'thum', 'gif', 'view', 'music_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function music()
    {
        return $this->belongsTo(Music::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(UserVideoStatus::class)
            ->where('action', array_search('LIKE', UserVideoStatus::Action));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videoStatus(): HasMany
    {
        return $this->hasMany(UserVideoStatus::class);
    }

    /**
     *
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function likeable()
    {
        return $this->morphMany(Like::class , 'likeable');
    }

}
