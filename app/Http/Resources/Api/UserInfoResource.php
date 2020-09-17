<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = User::find($this->resource);
        return [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'profile_pic' => $user->profile_pic,
        ];
    }
}
