<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\UserInfoResource;

class VideoCommentResource extends JsonResource
{
    public static $wrap = 'msg';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       $user =  \App\User::find($this->user_id);
       $output = [
           "fb_id" => $user->fb_id,
           "video_id" => $this->commentable_id,
           "comments" => $this->body,
           "user_info" => [
               "first_name" => $user->first_name,
               "last_name" => $user->last_name,
               "profile_pic" => $user->profile_pic,
           ],
       ];
       return [ $output];
       
    }
}
