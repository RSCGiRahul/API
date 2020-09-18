<?php

namespace App\Http\Resources\Service;

class UserInfoResourceService
{
    public function __invoke( $data )
    {
        if (!$data) {
            return [];
        } 
        return [
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'fb_id' => $data->fb_id,
            'profile_pic' => $data->profile_pic,
            'gender' => $data->gender,
            'created' => DateFormatService::dateFormat($data->created_at)
        ];
    }
}
