<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserVideosResource extends ResourceCollection
{
    public static $wrap = 'msg';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $output = $this->collection->transform( function ($data) {
            $userVideo =  $data->video->transform( function ($result) {
                return $this->getVideoDetails($result);
            });
            // dd( collect($data ) );
            return [
                'fb_id' => $data->fb_id,
                "user_info" =>collect($data)->forget('video')->forget('followers')->toArray(),
                "user_videos" =>  $userVideo->toArray(),
                "follow_status" => [
                    "follow" => $data->followers->count() > 0 ? 1 : 0,
                    "follow_status_button" => $data->followers->count() > 0 ? "Follow" : "Unfollow",
                ],
                
                "total_heart" => "2",
                "total_fans" => "0",
                "total_following" => "0",
            ];
        });
        return $output;
    }

    /**
     * 
     */
    protected function getVideoDetails($video)
    {
         return [
                'id' => $video->id,
                "video" => $video->video,
                "view" => $video->view,
                "thum"=> $video->thum,
                "gif"=> $video->gif,
                "description"=> $video->description,
                "sound" =>  array_merge(
                    $video->music ? $video->music->toArray() : []
                    ,
                    [
                        "audio_path" => [
                            "mp3" => $video->music ? $video->music->id . '.mp3' : null ,
                            "acc" => $video->music ? $video->music->id. '.acc' : null
                        ],
                    ]                        
                    ),
                'count' => [
                    "like_count" => count($video->likes),
                    "video_comment_count" => 2,
                ],
                "liked" =>  count($video->likes),
                "created_at" => $video->created_at,
         ];
    }
}
