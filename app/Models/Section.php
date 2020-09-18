<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
   const UPDATED_AT = null;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function music()
    {
      return $this->hasMany(Music::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function video()
    {
        return $this->hasMany(Video::class);
    }
}
