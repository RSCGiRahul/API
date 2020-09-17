<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    //
    public function section()
    {
        return $this->belongsTo(\App\Models\Music::class);
    }
}
