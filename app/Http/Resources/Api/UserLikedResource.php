<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLikedResource extends JsonResource
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
        $videos = $this->getVideoData(optional($this->likedVideos));

           $data =   [
                "fb_id" => $this->fb_id,
                "user_info" =>array
                (
                    "first_name" => $this->first_name,
                    "last_name" => $this->last_name,
                    "profile_pic" => $this->email,
                    "gender" => $this->gender,
                    "created" => Carbon::parse($this->created_at)->format('Y-m-d h:m:s'),
                ),

                "total_heart" => "100",
                "total_fans" => "88",
                "total_following" => "55",
                "user_videos" => $videos
            ];
           return [$data];
    }

    /**
     * @param $date
     * @return string
     * @throws \Carbon\Exceptions\InvalidFormatException
     */
    public  function changeDateFormat($date)
    {
        return Carbon::parse($date)->format('Y-m-d h:m:s');
    }

    /**
     *
     */
    public function getVideoData($likedVideos)
    {
        return $likedVideos->transform( function ($data) {
            $videoMusic = optional($data->videos() )->first()->load('music');
            if ($data->music = $videoMusic->music) {
                $music = [
                    "id" => $data->music->id,
                    "audio_path" =>
                        array(
                            "mp3" => $data->music->id.".mp3",
                            "acc" => $data->music->id.".aac"
                        ),
                    "sound_name" =>$data->music->name,
                    "description" => $data->music->description,
                    "thum" => $data->music->thum,
                    "section" => $data->music->section,
                    "created" => $this->changeDateFormat($data->music->created),
                ];
            }

            return [
                "id" => $data['id'],
                "video" => $data->video,
                "thum" => $data->thum,
                "gif" => $data->gif,
                "description" => $data->description,
                "liked" => 1,
                "count" =>array
                (
                    "like_count" => $data->count(),
                    "video_comment_count" => optional($this->commetableVideos->where('commentable_id',$data->id)) -> count(),
                    "view" => 1,
                ),
                "sound" => $music ?? [],

                "created" =>$this->changeDateFormat($data->created_at)
            ];
        });

    }
}
