<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\UserInfoResource;
use Carbon\Carbon;
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
        return $this->comments->transform( function ($comment) {
            $comments  = [
                    'video_id' => 1,
                    "fb_id" => $comment->user->fb_id,
                    "user_info" => collect($comment->user)->toArray(),
                    "comments" => $comment->body,
				    "created" =>"2019-05-15 21:22:13"
            ];
            return $comments;
        });
       
    }
}
