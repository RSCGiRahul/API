<?php

namespace App\Http\Resources\Service;

use Carbon\Carbon;

class DateFormatService {


    public static function dateFormat($date)
    {
        return Carbon::parse($date)->format('Y-m-d h:m:s');
    }
}
