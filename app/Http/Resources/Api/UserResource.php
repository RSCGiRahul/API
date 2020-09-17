<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        return [
            'msg' => [
                // previously api was created in this manner so this time it also should be in the same way
                [
                'fb_id' => $request->fb_id,
                'username' => $request->username,
                'action' => $request->action,
                'profile_pic' => $request->profile_pic,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'signup_type' => $request->signup_type,
                'gender' => $request->gender,
            ]
            ]
        ];
    }
}
