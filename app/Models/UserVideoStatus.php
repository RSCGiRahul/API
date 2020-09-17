<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVideoStatus extends Model
{
    // public $table = 'user_video_status';
    const UPDATED_AT = null;

    const Action = [
        1 => 'LIKE',
        2 => 'SHARE',
        3 => 'DOWNLOAD'
    ];

}
