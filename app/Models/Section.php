<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
   const UPDATED_AT = null;

   /**
    * 
    */
    public function music()
    {
      return $this->hasMany(Music::class);
    }
}
